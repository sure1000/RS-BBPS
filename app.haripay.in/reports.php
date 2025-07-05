<?php

session_start();

include "include.php";
include "session.php";
$charts = 1;

$todays_date = todaysDate_only() . " 00:00:00";
$month_start = month_start();

$trigger_start_date = "transaction_date >= '" . date('Y') . "-04-01'";
$trigger_end_date = "transaction_date <= '" . todaysDate() . "'";

$from_date = "";
$to_date = "";
if (isset($_POST['from_date'])) {
	$trigger_start_date = "transaction_date >= '" . $_POST['from_date'] . "'";
	$from_date = $_POST['from_date'];
	$start_date = $_POST['from_date'] . " 00:00:00";
} else {
	$start_date = date('Y') . "-04-01 00:00:00";
}
if (isset($_POST['to_date'])) {
	if ($_POST['to_date'] == "") {
		$trigger_end_date = "transaction_date <= '" . todaysDate() . "'";
		$to_date = todaysDate();
		$end_date = todaysDate();
	} else {
		$trigger_end_date = "transaction_date <= '" . $_POST['to_date'] . "'";
		$to_date = $_POST['to_date'];
		$end_date = $_POST['to_date'] . " 24:00:00";
	}
} else {
	$end_date = todaysDate();
}

if ($from_date != "" || $to_date != "") {
	if ($from_date == "") {
		$fdate = date('Y') . "-04-01";
	} else {
		$fdate = format_date_without_br($from_date);
	}
	if ($to_date == "") {
		$tdate = "Till Date";
	} else {
		$tdate = format_date_without_br($to_date);
	}
	$delivery_note = "From " . $fdate . " - " . $tdate;
} else {
	$delivery_note = "Financial year " . date('Y') . "-" . (date('Y') + 1);
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

/* $sql_credit_input = "Select sum(amount) as credit_returned from wallet where transaction_type = 'Reverse' and cash_credit = 'Cash' and user_id = " . $o->user_id . " and comment = 'Credit Update' and $trigger_start_date and $trigger_end_date";
$res_credit_input = getXbyY($sql_credit_input);
$row_credit_input = count($res_credit_input);

if ($row_credit_input > 0) {
$money_input = $money_input + $res_credit_input[0]['credit_returned'];
} */

$sql_daily = "Select transaction_type, sum(amount) as business from wallet where user_id = " . $o->user_id . " and transaction_date >= '" . $todays_date . "' and (status = 'Success' or status = 'Pending') group by transaction_type";
$res_daily = getXbyY($sql_daily);
$rows_daily = count($res_daily);

for ($i = 0; $i < $rows_daily; $i++) {
	if ($res_daily[$i]['transaction_type'] == "Recharge") {
		$business_daily = $res_daily[$i]['business'];
	} else if ($res_daily[$i]['transaction_type'] == "Commission") {
		$commission_daily = $res_daily[$i]['business'];
	}
}

//echo month_current_financial_year();
$mm = month_current_financial_year();

$sql_earnings = "Select transaction_type, month_year, sum(amount) as earnings from wallet where user_id = '" . $o->user_id . "' and (transaction_type = 'Recharge' || transaction_type = 'R Offer Check' || transaction_type = 'User Info Check') and (status = 'Success' or status = 'Pending') and $trigger_start_date and $trigger_end_date group by month_year order by transaction_date DESC limit 0,12";
$res_earnings = getXbyY($sql_earnings);
$row_earnings = count($res_earnings);

for ($i = 0; $i < $row_earnings; $i++) {
	for ($j = 0; $j < 12; $j++) {
		if ($res_earnings[$i]['month_year'] == $mm[$j]['month']) {
			$mm[$j]['amount'] = $res_earnings[$i]['earnings'];
		}
	}
}

$chart_data = '[';
$labels = '[';
for ($i = 0; $i < 12; $i++) {
	$labels .= '"' . $mm[$i]['month'] . '"';
	$chart_data .= '"' . $mm[$i]['amount'] . '"';
	if ($i < 11) {
		$labels .= ',';
		$chart_data .= ',';
	}
}
$labels .= "]";
$chart_data .= "]";

$revenue_months = month_current_financial_year();
$sql_revenue = "Select transaction_type, month_year, sum(amount) as earnings from wallet where user_id = '" . $o->user_id . "' and (transaction_type = 'Commission') and (status = 'Success') and $trigger_start_date and $trigger_end_date group by month_year order by transaction_date DESC limit 0,12";
$res_revenue = getXbyY($sql_revenue);
$row_revenue = count($res_revenue);

for ($i = 0; $i < $row_revenue; $i++) {
	for ($j = 0; $j < 12; $j++) {
		if ($res_revenue[$i]['month_year'] == $revenue_months[$j]['month']) {
			$revenue_months[$j]['amount'] = $res_revenue[$i]['earnings'];
		}
	}
}

$chart_revenue = '[';
$labels_revenue = '[';
for ($i = 0; $i < 12; $i++) {
	$labels_revenue .= '"' . $revenue_months[$i]['month'] . '"';
	$chart_revenue .= '"' . $revenue_months[$i]['amount'] . '"';
	if ($i < 11) {
		$labels_revenue .= ',';
		$chart_revenue .= ',';
	}
}
$labels_revenue .= "]";
$chart_revenue .= "]";

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
include "templates/" . $res_template[0]['template_name'] . "/reports.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";
?>