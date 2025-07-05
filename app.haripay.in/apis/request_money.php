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
        $o1->ref_number = reference_number();
        $o1->transfer_mode = $_POST['payment_mode'];
        $o1->requested_user_id = "0";
        $o1->bank_id = $_POST['bank_id'];
        if ($o1->bank_id == "Parent") {
            $o1->requested_user_id = $o->parent_id;
            $o1->bank_id = '0';
        }
        if ($o1->bank_id > 0) {
            $o2 = $factory->get_object($o1->bank_id, "bank_details", "bank_id");
            $o1->bank_details = $o2->bank_name . "-" . $o2->account_no;
        }
        $o1->transaction_number = $_POST['ref_number'];
        $o1->is_active = 1;
        if ($_FILES['money_file']['name'] != "") {
            if ($o1->file_money != "") {
                $img_link = "wallet_image/" . $o1->file_money;
                $img_thumb_link = "wallet_image/thumbs/" . $o1->file_money;
                unlink($img_link);
                unlink($img_thumb_link);
            }
            $tmpfile = $_FILES['money_file']['tmp_name'];
            $source = "wallet_image";
            $file_extension = explode(".", $_FILES['money_file']['name']);
            $destination = $o1->user_id . "." . time() . "." . end($file_extension);
            $thumbnail = 1;
            $newsize = "100";
            $watermark = "";

            uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark);

            $o1->file_money = $destination;
        }

        if ($o1->transaction_number == "") {
            $o1->transaction_number = '0';
        }

        $o1->request_money_id = $insertor->insert_object($o1, "request_money");

        $notification = $o->name . " has requested Rs." . $o1->amount;

        insert_notifications("1", $notification, "Request Money");

        $result['error'] = "0";
        $result['error_msg'] = "Money Request Sent";
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