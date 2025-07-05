<?php
session_start();
include "include.php";
include "session.php";

$tables = 1;

$sql = "Select A.* , B.service_id from providers as A left join services as B on (A.service_id = B.service_id) where A.is_active = 1 and B.is_active = '1'order by A.provider Asc";
$res = getXbyY($sql);
$rows = count($res);

include "html/includes/header.php";
include "html/route_per_operator.php";
include "html/includes/footer.php";
include "js/route_per_provider.js";
?>