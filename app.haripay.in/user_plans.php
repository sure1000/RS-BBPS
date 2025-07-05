<?php
session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

$user_plan_id = $_POST['plan_id'];

$sql = "Select A.*, B.service from user_plan_service as A left join providers as B on (A.provider_id = B.provider_id) where A.user_plan_id = " . $user_plan_id . " and A.is_active = 1";
$res = getXbyY($sql);
$rows = count($res);

include "templates/" . $res_template[0]['template_name'] . "/user_plans.php";

?>