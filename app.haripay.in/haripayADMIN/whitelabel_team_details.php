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
if (isset($_GET['aid'])) {
    $o1->user_id = $_GET['aid'];
} else {
    $o1->user_id = 0;
}
$o1 = $factory->get_object($o1->user_id, "site_info", "site_info_id");

include "html/includes/header.php";
include "html/whitelabel_team_details.php";
include "html/includes/footer.php";
include "js/team_details.js";
        
?>