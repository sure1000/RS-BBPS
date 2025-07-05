<?php

session_start();
include "include.php";
include "session.php";

if ($updte == 1) {
	$rows = $_POST['total_rows'];

	for ($i = 0; $i < $rows; $i++) {
		$kid = "key_id_" . $i;
		$url = "call_back_url_" . $i;
		$o1->api_ip_key_id = $_POST[$kid];

		$o1->call_back_url = $_POST[$url];

		$sql = "Update api_ip_key set call_back_url = '" . $o1->call_back_url . "' where user_id = " . $o->user_id . " and is_active = 1 and api_ip_key_id = " . $o1->api_ip_key_id;
		$set = setXbyY($sql);

		$msg_id = 3;
	}

}

$sql = "Select * from api_ip_key where user_id = " . $o->user_id . " and is_active = 1";
$res = getXbyY($sql);
$rows = count($res);

$reqid = reference_number();

include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/api_call_back.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";

?>