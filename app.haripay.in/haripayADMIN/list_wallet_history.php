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


$trigger_transaction_type = "(transaction_type = 'Send Money' or transaction_type = 'Recieve Money'  or transaction_type = 'Reverse' or transaction_type = 'Payment Gateway')";
$trigger_status = "1=1";
$trigger_from_date = "1=1";
$trigger_to_date = "1=1";
$trigger_search_val = "1=1";
$trigger_user_id = "1=1";

if (isset($_SESSION['wallet_search'])) {
   
    

    if (isset($_SESSION['wallet_search']['status'])) {
        $trigger_status = "status = '" . $_SESSION['wallet_search']['status'] . "'";
    }
    if (isset($_SESSION['wallet_search']['from_date'])) {
        $trigger_from_date = "transaction_date >= '" . $_SESSION['wallet_search']['from_date'] . " 00:00:00'";
    }
    if (isset($_SESSION['wallet_search']['to_date'])) {
        $trigger_to_date = "transaction_date <= '" . $_SESSION['wallet_search']['to_date'] . " 23:59:59'";
    }
    if (isset($_SESSION['wallet_search']['user_name'])) {
        $trigger_user_id = "user_id = '" . $_SESSION['wallet_search']['user_name'] . "'";
    }
    if (isset($_SESSION['wallet_search']['transaction_type'])) {
        $trigger_transaction_type = "transaction_type = '" . $_SESSION['wallet_search']['transaction_type'] . "'";
    }
   if (isset($_SESSION['wallet_search']['search_val'])) {
        $trigger_search_val = "(mobile_number = '" . $_SESSION['wallet_search']['search_val'] . "' or ref_number = '" . $_SESSION['search']['search_val'] . "' or opid = '" . $_SESSION['search']['search_val'] . "')";
    }
}

$triggers =  $trigger_transaction_type . " and " . $trigger_user_id . " and " . $trigger_status . " and " . $trigger_from_date . " and " . $trigger_to_date . " and " . $trigger_search_val;

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
        if ($res_transactions[$i]['status'] == "Success") {
            $ttype .= "<button class='btn btn-success' disabled='disabled'>Success</button>";
        } else if ($res_transactions[$i]['status'] == "Pending") {
            $ttype .= "<button class='btn btn-info' disabled='disabled'>Pending</button>";
        } else {
            $ttype .= "<button class='btn btn-danger' disabled='disabled'>Failed</button>";
        }
        
        if($res_transactions[$i]['transaction_type'] == "Send Money"){
             $res_transactions[$i]['transaction_type'] = "<span class='red'>". $res_transactions[$i]['transaction_type']."</span>";
        }else if($res_transactions[$i]['transaction_type'] == "Recieve Money"){
             $res_transactions[$i]['transaction_type'] = "<span class='green'>". $res_transactions[$i]['transaction_type']."</span>";
        }else if($res_transactions[$i]['transaction_type'] == "Reverse"){
             $res_transactions[$i]['transaction_type'] = "<span style='color:#130ffa'>". $res_transactions[$i]['transaction_type']."</span>";
        }
      
       
        $data[] = array(
            "transaction_date" => format_date($res_transactions[$i]['transaction_date']),
            "user_details" => $res_transactions[$i]['user_name'],
            "t_type" => " <b>" . $res_transactions[$i]['transaction_type'] . "</b> ",
            "to_user" => $res_transactions[$i]['user_1_name'] ."<br/> <small class='red'>".$res_transactions[$i]['transaction_details']."</small><br/><small class='green'>".$res_transactions[$i]['recharge_path']."</small>" ,
            "ref_number" => $res_transactions[$i]['ref_number'],
            "amount" => "<i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['amount'] . "</span>",
            "user_amount" => "<i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['user_new_balance'] . "</span>",
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
