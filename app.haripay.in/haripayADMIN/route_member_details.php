<?php
session_start();
include "include.php";
include "session.php";

if (isset($_GET['aid'])) {
	$o1->user_id = $_GET['aid'];
} else {
	$o1->user_id = 0;
}

if ($o1->user_id == 0 || $o1->user_id == "") {
	header("location:route_members.php?msgid=4");
}
/*
$sql = "Select * from providers where is_active = 1 order by service_id";
$res = getXbyY($sql);
$rows = count($res);

$j = 0;
$k = 0;
for ($i = 0; $i < $rows; $i++) {
if ($i == 0) {
$result[$j]['service_id'] = $res[$i]['service_id'];
$result[$j]['service_name'] = $res[$i]['service'];
$result[$j]['service']->provider[$k] = $res[$i]['provider_id'];
$result[$j]['service']->provider_name[$k] = $res[$i]['provider'];
} else {
if ($res[$i]['service_id'] == $res[$i - 1]['service_id']) {
$k++;
} else {
$k = 0;
$j++;
$result[$j]['service_id'] = $res[$i]['service_id'];
$result[$j]['service_name'] = $res[$i]['service'];

}
$result[$j]['service']->provider[$k] = $res[$i]['provider_id'];
$result[$j]['service']->provider_name[$k] = $res[$i]['provider'];
}
}

//pt($result);
$result_count = $j;
 */

$sql_routes = "Select * from route_details where route_type = 'Member' and user_id = " . $o1->user_id . " order by priority";
$res_routes = getXbyY($sql_routes);
$row_routes = count($res_routes);

if ($row_routes == 0) {
	$row_routes = 1;
	$res_routes[0]['service_name'] = "All";
	$res_routes[0]['provider'] = "All";
	$res_routes[0]['amount_check'] = "All";
	$res_routes[0]['api_name'] = "Any";
	$res_routes[0]['route_detail_id'] = 0;
}

include "html/includes/header.php";
include "html/route_member_details.php";
include "html/includes/footer.php";
include "js/route_member_details.js";
?>