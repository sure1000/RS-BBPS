<?php
session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

unset($_SESSION['search']);

$user_name = $_POST['user_name'];
$cash_credit = $_POST['cash_credit'];
$status = $_POST['status'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$transfer_mode = $_POST['transfer_mode'];
$transaction_number = $_POST['transaction_number'];

if ($user_name != "") {
	$_SESSION['search']['user_name'] = $user_name;
}
if ($cash_credit != "") {
	$_SESSION['search']['cash_credit'] = $cash_credit;
}
if ($status != "") {
	$_SESSION['search']['status'] = $status;
}
if ($from_date != "") {
	$_SESSION['search']['from_date'] = $from_date;
}
if ($to_date != "") {
	$_SESSION['search']['to_date'] = $to_date;
}
if ($transfer_mode != "") {
	$_SESSION['search']['transfer_mode'] = $transfer_mode;
}
if ($transaction_number != "") {
	$_SESSION['search']['transaction_number'] = $transaction_number;
}

?>