<?php

session_start();
include "include.php";
include "session.php";

if(isset($_GET['aid'])){
    $o1->user_id = $_GET['aid'];
}else{
    header("location:team.php?msgid=4");
}

if($o1->user_id > 0){
    $o1 = $factory->get_object($o1->user_id,"users", "user_id");
}

if($o1->user_id == "" || $o1->user_id == 0){
    header("location:team.php?msgid=4");
}

$sql = "Select * from kyc where user_id = ".$o1->user_id." order by upload_date";
$res = getXbyY($sql);
$rows = count($res);

include "html/includes/header.php";
include "html/user_kyc.php";
include "html/includes/footer.php";
include "js/user_kyc.js";
?>