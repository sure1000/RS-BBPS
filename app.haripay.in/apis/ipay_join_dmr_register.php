<?php

session_start();
include "include.php";


if ($_POST['ipay_join_updte'] > 0) {

    $o1->mobileNo = $_POST['ipay_mobile_reg'];
    $o1->first_Name = $_POST['ipay_first_Name'];
    $o1->last_Name = "Bhanguz";
    $o1->pincode = $_POST['ipay_pincode'];
    $o1->user_id = $o->user_id;
    $o1->is_active = '1';
    $results = ipay_register($o1);


    if ($results['error'] == "0") {

        if ($results['statuscode'] == "TXN") {
            $o1->merchantUserID = $results['data']['remitter']['id'];
            $o1->senderCode = "0";
            $o1->sender_id = "0";
            $o1->kyc_Flag = "0";
            $o1->kyc_status = "";
            if ($results['data']['remitter']['is_verified'] == '0') {
                $result['error'] = '2';
                $o1->status = "Not Verified";
            } else {
                $result['error'] = '0';
                $o1->status = "Verified";
            }

            $sql = "Select * from ipay_user where user_id = '" . $o->user_id . "' and merchantUserID=" . $o1->merchantUserID;
            $res = getXbyY($sql);
            $row = count($res);
            if ($row == 1) {
                $o1->ipay_user_id = $res[0]['ipay_user_id'];
                $o1->updated_at = todaysDate();
                $o1->ipay_user_id = $updater->update_object($o1, "ipay_user");
            } else {
                $o1->created_at = todaysDate();
                $o1->ipay_user_id = $insertor->insert_object($o1, "ipay_user");
            }
            if ($result['error'] == "0") {
                $_SESSION['ipay_customer_id'] = $o1->ipay_user_id;
                $result['ipay_user_id'] = (string) $o1->ipay_user_id;
            } else {
                $result['ipay_user_id'] = (string)$o1->ipay_user_id;
            }

            $result['error_msg'] = $results['status'];
        } else {
            $result['error'] = '1';
            $result['error_msg'] = $results['status'];
        }
    } else {
        $result['error'] = '1';
        $result['error_msg'] = $results['error_msg'];
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}



echo json_encode($result);
?>