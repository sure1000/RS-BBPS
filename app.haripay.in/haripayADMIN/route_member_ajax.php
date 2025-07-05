<?php
session_start();
$ajax_logout = 1;
include "include.php";
include "session.php";

if ($updte == 1) {
	$o1 = $factory->get_object($_POST['route_detail_id'], "route_details", "route_detail_id");

	$result['service_id'] = $o1->service_id;
	$result['provider_id'] = $o1->provider_id;
	$result['amount_check'] = $o1->amount_check;
	$result['api_id'] = $o1->api_id;
	$result['amount_from'] = $o1->amount_from;
	$result['amount_to'] = $o1->amount_to;
	$result['error'] = 0;
} else {
	$result['error'] = 1;
	$result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>