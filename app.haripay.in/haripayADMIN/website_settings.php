<?php
session_start();

include "include.php";
include "session.php";

$tables = 1; 
/*
$sql = "Select * from site_info WHERE site_info_id='".$_GET['aid']."'";
$res = getXbyY($sql);
$rows = count($res);	
pt($res);die;
*/
$o1 = $factory->get_object($_GET['aid'], "site_info", "site_info_id");

include "html/includes/header.php";
	include "html/website_settings.php";
	include "html/includes/footer.php";
        include "js/team_details.js";
        
?>