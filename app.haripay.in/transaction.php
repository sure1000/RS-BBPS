<?php

session_start();

include "include.php";
include "session.php";

unset($_SESSION['search']);

if (isset($_GET['provider_type'])) {
	$sql = "Select service_id from services where service_name = '" . $_GET['provider_type'] . "' and is_active = 1";
	$res = getXbyY($sql);
	$rows = count($res);

	if ($rows > 0) {
		$_SESSION['search']['service_id'] = $res[0]['service_id'];
	}
}

if (isset($_GET['provider_id'])) {
	$_SESSION['search']['provider_id'] = $_GET['provider_id'];
}

if (isset($_GET['transaction_type'])) {
	$_SESSION['search']['transaction_type'] = $_GET['transaction_type'];
}

if (isset($_GET['from'])) {
	$_SESSION['search']['from_date'] = $_GET['from'];
}

if (isset($_GET['to'])) {
	$_SESSION['search']['to_date'] = $_GET['to'];
}

if (isset($_GET['status'])) {
	$_SESSION['search']['status'] = $_GET['status'];
}

header("location:view_transactions.php");
?>