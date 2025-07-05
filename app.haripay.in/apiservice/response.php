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

if (isset($_GET['reqid'])) {
	$reqid = $_GET['reqid'];
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

	if ($row_auth == 1) {
		$sql = "Select * from wallet where transaction_type = 'Recharge' and ip_address = '" . $ip_address . "' and user_id = " . $o->user_id . " and ref_number = '" . $reqid . "'";
		$res = getXbyY($sql);
		$rows = count($res);

		if ($rows > 0) {
			unset($result['error']);
			unset($result['error_msg']);

			$result['status'] = $res[0]['status'];
			$result['reqid'] = $res[0]['ref_number'];
			$result['amount'] = $res[0]['amount'];
			$result['opid'] = $res[0]['opid'];

			if ($res[0]['status'] == "Success") {
				$sql_comm = "Select amount from wallet where parent_id = " . $res[0]['wallet_id'];
				$res_comm = getXbyY($sql_comm);
				$result['commission'] = $res_comm[0]['amount'];

			} else {
				$result['commission'] = 0;
			}

		} else {
			$result['error_msg'] = "No Matching Record found for reqid: " . $reqid;
			echo json_encode($result);
			die();
		}
	} else {
		echo json_encode($result);
		die();
	}
} else {
	echo json_encode($result);
	die();
}

echo json_encode($result);
?>