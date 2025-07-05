<?php
session_start();

include "include.php";
include "session.php";

if (isset($_GET['aid'])) {
	$o1->service_id = $_GET['aid'];
} else {
	$o1->service_id = 0;
}

if ($o1->service_id > 0) {
	$o1 = $factory->get_object($o1->service_id, "services", "service_id");
} else {
	$o1->is_active = 1;
}

if ($updte == 1) {
	$o1->service_name = $_POST['service_name'];
	$o1->api_id = $_POST['api_id'];
	$o1->api_name = get_api_name($o1->api_id);
	$o1->is_active = $_POST['is_active'];

	if ($o1->service_id > 0) {
		$o1->service_id = $updater->update_object($o1, "services");
	} else {
		$o1->service_id = $insertor->insert_object($o1, "services");
	}

	header("location:services.php?msgid=3");
}

include "html/includes/header.php";
include "html/service_details.php";
include "html/includes/footer.php";
?>