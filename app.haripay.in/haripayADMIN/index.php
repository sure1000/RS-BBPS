<?php

session_start();
//die("rus");
include "include.php";
include "session.php";
$page_name ="index";
$charts = 1;

$todays_date = todaysDate_only() . " 00:00:00";
$month_start = month_start();

$sdate = todaysDate_only() . " 00:00:00";
$trigger_start_date = "transaction_date >= '" . $sdate . "'";
$trigger_end_date = "transaction_date <= '" . todaysDate() . "'";

$from_date = "";
$to_date = "";
if (isset($_POST['from_date'])) {
	$trigger_start_date = "transaction_date >= '" . $_POST['from_date'] . "'";
	$from_date = $_POST['from_date'];
}
if (isset($_POST['to_date'])) {
	$trigger_end_date = "transaction_date <= '" . $_POST['to_date'] . "'";
	$to_date = $_POST['to_date'];
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
	$delivery_note = "Today i.e. " . todaysDate_only();
	$from_date = todaysDate_only();
	$to_date = todaysDate_only();
}

$url_date = "from=" . $from_date . "&to=" . $to_date;

$turnover = 0;
$revenue = 0;
$money_input = 0;
$money_reverse = 0;
$api_top_up = 0;
$user_top_up = 0;

//$sql_turnover = "Select transaction_type, sum(amount) as turnover from wallet where user_id = ".$o->user_id." and $trigger_start_date and $trigger_end_date and (status = 'Success' or status = 'Pending') group by transaction_type";
$sql_turnover = "Select transaction_type, sum(amount) as turnover, sum(api_amount) as api_amount from wallet where $trigger_start_date and $trigger_end_date group by transaction_type";
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
		$user_top_up = $user_top_up + $res_turnover[$i]['turnover'];
	} else if ($res_turnover[$i]['transaction_type'] == "API Top up") {

		$api_top_up = $api_top_up + $res_turnover[$i]['api_amount'];
	}
}

$turnover = round($turnover, 2);
$revenue = round($revenue, 2);
$money_input = round($money_input, 2);

$sql_api_commission_total = "Select sum(api_amount) as api_amount from wallet where transaction_type = 'Commission' and $trigger_start_date and $trigger_end_date";
$res_api_commission_total = getXbyY($sql_api_commission_total);

if ($res_api_commission_total[0]['api_amount'] == "") {
	$res_api_commission_total[0]['api_amount'] = 0;
}

$profit_loss = round($res_api_commission_total[0]['api_amount'] - $revenue, 2);

if ($profit_loss < 0) {
	$bg_pl = "danger";
} else if ($profit_loss == 0) {
	$bg_pl = "warning";
} else {
	$bg_pl = "success";
}

$sql_input = "Select sum(amount) as investment from wallet where transaction_type = 'Recieve Money' and user_id = " . $o->user_id . " and $trigger_start_date and $trigger_end_date";
$res_input = getXbyY($sql_input);

$money_input = $res_input[0]['investment'];

if ($money_input == "") {
	$money_input = 0;
}
//User Balance Count Shiba Technology Start
$rt_users = "SELECT user_type,count(*) as total,sum(amount_balance) as amount FROM users WHERE 1 group by user_type";
$rtres_users = getXbyY($rt_users);
$rtres_users_total = array_column($rtres_users, 'total', 'user_type');
$rtres_users_amount = array_column($rtres_users, 'amount', 'user_type');
//echo '<pre>'; print_r($rtres_users_total); 	die;
if ($res_users[0]['qty'] == "") {
	$res_users[0]['qty'] = 0;
	$res_users[0]['credit_amount'] = 0;
	$res_users[0]['credit_limit'] = 0;
}
//User Balance Count Shiba Technology End
$sql_turnover_operator = "Select transaction_type, provider_type, sum(amount) as turnover, count(wallet_id) as quantity from wallet where (transaction_type = 'Recharge' || transaction_type = 'R Offer Check' || transaction_type = 'User Info Check') and (status = 'Success' or status = 'Pending') and $trigger_start_date and $trigger_end_date group by provider_type";
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

$total_business = 0;
$total_quantity = 0;
for ($i = 0; $i < $row_turnover_operator; $i++) {
	$total_business = $total_business + $res_turnover_operator[$i]['turnover'];
	$total_quantity = $total_quantity + $res_turnover_operator[$i]['quantity'];
}

for ($i = 0; $i < $row_turnover_operator; $i++) {
	$res_turnover_operator[$i]['percentage'] = round(($res_turnover_operator[$i]['turnover'] / $total_business) * 100, 2);
}

