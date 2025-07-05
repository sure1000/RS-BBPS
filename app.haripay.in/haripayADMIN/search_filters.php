<?php
session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

unset($_SESSION['search']);

$service_id = $_POST['service_id'];
$provider_id = $_POST['provider_id'];
$transaction_type = $_POST['transaction_type'];
$status = $_POST['status'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$search_val = $_POST['search_val'];
$opid = $_POST['opid'];
$api_id = $_POST['api_id'];
$user_name = $_POST['user_name'];
$user_id_search = $_POST['user_id_search'];
$ip_address = $_POST['ip_address'];
$plan_id = $_POST['plan_id'];
$is_active = $_POST['is_active'];

if ($service_id > 0) {
	$_SESSION['search']['service_id'] = $service_id;
}
if ($provider_id > 0) {
	$_SESSION['search']['provider_id'] = $provider_id;
}
if ($transaction_type != "0") {
	$_SESSION['search']['transaction_type'] = $transaction_type;
}
if ($status != "0") {
	$_SESSION['search']['status'] = $status;
}
if ($from_date != "") {
	$_SESSION['search']['from_date'] = $from_date;
}
if ($to_date != "") {
	$_SESSION['search']['to_date'] = $to_date;
}
if ($search_val != "") {
	$_SESSION['search']['search_val'] = $search_val;
}
if ($opid != "") {
	$_SESSION['search']['opid'] = $opid;
}
if ($api_id != "0") {
	$_SESSION['search']['api_id'] = $api_id;
}
if ($user_name != "") {
	$_SESSION['search']['user_name'] = $user_name;
}
if ($user_id_search  > 0) {
	$_SESSION['search']['user_id_search'] = $user_id_search;
}
if ($ip_address != "") {
	$_SESSION['search']['ip_address'] = $ip_address;
}
if ($plan_id != "") {
	$_SESSION['search']['plan_id'] = $plan_id;
}
if ($is_active != "") {
	$_SESSION['search']['is_active'] = $is_active;
}

?>