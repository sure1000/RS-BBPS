<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;


$sql = "Select * from services order by  is_active  DESC";
$res = getXbyY($sql);
$rows = count($res);	

include "html/includes/header.php";
include "html/services.php";
include "html/includes/footer.php";
?>