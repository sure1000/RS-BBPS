<?php

session_start();

include "include.php";
include "session.php";

$charts = 1;
$kyc_id = $o->kyc_id;

$todays_date = todaysDate_only() . " 00:00:00";
$month_start = month_start();

$sdate = todaysDate_only() . " 00:00:00";
$edate = todaysDate();
$trigger_start_date = "transaction_date >= '" . $sdate . "'";
$trigger_end_date = "transaction_date <= '" . todaysDate() . "'";

$from_date = "";
$to_date = "";
if (isset($_POST['from_date'])) {
	$_POST['from_date'] = $_POST['from_date'] . " 00:00:00";
	$trigger_start_date = "transaction_date >= '" . $_POST['from_date'] . "'";
	$from_date = $_POST['from_date'];
	$start_date = $from_date;
} else {
	$start_date = $sdate;
}

if (isset($_POST['to_date'])) {
	if ($_POST['to_date'] == "") {
		$_POST['to_date'] = todaysDate();
	} else {
		$_POST['to_date'] = $_POST['to_date'] . " 23:59:59";
	}

	$trigger_end_date = "transaction_date <= '" . $_POST['to_date'] . "'";
	$to_date = $_POST['to_date'];
	$end_date = $to_date;
} else {
	$end_date = todaysDate();
}

if ($from_date != "" || $to_date != "") {
	if ($from_date == "") {
		$fdate = date('Y') . "-04-01";
	} else {
		$fdate = format_date_only($from_date);
	}
	if ($to_date == "") {
		$tdate = "Till Date";
	} else {
		$tdate = format_date_only($to_date);
	}
	$delivery_note = "From " . $fdate . " - " . $tdate;
} else {
	$delivery_note = "Today i.e. " . todaysDate_only();
}

$turnover = 0;
$revenue = 0;
$money_input = 0;
$money_reverse = 0;

//$sql_turnover = "Select transaction_type, sum(amount) as turnover from wallet where user_id = ".$o->user_id." and $trigger_start_date and $trigger_end_date and (status = 'Success' or status = 'Pending') group by transaction_type";
$sql_turnover = "Select transaction_type, sum(amount) as turnover from wallet where user_id = " . $o->user_id . " and $trigger_start_date and $trigger_end_date group by transaction_type";
$res_turnover = getXbyY($sql_turnover);
$rows_turnover = count($res_turnover);

for ($i = 0; $i < $rows_turnover; $i++) {
	if ($res_turnover[$i]['transaction_type'] == "Recharge" || $res_turnover[$i]['transaction_type'] == "R Offer Check" || $res_turnover[$i]['transaction_type'] == "User Info Check") {
		$turnover = $turnover + $res_turnover[$i]['turnover'];
	} else if ($res_turnover[$i]['transaction_type'] == "Refund") {
		$turnover = $turnover - $res_turnover[$i]['turnover'];
	} else if ($res_turnover[$i]['transaction_type'] == "Commission") {
		$revenue = $revenue + $res_turnover[$i]['turnover'];
	} else if ($res_turnover[$i]['transaction_type'] == "Recieve Money") {
		$money_input = $money_input + $res_turnover[$i]['turnover'];
	} else if ($res_turnover[$i]['transaction_type'] == "Reverse") {
		//if($res_turnover[$i][''])
	}
}

$turnover = round($turnover, 2);

$sql_input = "Select sum(amount) as investment from wallet where transaction_type = 'Recieve Money' and user_id = " . $o->user_id . " and $trigger_start_date and $trigger_end_date";
$res_input = getXbyY($sql_input);

$money_input = $res_input[0]['investment'];

if ($money_input == "") {
	$money_input = 0;
}

$sql_turnover_operator = "Select transaction_type, provider_type, sum(amount) as turnover from wallet where (transaction_type = 'Recharge' || transaction_type = 'R Offer Check' || transaction_type = 'User Info Check') and (status = 'Success' or status = 'Pending') and user_id = " . $o->user_id . " and $trigger_start_date and $trigger_end_date group by provider_type";
$res_turnover_operator = getXbyY($sql_turnover_operator);
$row_turnover_operator = count($res_turnover_operator);