$labels_rev_operator = '[';
$data_rev_operator = '[';
$color_rev_operator = '[';
for ($i = 0; $i < $row_turnover_operator; $i++) {
	$labels_rev_operator .= '"' . $res_turnover_operator[$i]['provider_type'] . '"';
	$data_rev_operator .= '"' . round($res_turnover_operator[$i]['turnover'], 2) . '"';
	$color_rev_operator .= '"' . $res_turnover_operator[$i]['color'] . '"';
	//$color_rev_operator .= '"' . random_color() . '"';
	if ($i < ($row_turnover_operator - 1)) {
		$labels_rev_operator .= ',';
		$data_rev_operator .= ',';
		$color_rev_operator .= ',';
	}
}
$labels_rev_operator .= ']';
$data_rev_operator .= ']';
$color_rev_operator .= ']';

$sql_revenue_operator = "Select transaction_type, provider_type, sum(amount) as turnover, count(wallet_id) as quantity from wallet where (transaction_type = 'Commission') and (status = 'Success') and $trigger_start_date and $trigger_end_date group by provider_type";
$res_revenue_operator = getXbyY($sql_revenue_operator);
$row_revenue_operator = count($res_revenue_operator);

$total_revenue = 0;
$total_revenue_quantity = 0;
for ($i = 0; $i < $row_revenue_operator; $i++) {
	$total_revenue = $total_revenue + $res_revenue_operator[$i]['turnover'];
	$total_revenue_quantity = $total_revenue_quantity + $res_revenue_operator[$i]['quantity'];

	for ($j = 0; $j < $row_colors; $j++) {
		if ($res_revenue_operator[$i]['provider_type'] == $res_colors[$j]['service_name']) {
			$res_revenue_operator[$i]['color'] = $res_colors[$j]['colors'];
		}
	}
}

for ($i = 0; $i < $row_revenue_operator; $i++) {
	$res_revenue_operator[$i]['percentage'] = round(($res_revenue_operator[$i]['turnover'] / $total_revenue) * 100, 2);
}

$labels_rev_service = '[';
$data_rev_service = '[';
$color_rev_service = '[';
for ($i = 0; $i < $row_revenue_operator; $i++) {
	$labels_rev_service .= '"' . $res_revenue_operator[$i]['provider_type'] . '"';
	$data_rev_service .= '"' . round($res_revenue_operator[$i]['turnover'], 2) . '"';
	$color_rev_service .= '"' . $res_revenue_operator[$i]['color'] . '"';
	if ($i < ($row_revenue_operator - 1)) {
		$labels_rev_service .= ',';
		$data_rev_service .= ',';
		$color_rev_service .= ',';
	}
}
$labels_rev_service .= ']';
$data_rev_service .= ']';
$color_rev_service .= ']';

$sql_opertor_rev = "Select provider_name, provider_type, sum(amount) as turnover, count(wallet_id) as quantity from wallet where (transaction_type = 'Commission') and (status = 'Success') and $trigger_start_date and $trigger_end_date group by provider_name, provider_type";
$res_opertor_rev = getXbyY($sql_opertor_rev);
$rows_opertor_rev = count($res_opertor_rev);

$labels_operator_rev = '[';
$data_operator_rev = '[';
$color_operator_rev = '[';
for ($i = 0; $i < $rows_opertor_rev; $i++) {
	$labels_operator_rev .= '"' . $res_opertor_rev[$i]['provider_name'] . '(' . $res_opertor_rev[$i]['provider_type'] . ')' . '"';
	$data_operator_rev .= '"' . round($res_opertor_rev[$i]['turnover'], 2) . '"';
	$rcolor = random_color();
	$color_operator_rev .= '"' . $rcolor . '"';
	$res_opertor_rev[$i]['color'] = $rcolor;
	if ($i < ($rows_opertor_rev - 1)) {
		$labels_operator_rev .= ',';
		$data_operator_rev .= ',';
		$color_operator_rev .= ',';
	}
}
$labels_operator_rev .= ']';
$data_operator_rev .= ']';
$color_operator_rev .= ']';

$sql_business_user = "Select user_name, sum(amount) as turnover, count(wallet_id) as quantity from wallet where (transaction_type = 'Recharge' || transaction_type = 'R Offer Check' || transaction_type = 'User Info Check') and (status = 'Success') and $trigger_start_date and $trigger_end_date group by user_name";
$res_business_user = getXbyY($sql_business_user);
$rows_business_user = count($res_business_user);

