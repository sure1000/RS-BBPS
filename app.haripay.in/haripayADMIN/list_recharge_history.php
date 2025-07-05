<?php

session_start();

include "include.php";
include "session.php";
$recharge_page = 1;
$tables = 1;

//pt($_POST);pt($_GET);
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$length = $_POST['length'];

if ($row == "") {
    $row = 0;
}

if ($length == "") {
    $length = 10;
}

$trigger_provider_type = "(provider_type = 'Prepaid' || provider_type = 'DTH')";;
$trigger_provider_id = "1=1";
$trigger_transaction_type = "(transaction_type = 'Recharge')";
$trigger_status = "1=1";
$trigger_from_date = "1=1";
$trigger_to_date = "1=1";
$trigger_search_val = "1=1";
$trigger_api_id = "1=1";
$trigger_user_id = "1=1";

if (isset($_SESSION['recharge_search'])) {
    if (isset($_SESSION['recharge_search']['service_id'])) {
        $provider_type = get_service_name($_SESSION['recharge_search']['service_id']);
        $trigger_provider_type = "provider_type = '" . $provider_type . "'";
    }
    if (isset($_SESSION['recharge_search']['provider_id'])) {
        $trigger_provider_id = "provider_id = '" . $_SESSION['recharge_search']['provider_id'] . "'";
    }

    if (isset($_SESSION['recharge_search']['status'])) {
        $trigger_status = "status = '" . $_SESSION['recharge_search']['status'] . "'";
    }
    if (isset($_SESSION['recharge_search']['from_date'])) {
        $trigger_from_date = "transaction_date >= '" . $_SESSION['recharge_search']['from_date'] . " 00:00:00'";
    }
    if (isset($_SESSION['recharge_search']['to_date'])) {
        $trigger_to_date = "transaction_date <= '" . $_SESSION['recharge_search']['to_date'] . " 23:59:59'";
    }
    if (isset($_SESSION['recharge_search']['user_name'])) {
        $trigger_user_id = "user_id = '" . $_SESSION['recharge_search']['user_name'] . "'";
    }
    if (isset($_SESSION['recharge_search']['api_id'])) {
        $trigger_api_id = "api_id = '" . $_SESSION['recharge_search']['api_id'] . "'";
    }
    if (isset($_SESSION['recharge_search']['search_val'])) {
        $trigger_search_val = "(mobile_number = '" . $_SESSION['recharge_search']['search_val'] . "' or ref_number = '" . $_SESSION['search']['search_val'] . "' or opid = '" . $_SESSION['search']['search_val'] . "')";
    }
}

$triggers = $trigger_provider_type . " and " . $trigger_transaction_type . " and ".$trigger_provider_id . " and " . $trigger_user_id . " and " . $trigger_status . " and " . $trigger_from_date . " and " . $trigger_api_id . " and " . $trigger_to_date . " and " . $trigger_search_val;

$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value


$sql_total = "Select count(wallet_id) as total_transactions from wallet where   $triggers";
$res_total = getXbyY($sql_total);

$sql_transactions = "Select * from wallet where $triggers order by wallet_id DESC limit $row ,$length";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);