$sql_colors = "Select * from services where is_active = 1";
$res_colors = getXbyY($sql_colors);
$row_colors = count($res_colors);

for ($i = 0; $i < $row_turnover_operator; $i++) {
	for ($j = 0; $j < $row_colors; $j++) {
		if ($res_turnover_operator[$i]['provider_type'] == $res_colors[$j]['service_name']) {
			$res_turnover_operator[$i]['color'] = $res_colors[$j]['colors'];
		}
	}
}

$labels_rev_operator = '[';
$data_rev_operator = '[';
$color_rev_operator = '[';
for ($i = 0; $i < $row_turnover_operator; $i++) {
	$labels_rev_operator .= '"' . $res_turnover_operator[$i]['provider_type'] . '"';
	$data_rev_operator .= '"' . round($res_turnover_operator[$i]['turnover'], 2) . '"';
	$color_rev_operator .= '"' . $res_turnover_operator[$i]['color'] . '"';
	if ($i < ($row_turnover_operator - 1)) {
		$labels_rev_operator .= ',';
		$data_rev_operator .= ',';
		$color_rev_operator .= ',';
	}
}
$labels_rev_operator .= ']';
$data_rev_operator .= ']';
$color_rev_operator .= ']';

$sql_revenue_operator = "Select transaction_type, provider_type, sum(amount) as turnover from wallet where (transaction_type = 'Commission') and (status = 'Success') and user_id = " . $o->user_id . " and $trigger_start_date and $trigger_end_date group by provider_type";
$res_revenue_operator = getXbyY($sql_revenue_operator);
$row_revenue_operator = count($res_revenue_operator);

for ($i = 0; $i < $row_revenue_operator; $i++) {
	for ($j = 0; $j < $row_colors; $j++) {
		if ($res_revenue_operator[$i]['provider_type'] == $res_colors[$j]['service_name']) {
			$res_revenue_operator[$i]['color'] = $res_colors[$j]['colors'];
		}
	}
}

$labels_comm_operator = '[';
$data_comm_operator = '[';
$color_comm_operator = '[';
for ($i = 0; $i < $row_revenue_operator; $i++) {
	$labels_comm_operator .= '"' . $res_revenue_operator[$i]['provider_type'] . '"';
	$data_comm_operator .= '"' . round($res_revenue_operator[$i]['turnover'], 2) . '"';
	$color_comm_operator .= '"' . $res_revenue_operator[$i]['color'] . '"';
	if ($i < ($row_revenue_operator - 1)) {
		$labels_comm_operator .= ',';
		$data_comm_operator .= ',';
		$color_comm_operator .= ',';
	}
}
$labels_comm_operator .= ']';
$data_comm_operator .= ']';
$color_comm_operator .= ']';

$sql_disputes = "Select sum(amount) as amount from wallet where user_id = " . $o->user_id . " and disputed = 'Yes'";
$res_disputes = getXbyY($sql_disputes);

$sql_opertor_business = "Select provider_type, sum(amount) as turnover, count(wallet_id) as quantity from wallet where (transaction_type = 'Recharge' or transaction_type = 'R Offer Check' or transaction_type = 'User Info Check') and user_id = " . $o->user_id . " and (status = 'Success' or status = 'Pending') and $trigger_start_date and $trigger_end_date group by provider_type";
$res_opertor_business = getXbyY($sql_opertor_business);
$rows_opertor_business = count($res_opertor_business);

$total_business = 0;
$total_quantity = 0;
for ($i = 0; $i < $rows_opertor_business; $i++) {
	$total_business = $total_business + $res_opertor_business[$i]['turnover'];
	$total_quantity = $total_quantity + $res_opertor_business[$i]['quantity'];
}

for ($i = 0; $i < $rows_opertor_business; $i++) {
	$res_opertor_business[$i]['percentage'] = round(($res_opertor_business[$i]['turnover'] / $total_business) * 100, 2);
}

$sql_opertor_revenue = "Select provider_type, sum(amount) as turnover, count(wallet_id) as quantity from wallet where (transaction_type = 'Commission') and user_id = " . $o->user_id . " and (status = 'Success') and $trigger_start_date and $trigger_end_date group by provider_type";
$res_opertor_revenue = getXbyY($sql_opertor_revenue);
$rows_opertor_revenue = count($res_opertor_revenue);

