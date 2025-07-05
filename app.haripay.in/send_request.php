<?php

session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

if ($updte == 1) {

    $o1->user_id = $o->user_id;
    $o1->amount = $_POST['request_money'];
    $o1->cash_credit = $_POST['cash_credit'];
    $o1->request_date = todaysDate();
    $o1->status = "Pending";
    $o1->ref_number = reference_number();
    $o1->transfer_mode = $_POST['transfer_mode'];
    $o1->transaction_number = $_POST['transaction_number'];
    $o1->is_active = 1;
    $o1->request_to = $_POST['request_user'];
    $o4 = $factory->get_object($o1->request_to, "users", "user_id");
    $o1->account_name = $_POST['account_name'];
    $old_amount = $o->amount_balance;
    $old_credit = $o->credit_amount;

   if ($o1->transfer_mode == "Cash") {
        $o1->request_money_id = $insertor->insert_object($o1, "request_money");

        $notification = $o->name . " has sent a Request to Top Up Balance by " . $o1->amount;
        insert_notifications($o1->request_to, $notification);

        $email_to = $res_site[0]['email'];
        $email_from = $o->email;
        $email_subject = $notification;
        //$email_message = "Verification Code : ".$o->new_password;
        include "mails/send_request.php";

        sendmail($email_from, $email_to, $email_subject, $email_message);

        $result['error'] = 0;
        $result['error_msg'] = "Request has been forwarded to " . $o4->user_name . "-" . $o4->name . ". " . $o4->name . " will respond shortly";
    } else if ($o1->transfer_mode != " ") {
        $sql = "select * from payment_mode where account_name = '" . $o1->transfer_mode . "'";
        $res = getXbyY($sql);
        $row = count($res);
        // $o2 = $factory->get_object($o1->transfer_mode, "payment_mode", "account_name");
        $o1->decision = $res[0]['account_name'] . "-" . $res[0]['account_number'];
        $o1->transfer_mode = 'Bank';
        $o1->request_money_id = $insertor->insert_object($o1, "request_money");

       //$notification = $o->name . " has requested Rs." . $o1->amount;
        $notification = $o->name . " has sent a Request to Top Up Balance by " . $o1->amount;
        insert_notifications($o1->request_to, $notification, "Request Money");

        $result['error'] = 0;
        $result['error_msg'] = "Request has been forwarded to " . $o4->user_name . "-" . $o4->name . ". " . $o4->name . " will respond shortly";
    } else {
        $result['error'] = 1;
        $result['error_msg'] = "Something Went Wrong";
    }
}

echo json_encode($result);
?>