$labels_business_user = '[';
$data_business_user = '[';
$color_business_user = '[';
for ($i = 0; $i < $rows_business_user; $i++) {
	$labels_business_user .= '"' . $res_business_user[$i]['user_name'] . '"';
	$data_business_user .= '"' . round($res_business_user[$i]['turnover'], 2) . '"';
	$rcolor = random_color();
	$color_business_user .= '"' . $rcolor . '"';
	$res_business_user[$i]['color'] = $rcolor;
	if ($i < ($rows_business_user - 1)) {
		$labels_business_user .= ',';
		$data_business_user .= ',';
		$color_business_user .= ',';
	}
}
$labels_business_user .= ']';
$data_business_user .= ']';
$color_business_user .= ']';

$sql_rev_user = "Select user_name, sum(amount) as turnover, count(wallet_id) as quantity from wallet where (transaction_type = 'Commission') and (status = 'Success') and $trigger_start_date and $trigger_end_date group by user_name";
$res_rev_user = getXbyY($sql_rev_user);
$rows_rev_user = count($res_rev_user);

$labels_rev_user = '[';
$data_rev_user = '[';
$color_rev_user = '[';
for ($i = 0; $i < $rows_rev_user; $i++) {
	$labels_rev_user .= '"' . $res_rev_user[$i]['user_name'] . '"';
	$data_rev_user .= '"' . round($res_rev_user[$i]['turnover'], 2) . '"';
	$rcolor = random_color();
	$color_rev_user .= '"' . $rcolor . '"';
	$res_business_user[$i]['color'] = $rcolor;
	if ($i < ($rows_rev_user - 1)) {
		$labels_rev_user .= ',';
		$data_rev_user .= ',';
		$color_rev_user .= ',';
	}
}
$labels_rev_user .= ']';
$data_rev_user .= ']';
$color_rev_user .= ']';

$sql_disputes = "Select sum(amount) as amount, count(wallet_id) as qty from wallet where disputed = 'Yes'";
$res_disputes = getXbyY($sql_disputes);

$sql_opertor_revenue = "Select provider_type, sum(amount) as turnover from wallet where (transaction_type = 'Commission') and user_id = " . $o->user_id . " and (status = 'Success') and $trigger_start_date and $trigger_end_date group by provider_type";
$res_opertor_revenue = getXbyY($sql_opertor_revenue);
$rows_opertor_revenue = count($res_opertor_revenue);

$sql_operators = "Select provider_id, provider_name, provider_type, sum(amount) as turnover from wallet where (transaction_type = 'Recharge' or transaction_type = 'R Offer Check' or transaction_type = 'User Info Check') and (status = 'Success' or status = 'Pending') and $trigger_start_date and $trigger_end_date group by provider_id order by provider_type, provider_name";
$res_operators = getXbyY($sql_operators);
$row_operators = count($res_operators);

$labels_turnover_operator = '[';
$data_turnvover_operator = '[';
$color_turnover_operator = '[';
for ($i = 0; $i < $row_operators; $i++) {
	$labels_turnover_operator .= '"' . $res_operators[$i]['provider_name'] . '(' . $res_operators[$i]['provider_type'] . ')' . '"';
	$data_turnvover_operator .= '"' . round($res_operators[$i]['turnover'], 2) . '"';
	$rcolor = random_color();
	$color_turnover_operator .= '"' . $rcolor . '"';
	$res_operators[$i]['color'] = $rcolor;
	if ($i < ($row_operators - 1)) {
		$labels_turnover_operator .= ',';
		$data_turnvover_operator .= ',';
		$color_turnover_operator .= ',';
	}
}
$labels_turnover_operator .= ']';
$data_turnvover_operator .= ']';
$color_turnover_operator .= ']';

$sql_operators_profit = "Select provider_id, provider_name, provider_type, sum(amount) as turnover from wallet where  (transaction_type = 'Commission') and (status = 'Success' or status = 'Pending') and $trigger_start_date and $trigger_end_date group by provider_id order by provider_type";
$res_operators_profit = getXbyY($sql_operators_profit);
$row_operators_profit = count($res_operators_profit);

$total_profit_amount = 0;

for ($i = 0; $i < $row_operators_profit; $i++) {
	$total_profit_amount = $total_profit_amount + $res_operators_profit[$i]['turnover'];
}

for ($i = 0; $i < $row_operators_profit; $i++) {
	$res_operators_profit[$i]['percentage'] = round(($res_operators_profit[$i]['turnover'] / $total_profit_amount) * 100, 2);
}

