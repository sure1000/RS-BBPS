<?php
session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

unset($_SESSION['search_ledger']);

$service_id = $_POST['service_id'];
$provider_id = $_POST['provider_id'];
$transaction_type = $_POST['transaction_type'];
$status = $_POST['status'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$user_id = $_POST['user_id'];
$api_id = $_POST['api_id'];


if ($api_id > 0) {
	$_SESSION['search_ledger']['api_id'] = $api_id;
}
if ($user_id > 0) {
	$_SESSION['search_ledger']['user_id'] = $user_id;
}
if ($service_id > 0) {
	$_SESSION['search_ledger']['service_id'] = $service_id;
}
if ($provider_id > 0) {
	$_SESSION['search_ledger']['provider_id'] = $provider_id;
}
if ($transaction_type != "0") {
	$_SESSION['search_ledger']['transaction_type'] = $transaction_type;
}
if ($status != "0") {
	$_SESSION['search_ledger']['status'] = $status;
}
if ($from_date != "") {
	$_SESSION['search_ledger']['from_date'] = $from_date;
}
if ($to_date != "") {
	$_SESSION['search_ledger']['to_date'] = $to_date;
}


?>