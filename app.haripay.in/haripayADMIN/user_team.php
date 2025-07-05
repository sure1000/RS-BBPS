<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;


if(isset($_GET['aid'])){
    $o1->user_id = $_GET['aid'];
}else{
    header("location:team.php?msgid=4");
}

if($o1->user_id > 0){
    $o1 = $factory->get_object($o1->user_id, "users", "user_id");
}else{
    header("location:team.php?msgid=4");
}
if($o1->user_type == "DSE"){
	
$sql = "Select * from users where parent_id = '".$o1->parent_id."' and user_type = 'Retailer' order by name";
}else{
	$sql = "Select * from users where parent_id = '".$o1->user_id."' order by name";
}

$res = getXbyY($sql);
$rows = count($res);	

include "html/includes/header.php";
include "html/user_team.php";
include "html/includes/footer.php";
?>