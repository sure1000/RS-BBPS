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

$trigger_provider_type = "1=1";
$trigger_provider_id = "1=1";
$trigger_transaction_type = "(transaction_type = 'Commission')";
$trigger_status = "1=1";
$trigger_from_date = "1=1";
$trigger_to_date = "1=1";
$trigger_search_val = "1=1";

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
		$trigger_to_date = "transaction_date <= '" . $_SESSION['search']['to_date'] . "'";
	}
	if (isset($_SESSION['search']['search_val'])) {
		$trigger_search_val = "(mobile_number = '" . $_SESSION['search']['search_val'] . "' or ref_number = '" . $_SESSION['search']['search_val'] . "' or opid = '" . $_SESSION['search']['search_val'] . "')";
	}
}

$triggers = $trigger_provider_type . " and " . $trigger_provider_id . " and " . $trigger_transaction_type . " and " . $trigger_status . " and " . $trigger_from_date . " and " . $trigger_to_date . " and " . $trigger_search_val;

$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
//pt($_POST);

$sql_total = "Select count(wallet_id) as total_transactions from wallet where user_id = " . $o->user_id . " and (tds > 0 or gst > 0) and $triggers";
$res_total = getXbyY($sql_total);

$sql_transactions = "Select * from wallet where user_id = " . $o->user_id . " and (tds > 0 or gst > 0) and $triggers order by wallet_id desc limit $row ,$length";
//$sql_transactions = "Select * from wallet where user_id = ".$o->user_id." order by transaction_date DESC";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);

$total_actual_amount = 0;
$total_amount = 0;
$total_gst_amount = 0;
$total_tds_amount = 0;
$total_recharge_amount = 0;

if ($row_transactions > 0) {

	for ($i = 0; $i < $row_transactions; $i++) {
		$ttype = "<b>Recharge</b> -"
			. "<b>" . $res_transactions[$i]['mobile_number'] . " (" . $res_transactions[$i]['provider_type'] . ")</b><br />"
			. "Ref. No.: " . $res_transactions[$i]['ref_number'] . " / " . $res_transactions[$i]['opid'] . "<br />"
			. $res_transactions[$i]['transaction_details'] . " (" . $res_transactions[$i]['provider_name'] . ")<br />"
			. $res_transactions[$i]['recharge_path'] . " <b>(" . $res_transactions[$i]['ip_address'] . ")<br />";

		$total_actual_amount = $total_actual_amount + $res_transactions[$i]['comment'];
		$total_amount = $total_amount + $res_transactions[$i]['amount'];
		$total_gst_amount = $total_gst_amount + $res_transactions[$i]['gst'];
		$total_tds_amount = $total_tds_amount + $res_transactions[$i]['tds'];

		$ramount = round($res_transactions[$i]['comment'] - $res_transactions[$i]['amount'] - $res_transactions[$i]['tds'], 2);
		$total_recharge_amount = $total_recharge_amount + $ramount;

		$data[] = array(
			"transaction_date" => format_date($res_transactions[$i]['transaction_date']),
			"transaction_type" => $ttype,
			"actual_amount" => "<i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['comment'],
			"amount" => "<span class=" . $class . ">" . $sign . "<i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['amount'] . "</span>",
			"tds" => "<i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['tds'],
			"gst" => "<i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['gst'],
			"recharge_amount" => "<i class='fa fa-rupee-sign'></i> " . $ramount,
		);
	}
	$data[$i]['transaction_date'] = "";
	$data[$i]['transaction_type'] = "<b>Total</b>";
	$data[$i]['actual_amount'] = "<b><i class='fa fa-rupee-sign'></i> " . $total_actual_amount . "</b>";
	$data[$i]['amount'] = "<b><i class='fa fa-rupee-sign'></i> " . $total_amount . "</b>";
	$data[$i]['gst'] = "<b><i class='fa fa-rupee-sign'></i> " . $total_gst_amount . "</b>";
	$data[$i]['tds'] = "<b><i class='fa fa-rupee-sign'></i> " . $total_tds_amount . "</b>";
	$data[$i]['recharge_amount'] = "<b><i class='fa fa-rupee-sign'></i> " . $total_recharge_amount . "</b>";
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
