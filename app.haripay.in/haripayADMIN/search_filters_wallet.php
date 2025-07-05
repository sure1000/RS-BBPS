<?php

session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

unset($_SESSION['wallet_search']);

$status = $_POST['status'];
$transaction_type = $_POST['transaction_type'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$user_name = $_POST['user_id_search'];
$search_val = $_POST['search_val'];
if ($user_name > 0) {
    $_SESSION['wallet_search']['user_name'] = $user_name;
}
if ($status != "0") {
    $_SESSION['wallet_search']['status'] = $status;
}
if ($transaction_type != "0") {
    $_SESSION['wallet_search']['transaction_type'] = $transaction_type;
}
if ($from_date != "") {
    $_SESSION['wallet_search']['from_date'] = $from_date;
}
if ($to_date != "") {
    $_SESSION['wallet_search']['to_date'] = $to_date;
}
if ($search_val != "") {
    $_SESSION['wallet_search']['search_val'] = $search_val;
}
?>