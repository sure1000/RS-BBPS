<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

if (isset($_POST['from_date'])) {
	$from = $_POST['from_date'];
} else {
	$from = todaysDate_only();
}

if (isset($_POST['to_date'])) {
	$to = $_POST['to_date'];
} else {
	$to = todaysDate();
}

if (todaysDate_only() == $to) {
	$to = todaysDate();
}

$sql = "Select sum(total_amount) as total_amount,provider_name, provider_type, transaction_type, sum(amount) as turnover, count(wallet_id) as qty, status from wallet where DATE(transaction_date) >= '" . $from . "' and DATE(transaction_date) <= '" . $to . "' and is_active = 1 and (transaction_type = 'Recharge' or transaction_type = 'R Offer Check' or transaction_type = 'User Info Check' or transaction_type = 'Refund' or transaction_type='Commission') group by provider_name, provider_type, transaction_type, status order by provider_name";
$res = getXbyY($sql);
$rows = count($res);

$j = -1;
for ($i = 0; $i < $rows; $i++) {
	if ($res[$i]['provider_name'] != $res[$i - 1]['provider_name'] or $res[$i]['provider_type'] != $res[$i - 1]['provider_type']) {
		$j++;
		$data[$j]['provider_name'] = $res[$i]['provider_name'];
		$data[$j]['provider_type'] = $res[$i]['provider_type'];
	}

	//$data[$j]['qty'] = $res[$i]['qty'];
	//$data[$j]['status'] =
	$dd = transaction_type_amount($res[$i]['transaction_type'], $res[$i]['status']);

	$type = $dd['type'];
	$data[$j][$type]['amount'] = $res[$i]['turnover'];
	$data[$j][$type]['total_amount'] = $res[$i]['total_amount'];
	$data[$j][$type]['qty'] = $res[$i]['qty'];

}

$rows = count($data);

$total_success = 0;
$total_success_qty = 0;
$total_pending = 0;
$total_pending_qty = 0;
$total = 0;
$total_amount = 0;
$total_qty = 0;
$total_failed = 0;
$total_failed_qty = 0;
$total_refund = 0;
$total_refund_qty = 0;
$total_revenue = 0;
$total_revenue_qty = 0;

include "html/includes/header.php";
include "html/business_operator.php";
include "html/includes/footer.php";
include "js/turnover_service.js";
?>