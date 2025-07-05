<?php
session_start();
include "include.php";
include "session.php";

$tables = 1;

$sql = "Select * from route_details where route_type = 'Amount' and is_active = 1";
$res = getXbyY($sql);
$rows = count($res);

include "html/includes/header.php";
include "html/route_per_amount.php";
include "html/includes/footer.php";
include "js/route_per_amount.js";
?>