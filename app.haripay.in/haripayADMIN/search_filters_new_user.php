<?php
session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

unset($_SESSION['search_user_new']);

$user_type = $_POST['user_type'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];


if ($user_type != "0") {
	$_SESSION['search_user_new']['user_type'] = $user_type;
}
if ($from_date != "") {
	$_SESSION['search_user_new']['from_date'] = $from_date;
}
if ($to_date != "") {
	$_SESSION['search_user_new']['to_date'] = $to_date;
}

?>