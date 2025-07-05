<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

$sql = "Select A.*,B.service from user_plan_service as A left join providers as B on(A.provider_id=B.provider_id)where A.user_plan_id = '".$o->plan_id."' " ;
$res = getXbyY($sql);
$rows = count($res);

include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/commission_structure.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";

?>