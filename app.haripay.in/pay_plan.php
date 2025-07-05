<?php
session_start();

include "include.php";
include "session.php";

if(isset($_GET['aid'])){
    $o4->user_plan_id = $_GET['aid'];
}else{
    $o4->user_plan_id = 0;
}

$o3 = $factory->get_object($o->plan_id, "user_plans", "user_plan_id");
$o4 = $factory->get_object($o4->user_plan_id, "user_plans", "user_plan_id");

$o1 = new wallet;

if($o4->amount < $o3->amount){
    $discount = $o4->amount;
}else{
    $discount = $o3->amount;
}

$new_amount = round($o4->amount - $discount, 2);
$gst = round((18/100)*$new_amount,2);

$o1->transaction_type = "Plan Purchase";
$o1->cash_credit = "Cash";
$o1->amount = round($new_amount + $gst, 2);
$o1->status = "Success";
$o1->gst = $gst;



//$o2 = wallet_insert($o, $o1->user_1_id, $user_1_name, $api_id, $transaction_type, $cash_credit, $api_amount, $amount, $provider_id, $mobile_number, $status, $recharge_path, $circle_id, $circle, $parent_id);
$o1 = wallet_insert($o, $o1);

$o->plan_id = $o4->user_plan_id;
$o->user_id = $updater->update_object($o,"users");


$email_subject = $res[0]['site_name']." Plan Update";

include "mails/pay_plan.php";
sendmail($res_site[0]['email'], $o->email, $email_subject, $email_message);

header("location: membership.php?msgid=7");

?>