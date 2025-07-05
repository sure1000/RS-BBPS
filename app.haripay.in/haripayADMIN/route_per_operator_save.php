<?php
session_start();
$ajax_logout = 1;
include "include.php";
include "session.php";

if (isset($_POST['provider_id'])) {
	$provider_id = $_POST['provider_id'];
	$api_id = $_POST['api_id'];
	$api_name = get_api_name($api_id);

	$sql = "Update providers set api_id = " . $api_id . ", api_name = '" . $api_name . "' where provider_id = " . $provider_id;
	$res = setXbyY($sql);

	$result['error'] = 0;
	$result['error_msg'] = "Api Changed Successfully";

} else {
	$result['error'] = 1;
	$result['error_msg'] = "Something went wrong. Please try again";
}

echo json_encode($result);
?>