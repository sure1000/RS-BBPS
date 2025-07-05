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

$trigger_from_date = "1=1";
$trigger_to_date = "1=1";

if (isset($_SESSION['search'])) {
	if (isset($_SESSION['search']['from_date'])) {
		$trigger_from_date = "transaction_date >= '" . $_SESSION['search']['from_date'] . "'";
	}
	if (isset($_SESSION['search']['to_date'])) {
		$trigger_to_date = "transaction_date <= '" . $_SESSION['search']['to_date'] . "'";
	}
	$from_date = $_SESSION['search']['from_date'];
	$to_date = $_SESSION['search']['to_date'];
} else {
	$from_date = "";
	$to_date = "";
}

$triggers = $trigger_from_date . " and " . $trigger_to_date;

$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
//pt($_POST);

$sql = "Select transaction_type, provider_type, sum(amount) as turnover, provider_id, count(wallet_id) as quantity from wallet where (transaction_type = 'Commission') and user_id = " . $o->user_id . " and (status = 'Success') and $triggers group by provider_type";
$res = getXbyY($sql);
$rows = count($res);

$total = 0;
$total_quantity = 0;
for ($i = 0; $i < $rows; $i++) {
	$total = $res[$i]['turnover'] + $total;
}
$total = round($total, 2);

if ($rows > 0) {

	for ($i = 0; $i < $rows; $i++) {
		$link = "transaction.php?provider_type=" . $res[$i]['provider_type'] . "&transaction_type=Commission&from=" . $from_date . "&to=" . $to_date;
		$per = round(($res[$i]['turnover'] / $total) * 100, 2) . " %";
		$total_quantity = $total_quantity + $res[$i]['quantity'];
		$data[] = array(
			"operator" => "<a href='" . $link . "'>" . $res[$i]['provider_type'] . "</a>",
			"transactions" => "<a href='" . $link . "'>" . $res[$i]['quantity'] . "</a>",
			"amount" => "<a href='" . $link . "'>" . round($res[$i]['turnover'], 2) . "</a>",
			"percentage" => "<a href='" . $link . "'>" . $per . "</a>",
		);
	}

	$data[] = array(
		"operator" => "<b>Total</b>",
		"transactions" => "<b>" . $total_quantity . "</b>",
		"amount" => "<b>" . round($total, 2) . "</b>",
		"percentage" => "<b>100%</b>",
	);

} else {
	$data = array();
}

## Response
$response = array(
	"draw" => intval($draw),
	"iTotalRecords" => $rows,
	"iTotalDisplayRecords" => $rows,
	"aaData" => $data,
);

echo json_encode($response);
?>
