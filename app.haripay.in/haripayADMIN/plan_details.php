<?php

session_start();
include "include.php";
include "session.php";

if (isset($_GET['aid'])) {
	$o1->user_plan_id = $_GET['aid'];
} else {
	$o1->user_plan_id = 0;
}

if ($o1->user_plan_id > 0) {
	$o1 = $factory->get_object($o1->user_plan_id, "user_plans", "user_plan_id");
} else {
	$o1->is_active = 1;
}

if ($updte == 1) {
	$o1->plan_name = $_POST['plan_name'];
	$o1->plan_type = $_POST['plan_type'];
	//$o1->validity = $_POST['validity'];
	//$o1->amount = $_POST['amount'];
	$o1->is_active = $_POST['is_active'];

	if ($o1->user_plan_id > 0) {
		$o1->user_plan_id = $updater->update_object($o1, "user_plans");
	} else {
		$o1->user_plan_id = $insertor->insert_object($o1, "user_plans");
	}

	unset($_POST);
	header("location:plans.php?msgid=3");
}

include "html/includes/header.php";
include "html/plan_details.php";
include "html/includes/footer.php";
?>

