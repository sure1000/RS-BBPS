<?php
session_start();
$ajax_logout = 1;
include "include.php";
include "session.php";

if (isset($_POST['service_id'])) {
	$service_id = $_POST['service_id'];
	$api_id = $_POST['api_id'];
	$api_name = get_api_name($api_id);

	$sql = "Update services set api_id = " . $api_id . ", api_name = '" . $api_name . "' where service_id = " . $service_id;
	$res = setXbyY($sql);

	$result['error'] = 0;
	$result['error_msg'] = "Api Changed Successfully";

} else {
	$result['error'] = 1;
	$result['error_msg'] = "Something went wrong. Please try again";
}

echo json_encode($result);
?>