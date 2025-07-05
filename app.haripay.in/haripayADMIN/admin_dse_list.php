<?php
session_start();

include "include.php";
include "session.php";

$tables = 1; 
$sql = "Select * from users where parent_id ='".$o->user_id."' and user_type='DSE'order by name";
$res = getXbyY($sql);
$rows = count($res);	
$mtype = "DSE";

include "html/includes/header.php";
include "html/team.php";
include "html/includes/footer.php";
?>