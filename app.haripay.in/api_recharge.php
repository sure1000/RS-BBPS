<?php

session_start();
include "include.php";
include "session.php";

$sql = "Select * from api_ip_key where user_id = " . $o->user_id . " and is_active = 1 limit 0,1";
$res = getXbyY($sql);
$rows = count($res);

if ($rows == 0) {
	$res[0]['api_token'] = "Authorization Key";
	$res[0]['ip_address'] = "Your Server IP";
} else {
	$res[0]['api_token'] = $res[0]['authorization_key'];
}

$reqid = reference_number();
$reqid1 = reference_number();
$reqid2 = reference_number();

$url_prepaid = $res_site[0]['site_url'] . "/apiservice/recharge.php?uname=" . $o->user_name . "&api_token=" . $res[0]['api_token'] . "&operator=4&circle=18&number=9337692413&amount=11&reqid=" . $reqid;

$url_postpaid = $res_site[0]['site_url'] . "/apiservice/recharge.php?uname=" . $o->user_name . "&api_token=" . $res[0]['api_token'] . "&operator=9&circle=18&number=9216000700&amount=20&reqid=" . $reqid1;

$url_dth = $res_site[0]['site_url'] . "/apiservice/recharge.php?uname=" . $o->user_name . "&api_token=" . $res[0]['api_token'] . "&operator=16&number=1006300000&amount=20&reqid=" . $reqid2;

include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/api_recharge.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";

?>