$total_revenue = 0;
$total_revenue_quantity = 0;
for ($i = 0; $i < $rows_opertor_revenue; $i++) {
	$total_revenue = $total_revenue + $res_opertor_revenue[$i]['turnover'];
	$total_revenue_quantity = $total_revenue_quantity + $res_opertor_revenue[$i]['quantity'];
}

for ($i = 0; $i < $rows_opertor_revenue; $i++) {
	$res_opertor_revenue[$i]['percentage'] = round(($res_opertor_revenue[$i]['turnover'] / $total_revenue_quantity) * 100, 2);
}

$sql_operators = "Select provider_id, provider_name, provider_type, sum(amount) as turnover, count(wallet_id) as quantity from wallet where user_id = " . $o->user_id . " and (transaction_type = 'Recharge' or transaction_type = 'R Offer Check' or transaction_type = 'User Info Check') and (status = 'Success' or status = 'Pending') and $trigger_start_date and $trigger_end_date group by provider_id order by provider_type";
$res_operators = getXbyY($sql_operators);
$row_operators = count($res_operators);

$total_operator_amount = 0;

for ($i = 0; $i < $row_operators; $i++) {
	$total_operator_amount = $total_operator_amount + $res_operators[$i]['turnover'];
}

for ($i = 0; $i < $row_operators; $i++) {
	$res_operators[$i]['percentage'] = round(($res_operators[$i]['turnover'] / $total_operator_amount) * 100, 2);
}

$sql_operators_profit = "Select provider_id, provider_name, provider_type, sum(amount) as turnover, count(wallet_id) as quantity from wallet where user_id = " . $o->user_id . " and (transaction_type = 'Commission') and (status = 'Success' or status = 'Pending') and $trigger_start_date and $trigger_end_date group by provider_id order by provider_type";
$res_operators_profit = getXbyY($sql_operators_profit);
$row_operators_profit = count($res_operators_profit);

$total_profit_amount = 0;

for ($i = 0; $i < $row_operators_profit; $i++) {
	$total_profit_amount = $total_profit_amount + $res_operators_profit[$i]['turnover'];
}

for ($i = 0; $i < $row_operators_profit; $i++) {
	$res_operators_profit[$i]['percentage'] = round(($res_operators_profit[$i]['turnover'] / $total_profit_amount) * 100, 2);
}

$sql_recharges = "Select status, transaction_type, sum(amount) as amount, count(wallet_id) as quantity from wallet where user_id = " . $o->user_id . " and $trigger_start_date and $trigger_end_date and transaction_type = 'Recharge' group by status";
$res_recharges = getXbyY($sql_recharges);
$row_recharges = count($res_recharges);

//pt($res_recharges);

$success['amount'] = 0;
$success['quantity'] = 0;
$failed['amount'] = 0;
$failed['quantity'] = 0;
$pending['amount'] = 0;
$pending['quantity'] = 0;

for ($i = 0; $i < $row_recharges; $i++) {
	if ($res_recharges[$i]['status'] == "Success") {
		$success['amount'] = $res_recharges[$i]['amount'];
		$success['quantity'] = $res_recharges[$i]['quantity'];
	} else if ($res_recharges[$i]['status'] == "Failed") {
		$failed['amount'] = $res_recharges[$i]['amount'];
		$failed['quantity'] = $res_recharges[$i]['quantity'];
	} else if ($res_recharges[$i]['status'] == "Pending") {
		$pending['amount'] = $res_recharges[$i]['amount'];
		$pending['quantity'] = $res_recharges[$i]['quantity'];
	}
}

//pt($res_recharges);
$sql_refunds = "Select sum(amount) as amount, count(wallet_id) as quantity from wallet where transaction_type = 'Refund' and user_id = " . $o->user_id . " and $trigger_start_date and $trigger_end_date";
$res_refunds = getXbyY($sql_refunds);

if ($res_refunds[0]['amount'] == "") {
	$res_refunds[0]['amount'] = 0;
	$res_refunds[0]['quantity'] = 0;
}

include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/index.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";
?>