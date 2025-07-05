<?php

include "include.php";
$result['error'] = 1;
$result['error_msg'] = "Invalid Parameters";

if (isset($_GET['uname'])) {
	$uname = $_GET['uname'];
} else {
	echo json_encode($result);
	die();
}

if (isset($_GET['api_token'])) {
	$api_token = $_GET['api_token'];
} else {
	echo json_encode($result);
	die();
}

$ip_address = $_SERVER['REMOTE_ADDR'];

$sql_user = "Select user_id from users where user_name = '" . $uname . "' and is_active = 1";
$res_user = getXbyY($sql_user);
$row_users = count($res_user);

if ($row_users == 1) {
	$o = $factory->get_object($res_user[0]['user_id'], "users", "user_id");

	$sql_auth = "Select * from api_ip_key where user_id = " . $o->user_id . " and ip_address = '" . $ip_address . "' and authorization_key = '" . $api_token . "' and is_active = 1";
	$res_auth = getXbyY($sql_auth);
	$row_auth = count($res_auth);

	unset($result['error']);
	unset($result['error_msg']);

	$result['balance'] = $o->amount_balance;
} else {
	echo json_encode($result);
	die();
}

echo json_encode($result);
?>