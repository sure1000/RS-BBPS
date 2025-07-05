<?php
session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

unset($_SESSION['search']);

$cash_credit = $_POST['cash_credit'];
$team_member = $_POST['team_member'];
$transaction_type = $_POST['transaction_type'];
$status = $_POST['status'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];
$search_val = $_POST['search_val'];

if($cash_credit != "0"){
    $_SESSION['search']['cash_credit'] = $cash_credit;
}
if($team_member != "0"){
    $_SESSION['search']['team_member'] = $team_member;
}
if($transaction_type != "0"){
    $_SESSION['search']['transaction_type'] = $transaction_type;
}
if($status != "0"){
    $_SESSION['search']['status'] = $status;
}
if($from_date != ""){
    $_SESSION['search']['from_date'] = $from_date;
}
if($to_date != ""){
    $_SESSION['search']['to_date'] = $to_date;
}
if($search_val != ""){
    $_SESSION['search']['search_val'] = $search_val;
}

?>