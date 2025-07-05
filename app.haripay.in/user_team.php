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

$sql = "Select * from users where parent_id = '".$o1->user_id."' order by name";
$res = getXbyY($sql);
$rows = count($res);	


include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/user_team.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";


?>