<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;


$sql = "Select * from dmr_commission";
$res = getXbyY($sql);
$rows = count($res);	

include "html/includes/header.php";
include "html/dmr_commission.php";
include "html/includes/footer.php";
?>