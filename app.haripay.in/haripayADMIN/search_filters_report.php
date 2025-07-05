<?php
session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

unset($_SESSION['report_search']);

$service_id = $_POST['service_id'];
$provider_id = $_POST['provider_id'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];




if ($service_id > 0) {
	$_SESSION['report_search']['service_id'] = $service_id;
}
if ($provider_id > 0) {
	$_SESSION['report_search']['provider_id'] = $provider_id;
}

if ($from_date != "") {
	$_SESSION['report_search']['from_date'] = $from_date;
}
if ($to_date != "") {
	$_SESSION['report_search']['to_date'] = $to_date;
}



?>