<?php

session_start();

include "include.php";
include "session.php";
$tables = 1;

$send_user_id = $_GET['aid'];
 if($send_user_id > 0){
     $send_user_id = $send_user_id;
     $o1 = $factory->get_object($send_user_id, "users", "user_id");
 }else{
     $send_user_id = '0';
 }
if ($o->user_type == "White Label") {
    $sql = "Select * from users where (parent_id = '" . $o->parent_id . "')and user_type='Master Distributor'  and is_active = 1 ";
} else if ($o->user_type == "Master Distributor") {
    $sql = "Select * from users where (parent_id = '" . $o->user_id . "')and user_type='Distributor'  and is_active = 1";
} else if ($o->user_type == "Distributor") {
    $sql = "Select * from users where (parent_id = '" . $o->user_id . "')and user_type='Retailer'  and is_active = 1";
}
$res = getXbyY($sql);
$row = count($res);

 $sql_transaction= "Select * from wallet where (transaction_type='Recieve Money' or transaction_type='Reverse') and user_1_id='".$o->user_id."' order by wallet_id DESC ";
$res_transaction=getXbyY($sql_transaction);
$rows_transaction=count($res_transaction);


include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/send_money.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";
include "js/send_money.js";

?>
