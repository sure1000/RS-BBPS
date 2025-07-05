<?php
session_start();

include "include.php";
include "session.php";

if(isset($_GET['aid'])){
    $o1->user_plan_id = $_GET['aid'];
}else{
    $o1->user_plan_id = 0;
}

if($o1->user_plan_id > 0){
    $o1 = $factory->get_object($o1->user_plan_id,"user_plans", "user_plan_id");
}else{
    header("location:membership.php?msgid=5");
}

if($o1->user_plan_id == ""){
    header("location:membership.php?msgid=5");
}
if($o1->user_plan_id == $o->plan_id){
    header("location:membership.php?msgid=6");
}

$o2 = $factory->get_object($o->plan_id, "user_plans", "user_plan_id");

if($o1->amount > $o2->amount){
    $discount = $o2->amount;
}else{
    $discount = $o1->amount;
}


$new_amount = round($o1->amount - $discount,2);
if($new_amount < 0){
    $new_amount = 0;
}
$gst = round(($new_amount / 100 ) * 18,2);

include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/activate_plan.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";
include "js/membership.js";

?>