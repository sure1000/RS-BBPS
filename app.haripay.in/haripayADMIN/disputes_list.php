<?php

session_start();

include "include.php";
include "session.php";
$recharge_page = 1;
$tables = 1;
//pt($_SESSION);
//pt($_POST);pt($_GET);
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$length = $_POST['length'];

if ($row == "") {
	$row = 0;
}

if ($length == "") {
	$length = 50;
}

$trigger_provider_type = "1=1";
$trigger_provider_id = "1=1";
$trigger_transaction_type = "1=1";
$trigger_status = "A.disputed='Yes'";
$trigger_from_date = "1=1";
$trigger_to_date = "1=1";
$trigger_search_val = "1=1";
$trigger_opid = "1=1";
$trigger_api_id = "1=1";
$trigger_user_name = "1=1";
$trigger_ip_address = "1=1";

if (isset($_SESSION['search'])) {
	if (isset($_SESSION['search']['service_id'])) {
		$provider_type = get_service_name($_SESSION['search']['service_id']);
		$trigger_provider_type = "provider_type = '" . $provider_type . "'";
	}
	if (isset($_SESSION['search']['provider_id'])) {
		$trigger_provider_id = "provider_id = '" . $_SESSION['search']['provider_id'] . "'";
	}
	if (isset($_SESSION['search']['transaction_type'])) {
		$trigger_transaction_type = "transaction_type = '" . $_SESSION['search']['transaction_type'] . "'";
	}
	if (isset($_SESSION['search']['status'])) {
		if ($_SESSION['search']['status'] == "Pending") {
			$trigger_status = "disputed = 'Yes'";
		} else {
			$trigger_status = "disputed = 'Resolved'";
		}

	}

	
	if (isset($_SESSION['search']['from_date'])) {
		$trigger_from_date = "transaction_date >= '" . $_SESSION['search']['from_date'] . "'";
	}
	if (isset($_SESSION['search']['to_date'])) {
		if ($_SESSION['search']['to_date'] == todaysDate_only()) {
			$_SESSION['search']['to_date'] = todaysDate();
		}
		$trigger_to_date = "transaction_date <= '" . $_SESSION['search']['to_date'] . "'";
	}
	if (isset($_SESSION['search']['search_val'])) {
		$trigger_search_val = "(mobile_number = '" . $_SESSION['search']['search_val'] . "' or ref_number = '" . $_SESSION['search']['search_val'] . "' or opid = '" . $_SESSION['search']['search_val'] . "')";
	}
	if (isset($_SESSION['search']['opid'])) {
		$trigger_opid = "opid = '" . $_SESSION['search']['opid'] . "'";
	}
	if (isset($_SESSION['search']['api_id'])) {
		$trigger_opid = "api_id = '" . $_SESSION['search']['api_id'] . "'";
	}
	if (isset($_SESSION['search']['user_name'])) {
		$trigger_user_name = "user_name like '%" . $_SESSION['search']['user_name'] . "%'";
	}
	if (isset($_SESSION['search']['ip_address'])) {
		$trigger_opid = "ip_address = '" . $_SESSION['search']['ip_address'] . "'";
	}
}

$triggers = $trigger_provider_type . " and " . $trigger_provider_id . " and " . $trigger_transaction_type . " and " . $trigger_status . " and " . $trigger_from_date . " and " . $trigger_to_date . " "
	. "and " . $trigger_search_val . " and " . $trigger_opid . " and " . $trigger_api_id . " and " . $trigger_user_name . " and " . $trigger_ip_address;

$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value


$sql_total = "Select A.wallet_id,B.wallet_id,B.is_active,count(B.wallet_id) as total_transactions from wallet as A left join disputes as B on (A.wallet_id=B.wallet_id) where B.is_active='2' and  $triggers   order by A.wallet_id ";
$res_total = getXbyY($sql_total);


$sql_transactions = "Select A.*, B.wallet_id,B.is_active from wallet as A left join disputes as B on (A.wallet_id=B.wallet_id) where B.is_active='2'";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);



if ($row == 0) {
	$old_balance = 0;
} else {

	$sql_turnover = "Select sum(amount) as total_amount, status from wallet where $triggers and wallet_id < " . $res_transactions[0]['wallet_id'] . " group by status";
	$res_turnover = getXbyY($sql_turnover);
	$rows_turnover = count($res_turnover);

	$old_balance = 0;
	for ($i = 0; $i < $rows_turnover; $i++) {
		if ($res_turnover[$i]['status'] != 'Failed') {
			$old_balance = $old_balance + $res_turnover[$i]['total_amount'];
		}
	}

}

if ($row_transactions > 0) {

	for ($i = 0; $i < $row_transactions; $i++) {
		$class = transaction_type($res_transactions[$i]['transaction_type']);
		if ($res_transactions[$i]['status'] == "Failed") {
			$class = "red";
			
			$new_balance = $old_balance;
		} else {
			$class = "green";
			$new_balance = $old_balance + $res_transactions[$i]['amount'];
		}

		if ($res_transactions[$i]['circle_name'] == " ") {
			$res_transactions[$i]['circle_name'] = "Pan India";
		}
		

		$ttype = "<b>" . $res_transactions[$i]['transaction_type'] . "</b> -"
			. "<b>" . $res_transactions[$i]['mobile_number'] . " (" . $res_transactions[$i]['provider_type'] . ")</b><br />"
			. "Ref. No.: " . $res_transactions[$i]['ref_number'] . " / " . $res_transactions[$i]['opid'] . "<br />"
			. $res_transactions[$i]['transaction_details'] . " (" . $res_transactions[$i]['provider_name'] . ")(" . $res_transactions[$i]['circle_name'] . ")<br />"
			. $res_transactions[$i]['recharge_path'] . " <b>(" . $res_transactions[$i]['ip_address'] . ")<br />";

		if ($res_transactions[$i]['disputed'] == "Yes" && $res_transactions[$i]['status'] == 'Success' && $res_transactions[$i]['is_active'] == '2') {
			$ttype .= "<button class='btn btn-primary'  onclick=\"pending_info('".$res_transactions[$i]['wallet_id']."')\" >Pending</button>";
		} else if($res_transactions[$i]['disputed'] == "Resolved" && $res_transactions[$i]['status'] == 'Failed' && $res_transactions[$i]['is_active'] == '1'){
$ttype .= "<button class='btn btn-success'>Resolved</button>";
		}
		else if($res_transactions[$i]['disputed'] == "Rejected" && $res_transactions[$i]['status'] == 'Success' && $res_transactions[$i]['is_active'] == '1'){
			$ttype .= "<button class='btn btn-success'>Rejected</button>";
		}

		$data[] = array(
			"transaction_date" => format_date($res_transactions[$i]['transaction_date']),
			"user_name" => $res_transactions[$i]['user_name'],
			"transaction_type" => $ttype,
			"api" => $res_transactions[$i]['api_name'],
			"user_old_balance" => "<i class='fa fa-rupee-sign'></i> " . $old_balance,
			"amount" => "<span class=" . $class . ">" . $sign . "<i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['amount'] . "</span>",
			"user_new_balance" => "<i class='fa fa-rupee-sign'></i> " . $new_balance,
		);

		$old_balance = $new_balance;
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
