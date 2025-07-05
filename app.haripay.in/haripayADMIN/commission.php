<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

unset($_SESSION['search']);

if (isset($_GET['from'])) {
	$from_date = $_GET['from'];
} else {
	$from_date = "";
}
if (isset($_GET['to'])) {
	$to_date = $_GET['to'];
} else {
	$to_date = "";
}

if ($from_date != "") {
	$_SESSION['search']['from_date'] = $from_date;
}
if ($to_date != "") {
	$_SESSION['search']['to_date'] = $to_date;
}

if (isset($_GET['service'])) {
	$service = $_GET['service'];
} else {
	$service = "";
}

$service_id = "0";
if ($service != "") {
	$sql_service = "Select service_id from services where service_name = '" . $service . "' and is_active = 1";
	$res_service = getXbyY($sql_service);
	$row_service = count($res_service);

	if ($row_service > 0) {
		$_SESSION['search']['service_id'] = $res_service[0]['service_id'];
		$service_id = $res_service[0]['service_id'];
	}
}

if (isset($_GET['api_id'])) {
	$api_id = $_GET['api_id'];
} else {
	$api_id = "0";
}

if ($api_id > 0) {
	$_SESSION['search']['api_id'] = $api_id;
}

include "html/includes/header.php";
include "html/commission.php";
include "html/includes/footer.php";
include "js/commission.js";

?>