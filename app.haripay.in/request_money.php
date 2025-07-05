<?php
session_start();

include "include.php";
include "session.php";
$tables = '1';

$o1=$factory->get_object($o->parent_id,"users","user_id");

$sql = "Select * from request_money  where user_id='".$o->user_id."' order by request_money_id DESC ";
$res = getXbyY($sql);
$rows = count($res);

include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/request_money.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";
include "js/request_money.js";
?>
