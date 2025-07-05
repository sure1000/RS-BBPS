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

$trigger_user_name = "1=1";
$trigger_cash_credit = "1=1";
$trigger_status = "1=1";
$trigger_from_date = "1=1";
$trigger_to_date = "1=1";
$trigger_transfer_mode = "1=1";
$trigger_transaction_number = "1=1";

if (isset($_SESSION['search'])) {
	if (isset($_SESSION['search']['user_name'])) {
		$trigger_user_name = "(B.user_name Like '%" . $_SESSION['search']['user_name'] . "%' or B.name like '%" . $_SESSION['search']['user_name'] . "%' or B.mobile like  '%" . $_SESSION['search']['user_name'] . "%' or B.email like '%" . $_SESSION['search']['user_name'] . "%'";
	}
	if (isset($_SESSION['search']['cash_credit'])) {
		$trigger_cash_credit = "A.cash_credit = '" . $_SESSION['search']['cash_credit'] . "'";
	}
	if (isset($_SESSION['search']['status'])) {
		$trigger_status = "A.status = '" . $_SESSION['search']['status'] . "'";
	}
	if (isset($_SESSION['search']['from_date'])) {
		$trigger_from_date = "A.request_date >= '" . $_SESSION['search']['from_date'] . "'";
	}
	if (isset($_SESSION['search']['to_date'])) {
		if ($_SESSION['search']['to_date'] == todaysDate_only()) {
			$_SESSION['search']['to_date'] = todaysDate();
		}
		$trigger_to_date = "A.request_date <= '" . $_SESSION['search']['to_date'] . "'";
	}
	if (isset($_SESSION['search']['transfer_mode'])) {
		$trigger_transfer_mode = "A.transfer_mode = '" . $_SESSION['search']['transfer_mode'] . "'";
	}
	if (isset($_SESSION['search']['transaction_number'])) {
		$trigger_opid = "A.transaction_number like '%" . $_SESSION['search']['transaction_number'] . "%'";
	}
}

$triggers = $trigger_user_name . " and " . $trigger_cash_credit . " and " . $trigger_status . "  and " . $trigger_from_date . " and " . $trigger_to_date . " "
	. "and " . $trigger_transfer_mode . " and " . $trigger_transaction_number;

$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
//pt($_POST);

$sql_total = "Select count(A.request_money_id) as total_transactions from request_money as A where $triggers order by A.request_money_id";
$res_total = getXbyY($sql_total);

$sql_transactions = "Select A.*, B.user_name, B.name, B.email, B.mobile from request_money as A left join users as B on (A.user_id = B.user_id) where $triggers order by A.request_money_id limit $row ,$length";
//$sql_transactions = "Select * from wallet where user_id = ".$o->user_id." order by transaction_date DESC";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);

if ($row_transactions > 0) {
	$total_amount = 0;
	for ($i = 0; $i < $row_transactions; $i++) {
		if ($res_transactions[$i]['status'] == "Pending") {
			$btn = "btn-primary";
		} else if ($res_transactions[$i]['status'] == "Transferred") {
			$btn = "btn-success";
		} else {
			$btn = "btn-danger";
		}

		$data[] = array(
			"transaction_date" => format_date($res_transactions[$i]['request_date']),
			"user_name" => $res_transactions[$i]['user_name'] . "<br />" . $res_transactions[$i]['name'] . "<br />" . $res_transactions[$i]['email'] . "<br />" . $res_transactions[$i]['mobile'],
			"cash_credit" => $res_transactions[$i]['cash_credit'],
			"mode" => $res_transactions[$i]['transfer_mode'],
			"transaction_number" => $res_transactions[$i]['transaction_number'],
			"amount" => "<i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['amount'],
			"status" => "<button class='btn " . $btn . "' onclick=change_status(" . $res_transactions[$i]['request_money_id'] . ",'" . $res_transactions[$i]['status'] . "')>" . $res_transactions[$i]['status'] . "</button>",
		);

		$total_amount = $total_amount + $res_transactions[$i]['amount'];
	}
	$data[$row_transactions]['transaction_date'] = "";
	$data[$row_transactions]['user_name'] = "<b>Total Amount</b>";
	$data[$row_transactions]['cash_credit'] = "";
	$data[$row_transactions]['mode'] = "";
	$data[$row_transactions]['transaction_number'] = "";
	$data[$row_transactions]['amount'] = "<b><i class='fa fa-rupee-sign'></i> " . $total_amount . "</b>";
	$data[$row_transactions]['status'] = "";
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
