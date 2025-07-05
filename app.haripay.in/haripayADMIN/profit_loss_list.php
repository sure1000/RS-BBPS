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
$trigger_transaction_type = "(transaction_type = 'Commission')";
$trigger_status = "1=1";
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
		$trigger_status = "status = '" . $_SESSION['search']['status'] . "'";
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
//pt($_POST);

$sql_total = "Select count(wallet_id) as total_transactions from wallet where $triggers order by wallet_id";
$res_total = getXbyY($sql_total);

$sql_transactions = "Select * from wallet where $triggers order by wallet_id desc limit $row ,$length";
//$sql_transactions = "Select * from wallet where user_id = ".$o->user_id." order by transaction_date DESC";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);

if ($row_transactions > 0) {

	for ($i = 0; $i < $row_transactions; $i++) {
		if ($res_transactions[$i]['circle_name'] == " ") {
			$res_transactions[$i]['circle_name'] = "Pan India";
		}

		$ttype = "<b>" . $res_transactions[$i]['transaction_type'] . "</b> -"
			. "<b>" . $res_transactions[$i]['mobile_number'] . " (" . $res_transactions[$i]['provider_type'] . ")</b><br />"
			. "Ref. No.: " . $res_transactions[$i]['ref_number'] . " / " . $res_transactions[$i]['opid'] . "<br />"
			. $res_transactions[$i]['transaction_details'] . " (" . $res_transactions[$i]['provider_name'] . ")(" . $res_transactions[$i]['circle_name'] . ")<br />"
			. $res_transactions[$i]['recharge_path'] . " <b>(" . $res_transactions[$i]['ip_address'] . ")<br />";

		if ($res_transactions[$i]['status'] == "Failed") {
			$ttype .= "<button class='btn btn-danger' disabled='disabled'>Failed</button>";
		} else if ($res_transactions[$i]['status'] == "Pending") {
			$ttype .= "<button class='btn btn-primary' disabled='disabled'>Pending</button>";
		} else {
			$ttype .= "<button class='btn btn-success' disabled='disabled'>Success</button>";
		}

		$difference = $res_transactions[$i]['api_amount'] - $res_transactions[$i]['amount'];

		if ($difference > 0) {
			$class = "green";
		} else if ($difference < 0) {
			$class = "red";
		} else {
			$class = "text-warning";
		}

		$data[] = array(
			"transaction_date" => format_date($res_transactions[$i]['transaction_date']),
			"user_name" => $res_transactions[$i]['user_name'],
			"transaction_type" => $ttype,
			"api" => $res_transactions[$i]['api_name'],
			"api_commission" => "<i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['api_amount'],
			"commission" => "<i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['amount'],
			"difference" => "<span class=" . $class . "><i class='fa fa-rupee-sign'></i> " . $difference . "</span>",
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