$sql_api_balance = "Select sum(api_balance) as api_balance from api where api_type = 'Recharge'";
$res_api_balance = getXbyY($sql_api_balance);

if ($res_api_balance[0]['api_balance'] == "") {
	$res_api_balance[0]['api_balance'] = 0;
}

$sql_requests = "Select sum(amount) as request_amount, count(request_money_id) as qty from request_money where status = 'Pending'";
$res_requests = getXbyY($sql_requests);

if ($res_requests[0]['request_amount'] == "") {
	$res_requests[0]['request_amount'] = 0;
	$res_requests[0]['qty'] = 0;
}

$sql_user_balance = "Select sum(amount_balance) as user_balance from users where is_active = 1";
$res_user_balance = getXbyY($sql_user_balance);

if ($res_user_balance[0]['user_balance'] == "") {
	$res_user_balance[0]['user_balance'] = 0;
}

$sql_sms = "Select api_balance from api where api_id = 1";
$res_sms = getXbyY($sql_sms);

if ($res_sms[0]['api_balance'] == "") {
	$res_sms[0]['api_balance'] = 0;
}

$sql_recharges = "Select status, transaction_type, sum(total_amount) as amount, count(wallet_id) as quantity from wallet where $trigger_start_date and $trigger_end_date and transaction_type = 'Recharge' group by status";
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
$sql_refunds = "Select sum(total_amount) as amount, count(wallet_id) as quantity from wallet where transaction_type = 'Refund' and $trigger_start_date and $trigger_end_date";
$res_refunds = getXbyY($sql_refunds);

if ($res_refunds[0]['amount'] == "") {
	$res_refunds[0]['amount'] = 0;
	$res_refunds[0]['quantity'] = 0;
}

$sql_users = "Select count(user_id) as qty, sum(credit_amount) as credit_amount, sum(credit_limit) as credit_limit from users where is_active = 1 and user_type != 'Admin'";
$res_users = getXbyY($sql_users);

if ($res_users[0]['qty'] == "") {
	$res_users[0]['qty'] = 0;
	$res_users[0]['credit_amount'] = 0;
	$res_users[0]['credit_limit'] = 0;
}

$sql_tds_gst = "Select sum(tds) as tds, sum(gst) as gst from wallet where $trigger_start_date and $trigger_end_date";
$res_tds_gst = getXbyY($sql_tds_gst);

if ($res_tds_gst[0]['tds'] == "") {
	$res_tds_gst[0]['tds'] = 0;
}
if ($res_tds_gst[0]['gst'] == "") {
	$res_tds_gst[0]['gst'] = 0;
}

$sql_api_business = "Select api_name, sum(api_amount) as api_amount, count(wallet_id) as quantity, transaction_type from wallet where $trigger_start_date and $trigger_end_date and (transaction_type = 'Recharge' or transaction_type = 'R Offer Check' or transaction_type = 'User Info Check') and (status = 'Success' or status = 'Pending') group by api_name";
$res_api_business = getXbyY($sql_api_business);
$rows_api_business = count($res_api_business);

$total_api_business = 0;
$total_api_quantity = 0;

for ($i = 0; $i < $rows_api_business; $i++) {
	$total_api_business = $total_api_business + $res_api_business[$i]['api_amount'];
	$total_api_quantity = $total_api_quantity + $res_api_business[$i]['quantity'];
}

for ($i = 0; $i < $rows_api_business; $i++) {
	$res_api_business[$i]['percentage'] = round(($res_api_business[$i]['api_amount'] / $total_api_business) * 100, 2);
}

$sql_api_commission = "Select api_name, api_id, sum(api_amount) as api_amount, count(wallet_id) as quantity, transaction_type from wallet where $trigger_start_date and $trigger_end_date and (transaction_type = 'Commission') and (status = 'Success') group by api_name";
$res_api_commission = getXbyY($sql_api_commission);
$rows_api_commission = count($res_api_commission);

$total_api_commission = 0;
$total_api_quantity_commission = 0;

for ($i = 0; $i < $rows_api_commission; $i++) {
	$total_api_commission = $total_api_commission + $res_api_commission[$i]['api_amount'];
	$total_api_quantity_commission = $total_api_quantity_commission + $res_api_commission[$i]['quantity'];
}

for ($i = 0; $i < $rows_api_commission; $i++) {
	$res_api_commission[$i]['percentage'] = round(($res_api_commission[$i]['api_amount'] / $total_api_commission) * 100, 2);
}

include "html/includes/header.php";
include "html/index.php";
include "html/includes/footer.php";
?>