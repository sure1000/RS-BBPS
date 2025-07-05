<?php

session_start();
include "include.php";
include "session.php";

$sql = "Select * from providers where is_active = 1 order by service";
$res = getXbyY($sql);
$rows = count($res);

$sql_circle = "Select * from service_circles where is_active = 1";
$res_circle = getXbyY($sql_circle);
$row_circle = count($res_circle);

include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/api_operator_codes.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";

?>