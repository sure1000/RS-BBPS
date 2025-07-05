<?php
session_start();

include "include.php";
include "session.php";

if($_POST['updte'] > 0){
	$sql = "select * from userServices where user_id ='".$_POST['user_id']."' and is_active ='1'";
	$res = getXbyY($sql);
	$row = count($res);
  
    include "html/service_plans.php";

}

?>