if ($row_transactions > 0) {

    for ($i = 0; $i < $row_transactions; $i++) {


$ttype= "";
		$commission = 'RC - 0 <br>';
		$commission .= 'DT - 0 <br>';
		$commission .= 'MD - 0';
		$total_comm =0;
		$pl_comm =0;$pl='';
        if ($res_transactions[$i]['status'] == "Success") {
			//commission distributir
			 $sql_transactions_d = "Select amount,parent_user_id from wallet where transaction_type='Commission' AND parent_id='".$res_transactions[$i]['wallet_id']."' AND user_id='".$res_transactions[$i]['parent_user_id']."' order by wallet_id DESC LIMIT 1";
			 $res_transactions_d = getXbyY($sql_transactions_d);
			 $commission_d = $res_transactions_d[0]['amount'];
			 $parent_user_id = $res_transactions_d[0]['parent_user_id'];
			 
			 //commission master distributir
			 $sql_transactions_md = "Select amount from wallet where transaction_type='Commission' AND parent_id='".$res_transactions[$i]['wallet_id']."' AND user_id='".$parent_user_id."' order by wallet_id DESC LIMIT 1";
			 $res_transactions_md = getXbyY($sql_transactions_md);
			 $commission_md = $res_transactions_md[0]['amount'];
			 
			 $commission = 'RC - '.$res_transactions[$i]['commission_rt'].'<br>';
			 $commission .= 'DT - '.$commission_d.'<br>';
			 $commission .= 'MD - '.$commission_md;
			 
			 $total_comm =$res_transactions[$i]['commission_rt']+$commission_d+$commission_md;
			 
			//pl calculation
			$sql_transactions_pl = "Select commission_amount,commission_percentage from api_provider where api_id='".$res_transactions[$i]['api_id']."' AND api_name='".$res_transactions[$i]['api_name']."' AND provider_id='".$res_transactions[$i]['provider_id']."' 
			order by api_provider_id DESC LIMIT 1";
			$res_transactions_pl = getXbyY($sql_transactions_pl);
			$commission_fixed = $res_transactions_pl[0]['commission_amount'];
			$commission_per = $res_transactions_pl[0]['commission_percentage'];
		
			 if($commission_fixed>0)
			$pl_comm = $commission_fixed-$total_comm;
			else if($commission_per>0)
			{
				$pl_commp = ($res_transactions[$i]['total_amount']*$commission_per)/100;
				$pl_comm = $pl_commp-$total_comm;
			}
			
			if($pl_comm>0) $pl ='<span style="color:green">'.$pl_comm.'</span>';
			else $pl ='<span style="color:red">'.$pl_comm.'</span>';
		
            $ttype .= "<button class='btn btn-success' disabled='disabled'>Success</button>";
        } else if ($res_transactions[$i]['status'] == "Pending" || $res_transactions[$i]['InQueue']) {
            $ttype .= "<button class='btn btn-info' disabled='disabled'>Pending</button>";
        } else {
            $ttype .= "<button class='btn btn-danger' disabled='disabled'>Failed</button>";
        }
        if ($res_transactions[$i]['transaction_type'] == "Recharge") {
            $ttype .= " <button class='btn btn-primary btn-lightblue' title='Retry' onclick='showmodal(" . $res_transactions[$i]['wallet_id'] . ")'> <i class='fa fa-spinner'> </i></button>";
        }
        if ($res_transactions[$i]['disputed'] == "Yes" && $res_transactions[$i]['transaction_type'] == "Recharge") {
            $ttype .= " <button class='btn btn-outline-warning' disabled='disabled'>Disputed</button>";
        }
      
		
		
		
		
        $data[] = array(
            "transaction_date" => format_date($res_transactions[$i]['transaction_date']),
            "user_details" => $res_transactions[$i]['user_name'],
            "recharge_number" => " <b>" . $res_transactions[$i]['mobile_number'] . "<br/> " . $res_transactions[$i]['provider_name'] . " </b> <br/> (" . $res_transactions[$i]['provider_type'] . ")",
            "ref_number" => $res_transactions[$i]['ref_number'],
            "opid" => $res_transactions[$i]['opid'],
            "api" => $res_transactions[$i]['api_name'],
            "amount" => "<i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['total_amount'] . "</span>",
            "commission" => $commission,
            "total_comm" => $total_comm,
            "pl" => $pl,
            "status" => $ttype,
        );
    }
} else {
    $data = array();
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $res_total[0]['total_transactions'],
    "iTotalDisplayRecords" => $res_total[0]['total_transactions'],
    "aaData" => $data,
);

echo json_encode($response);
?>
