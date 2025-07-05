<?php

session_start();
include "include.php";
include "session.php";

$sql = "Select * from user_plans order by plan_name";
$res = getXbyY($sql);
$rows = count($res);

include "html/includes/header.php";
include "html/plans.php";
include "html/includes/footer.php";

?>