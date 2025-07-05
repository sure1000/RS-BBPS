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
		$service_id = $res[0]['service_id'];
	}
}

header("location:ledger.php?search_type=1");

?>