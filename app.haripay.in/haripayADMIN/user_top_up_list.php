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

$trigger_from_date = "1=1";
$trigger_to_date = "1=1";
$trigger_search_val = "1=1";
$trigger_user_name = "1=1";

if (isset($_SESSION['search'])) {
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
		$trigger_search_val = "ref_number = '" . $_SESSION['search']['search_val'] . "'";
	}
	if (isset($_SESSION['search']['user_name'])) {
		$trigger_user_name = "user_name like '%" . $_SESSION['search']['user_name'] . "'%";
	}

}

$triggers = $trigger_from_date . " and " . $trigger_to_date . " and " . $trigger_search_val . " and " . $trigger_user_name;

$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
//pt($_POST);

$sql_total = "Select count(wallet_id) as total_transactions from wallet where $triggers and transaction_type = 'Recieve Money' order by wallet_id";
$res_total = getXbyY($sql_total);

$sql_transactions = "Select * from wallet where $triggers and transaction_type = 'Recieve Money' order by wallet_id limit $row ,$length";
//$sql_transactions = "Select * from wallet where user_id = ".$o->user_id." order by transaction_date DESC";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);

if ($row == 0) {
	$old_balance = 0;
} else {

	$sql_turnover = "Select sum(amount) as total_amount from wallet where $triggers and transaction_type = 'Recieve Money' and wallet_id < " . $res_transactions[0]['wallet_id'] . " group by status";
	$res_turnover = getXbyY($sql_turnover);
	$rows_turnover = count($res_turnover);

	$old_balance = round($res_turnover[0]['total_amount'], 2);

}

if ($row_transactions > 0) {

	for ($i = 0; $i < $row_transactions; $i++) {
		$class = transaction_type($res_transactions[$i]['transaction_type']);
		if ($res_transactions[$i]['status'] == "Failed") {
			$class = "red";
			//$new_balance = $old_balance - $res_transactions[$i]['amount'];
			$new_balance = $old_balance;
		} else {
			$class = "green";
			$new_balance = round($old_balance + $res_transactions[$i]['amount'], 2);
		}

		if ($res_transactions[$i]['circle_name'] == " ") {
			$res_transactions[$i]['circle_name'] = "Pan India";
		}

		$ttype = "<b>" . $res_transactions[$i]['transaction_type'] . "</b> -"
			. "<b>" . $res_transactions[$i]['mobile_number'] . " </b><br />"
			. "Ref. No.: " . $res_transactions[$i]['ref_number'] . " / " . $res_transactions[$i]['opid'] . "<br />"
			. $res_transactions[$i]['recharge_path'] . " <b>(" . $res_transactions[$i]['ip_address'] . ")<br />";

		$data[] = array(
			"transaction_date" => format_date($res_transactions[$i]['transaction_date']),
			"user_name" => $res_transactions[$i]['user_name'],
			"transaction_type" => $ttype,
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
