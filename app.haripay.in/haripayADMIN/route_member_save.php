<?php
session_start();
$ajax_logout = 1;
include "include.php";
include "session.php";

if (isset($_POST['updte1'])) {
	$updte = $_POST['updte1'];
} else {
	$updte = 0;
}

if ($updte == 1) {
	$user_id = $_POST['user_id'];
	$total_routes = $_POST['total_routes'];
	$keys = array_keys($_POST);
	for ($i = 0; $i < $total_routes; $i++) {
		$rid = explode("_", $keys[$i]);
		$key_val = "priority_" . $rid[1];

		$sql = "Update route_details set priority = " . $_POST[$key_val] . " where route_detail_id = " . $rid[1];
		$res = setXbyY($sql);

	}
	$result['error'] = 0;
	$result['error_msg'] = "Routes Updated Successfully";
} else {
	$result['error'] = 1;
	$result['error_msg'] = "Something went wrong. Please Try Again";
}

echo json_encode($result);
?>