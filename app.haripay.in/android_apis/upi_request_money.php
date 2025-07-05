<?php
include "include.php";
if ($o->user_id > 0) {
    if ($_POST['ref_number'] != "") {
        $sql = "Select * from request_money where transaction_number ='" . $_POST['ref_number'] . "'";
        $res = getXbyY($sql);
        $rows = count($res);
        if ($rows > 0) {
            $flag = '0';
        } else {
            $flag = '1';
        }
    } else {
        $flag = '1';
    }

    if ($flag == "1") {
        $o1->user_id = $o->user_id;
        $o1->amount = $_POST['request_money'];
        if ($_POST['account'] == "AEPS") {
            $o1->wallet_type = "Aeps";
        } else if ($_POST['account'] == "Dmr") {
            $o1->wallet_type = "Dmr";
        } else {
            $o1->wallet_type = "Main";
        }
        $o1->cash_credit = 'Cash';
        $o1->request_date = todaysDate();
        $o1->status = "Pending";
		$o1->request_to = 1;
        $o1->ref_number = $_POST['ref_number'];
        $o1->transfer_mode = "UPI";
        //$o1->request_to = $o1->user_id;
		$o1->decision_by = 1;
        $o1->bank_id = 1;
        $o1->transaction_number = $_POST['ref_number'];
        $o1->is_active = 1;

        $o1->request_money_id = $insertor->insert_object($o1, "request_money");

        $notification = $o->name . " has UPI requested Rs." . $o1->amount;

        insert_notifications("1", $notification, "UPI Request Money");

        $result['error'] = "0";
        $result['error_msg'] = "UPI Money Request Sent";
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "Transaction Number already exist.";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}


echo json_encode($result);
?>