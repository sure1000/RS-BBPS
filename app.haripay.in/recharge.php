<?php
session_start();

include "include.php";
include "session.php";
$recharge_page = 1;
$tables = 1;

$sql_transactions = "Select * from wallet where user_id = " . $o->user_id . " order by transaction_date DESC limit 0 ,10";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);

 if( $_SESSION['ipay_customer_id'] > 0 ){
     $ipay_user = $factory->get_object( $_SESSION['ipay_customer_id'], "ipay_user", "ipay_user_id");
      $sql_ipay_ben = "select * from ipay_beneficiary where user_id = '".$o->user_id."' and ipay_user_id = '".$_SESSION['ipay_user_id']."'";
      $res_ipay_ben = getXbyY($sql_ipay_ben);
      $row_ipay_ben = count($res_ipay_ben);
    
}
include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/recharge.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";
include "js/recharge.js";
?>