<?php
session_start();

include "include.php";
include "session.php";

$sql = "Select * from user_plans where is_active = 1 and plan_type = 'API'";
$res = getXbyY($sql);
$rows = count($res);

$o1 = $factory->get_object($o->plan_id,"user_plans", "user_plan_id");

include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/membership.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";
include "js/membership.js";

?>