<?php
session_start();

include "include.php";
include "session.php";

$tables = 1; 
$sql = "Select * from users where user_type !='Admin' order by name";
$res = getXbyY($sql);
$rows = count($res);	
 // pt($res);
$mtype ='All';
include "html/includes/header.php";
include "html/team.php";
include "html/includes/footer.php";
include "js/team_details.js";
?>