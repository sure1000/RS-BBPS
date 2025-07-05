<?php

session_start();
include "include.php";
include "session.php";

$sql = "Select * from api_ip_key where user_id = " . $o->user_id . " and is_active = 1 limit 0,1";
$res = getXbyY($sql);
$rows = count($res);

if ($rows == 0) {
	$res[0]['authorization_key'] = "Authorization Key";
}

include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/api_balance_check.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";

?>