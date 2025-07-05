<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

if ($updte == 1) {
	for ($i = 0; $i < 5; $i++) {
		$rid = "route_id_" . $i;

		$o1->route_id = $_POST[$rid];

		$o1 = $factory->get_object($o1->route_id, "routes", "route_id");
		$rf = "route_for_" . $o1->route_id;
		$o1->route_for = $_POST[$rf];
		$api1 = "api_id_1_" . $o1->route_id;
		$o1->api_1 = $_POST[$api1];
		$o1->api_1_name = get_api_name($o1->api_1);
		$api2 = "api_id_2_" . $o1->route_id;
		$o1->api_2 = $_POST[$api2];
		$o1->api_2_name = get_api_name($o1->api_2);
		$api3 = "api_id_3_" . $o1->route_id;
		$o1->api_3 = $_POST[$api3];
		$o1->api_3_name = get_api_name($o1->api_3);
		$pr = "priority_" . $o1->route_id;
		$o1->priority = $_POST[$pr];
		$o1->is_active = 1;

		$o1->route_id = $updater->update_object($o1, "routes");

		unset($o1);
	}

	$msg_id = 3;
}

$sql = "Select * from routes where is_active = 1 order by priority";
$res = getXbyY($sql);
$rows = count($res);

include "html/includes/header.php";
include "html/routes.php";
include "html/includes/footer.php";
include "js/routes.js";
?>