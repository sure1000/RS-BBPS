<?php
session_start();

include "include.php";
include "session.php";

if (isset($_POST['updte'])) {
	$o1->route_detail_id = $_POST['route_detail_id'];

	if ($o1->route_detail_id > 0) {
		$o1 = $factory->get_object($o1->route_detail_id, "route_details", "route_detail_id");
	}

	$o1->route_type = "Amount";

	$o1->amount_from = $_POST['amount_from'];
	if ($_POST['amount_to'] == "") {
		$o1->amount_to = $_POST['amount_from'];
	} else {
		$o1->amount_to = $_POST['amount_to'];
	}

	$o1->api_id = $_POST['api_id'];
	$o1->api_name = get_api_name($o1->api_id);
	$o1->is_active = 1;

	if ($o1->route_detail_id > 0) {
		$o1->route_detail_id = $updater->update_object($o1, "route_details");
	} else {
		$o1->route_detail_id = $insertor->insert_object($o1, "route_details");
	}
	header("location: route_per_amount.php?msgid=3");
} else {
	header("location: route_per_amount.php?msgid=4");
}
?>