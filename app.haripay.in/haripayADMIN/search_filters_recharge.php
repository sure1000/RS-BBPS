<?php
session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

unset($_SESSION['recharge_search']);

$service_id = $_POST['service_id'];
$provider_id = $_POST['provider_id'];
$status = $_POST['status'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$api_id = $_POST['api_id'];
$user_name = $_POST['user_id_search'];
$search_val = $_POST['search_val'];


if ($service_id > 0) {
	$_SESSION['recharge_search']['service_id'] = $service_id;
}
if ($provider_id > 0) {
	$_SESSION['recharge_search']['provider_id'] = $provider_id;
}
if ($status != "0") {
	$_SESSION['recharge_search']['status'] = $status;
}
if ($from_date != "") {
	$_SESSION['recharge_search']['from_date'] = $from_date;
}
if ($to_date != "") {
	$_SESSION['recharge_search']['to_date'] = $to_date;
}
if ($api_id > 0) {
	$_SESSION['recharge_search']['api_id'] = $api_id;
}
if ($user_name  > 0) {
	$_SESSION['recharge_search']['user_name'] = $user_name;
}
if ($search_val != "") {
	$_SESSION['recharge_search']['search_val'] = $search_val;
}


?>