<?php
session_start();

include "include.php";
include "session.php";

pt($_POST);

if ($updte == 1) {
	$o1->route_detail_id = $_POST['route_detail_id'];
	if ($o1->route_detail_id > 0) {
		$o1 = $factory->get_object($o1->route_detail_id, "route_details", "route_detail_id");
	}
	$o1->route_type = "Member";
	$o1->user_id = $_POST['user_id'];
	$o1->user_name = get_username_from_id($o1->user_id);
	$o1->service_id = $_POST['service_id'];
	$o1->service_name = get_service_name($o1->service_id);
	$o1->provider_id = $_POST['provider_id'];
	$o1->provider = get_provider_name($o1->provider_id);
	$o1->amount_check = $_POST['amount_check'];
	$o1->amount_from = $_POST['amount_from'];
	$o1->amount_to = $_POST['amount_to'];
	$o1->api_id = $_POST['api_id'];
	$o1->api_name = get_api_name($o1->api_id);
	$o1->is_active = 1;

	if ($o1->route_detail_id > 0) {
		$o1->route_detail_id = $updater->update_object($o1, "route_details");
	} else {
		$o1->route_detail_id = $insertor->insert_object($o1, "route_details");
	}

	header("location:route_member_details.php?msgid=3&aid=$o1->user_id");
} else {
	header("location:routes.php?msgid=4");
}
?>