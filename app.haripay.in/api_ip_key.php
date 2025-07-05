<?php

session_start();
include "include.php";
include "session.php";

$tables = 1;

if ($updte == 1) {
	$o1->ip_address = $_POST['ip_address'];

	$sql_check = "Select count(api_ip_key_id) as api_keys from api_ip_key where user_id = " . $o->user_id . " and is_active = 1";
	$res_check = getXbyY($sql_check);

	if ($res_check[0]['api_keys'] < 5) {

		$sql_ip = "Select api_ip_key_id from api_ip_key where ip_address = '" . $o1->ip_address . "' and user_id = " . $o->user_id . " and is_active = 1";
		$res_ip = getXbyY($sql_ip);
		$row_ip = count($res_ip);

		if ($row_ip == 0) {
			$o1->user_id = $o->user_id;
			$o1->authorization_key = md5(reference_number());
			$o1->is_active = 1;

			$o1->api_ip_key_id = $insertor->insert_object($o1, "api_ip_key");

			$msg_id = 3;
		} else {
			$msg_id = 8;
		}

	}

	unset($_POST);
}

$sql = "Select * from api_ip_key where user_id = " . $o->user_id . " and is_active = 1";
$res = getXbyY($sql);
$rows = count($res);

include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/api_ip_key.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";

?>