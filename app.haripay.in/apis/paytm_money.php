<?php
include "include.php";
if ($_POST['updte'] == 1) {
    if ($_POST['username'] > 0) {
        $o1 = $factory->get_object($_POST['username'], "users", "mobile");
    }
    $senders_name = $_POST['payment_mode'];
    $recived_by = $o1->user_name;
            if ($o1->user_id > 0) {
                $o2 = new wallet;
                $o2->user_1_id = $o->user_id;
                $o2->user_1_name = $senders_name;
                $o2->transaction_type = "Payment Gateway";
                $o2->cash_credit = $_POST['credit_paid'];
                $o2->total_amount = $_POST['amount'];
                $o2->amount = $_POST['amount'];
                 $o2->order_id = $_POST['order_id'];
                $o2->status = "Success";
                $o2->recharge_path = "App";
                $o2->send_type = $o->user_type;
                $o2 = wallet_insert($o1, $o2);
            }

            $email_from = $res_site[0]['email'];
            $email_to = $o1->email;
            $email_subject = $res_site[0]['site_name'] . " has Sent " . $o2->amount . " to your wallet";

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
            $message = "Your wallet have been Credited with Rs. " . $o2->amount . " by Payment Gateway Your new  balance is Rs. " . $o2->user_new_balance;
            sendsms_payzoom($o1->mobile, $message);
            $result['error'] = '1';
            $result['error_msg'] = "Amount Successfully Credited";
}
echo json_encode($result);
?>