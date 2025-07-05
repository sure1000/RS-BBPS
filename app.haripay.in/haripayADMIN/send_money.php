<?php

session_start();

include "include.php";
include "session.php";

$tables = 1;

if (isset($_GET['aid'])) {
    $o1->user_id = $_GET['aid'];
} else {
    $o1->user_id = 0;
}

if ($o1->user_id > 0) {
    $o1 = $factory->get_object($o1->user_id, "users", "user_id");
    $phone_email = $o1->mobile;
} else {
    $o1->user_id = 0;
    $phone_email = "";
}

if ($updte == 1) {
    $o1->user_id = $_POST['user_id'];
    $o1 = $factory->get_object($o1->user_id, "users", "user_id");

    if ($o1->user_id == "" || $o1->user_id == "0") {
        header("location:team.php?msgid=4");
    }

    $senders_name = $o->user_name . " " . $o->name;
    //$o2 = wallet_insert($o1, $o->user_id, $senders_name, "0", "Recieve Money", $_POST['credit_paid'], "0", $_POST['amount'], "0", "", "Success", "Web", "0", " ", "0");
    $o2 = new wallet;
    $o2->user_1_id = $o->user_id;
    $o2->user_1_name = $senders_name;
    if($_POST['amount'] < 0){
		$result['error'] ='0';
        $result['error_msg'] = "Entre a valid amount for transaction";
		echo json_encode($result);
     die();
	}
   else{
    $o2->cash_credit = $_POST['credit_paid'];
    if($o2->cash_credit  == "Debit"){
        $o2->transaction_type = "Reverse";
    }else{
        $o2->transaction_type = "Recieve Money";
    }
    $o2->total_amount = $_POST['amount'];
    $o2->amount = $_POST['amount'];
    $o2->status = "Success";
    $o2->recharge_path = "Web";
    $o2->parent_user_id = $o1->parent_id;
    $o2->send_type = "Admin";
  
    $o2 = wallet_insert($o1, $o2);

    $email_from = $res_site[0]['email'];
    $email_to = $o1->email;
    $email_subject = $res_site[0]['site_name'] . " has Sent " . $o2->amount . " to your wallet";
    //$email_message = "Verification Code : ".$o->new_password;
    $email_message = "<html><head><title>Wallet update for " . $res_site[0]['site_name'] . "</title></head><body style='font-family: Arial, Helvetica, sans-serif;'>
    <table style='border:1px solid #ccc;border-radius:8px;' cellpadding='8'>
    <tr><td><img src='" . $res_site[0]['site_url'] . "/img/" . $res_site[0]['logo'] . "' width='256' /></td></tr>
    <tr><td style>Greetings " . $o1->name . "</td></tr>
    <tr><td>Your " . $res_site[0]['site_name'] . " wallet has been updated. The details for the same are as following:</td></tr>
    <tr><td><b>Old Amount: INR. " . $o2->user_old_balance . "</td></tr>
    <tr><td><b>Amount Sent: INR. " . $o2->amount . "</td></tr>
    <tr><td><b>New Amount: INR. " . $o2->user_new_balance . "</td></tr>
  
    <tr><td>The same will reflect in your wallet on " . $res[$i]['site_name'] . ". Incase, it is not showing, please logout and login again</td></tr>
    <tr><td>Thanking you</td></tr>
    <tr><td>Admin - " . $res_site[0]['site_name'] . "</td></tr>
    <tr><td>Email: " . $res_site[0]['email'] . "</td></tr>
    <tr><td>Phone: " . $res_site[0]['mobile'] . "</td></tr></table></body></html>";

    sendmail($email_from, $email_to, $email_subject, $email_message);
    $message = "Your wallet have been ".$o2->cash_credit."ed with Rs. " . $o2->amount . " by Admin. Your new  balance is Rs. " . $o2->user_new_balance;
    $message1 = " Rs. " . $o2->amount . " has been send to  ".$o1->user_name. " ".$o1->name;
   // sendsms_payzoom($o1->mobile, $message);
   // sendsms_payzoom($o->mobile, $message1);
    header("location:team.php?msgid=5");
}
}
$sql_transaction= "select * from wallet where (transaction_type='Recieve Money' or transaction_type='Reverse') and user_1_id='".$o->user_id."' order by transaction_date DESC";
$res_transaction=getXbyY($sql_transaction);
$rows_transaction=count($res_transaction);



include "html/includes/header.php";
include "html/send_money.php";
include "html/includes/footer.php";
include "js/send_money.js";
?>
