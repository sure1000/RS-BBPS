<?php
session_start();

include "include.php";
include "session.php";


$tables = 1;

$sql = "Select * from payment_mode order by payment_mode";
$res = getXbyY($sql);
$rows = count($res);



include "html/includes/header.php";
include "html/payment_mode.php";
include "html/includes/footer.php";
?>