<?php

session_start();
include "include.php";
include "session.php";

$reqid = reference_number();

$sql = "Select * from api_ip_key where user_id = " . $o->user_id . " and is_active = 1 limit 0,1";
$res = getXbyY($sql);
$rows = count($res);

if ($rows == 0) {
	$res[0]['api_token'] = "Authorization Key";
	$res[0]['ip_address'] = "Your Server IP";
} else {
	$res[0]['api_token'] = $res[0]['authorization_key'];
}

include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/api_recharge_status.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";

?>