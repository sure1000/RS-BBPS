<?php

session_start();

include "include.php";


if ($_POST['ipay_pin_updte'] == "1") {
    $o1->PIN_user = $_POST['ipay_pin'];
    $o1->ipay_user_id = $_POST['ipay_user_id'];
    if ($o1->ipay_user_id > 0) {
        $o1 = $factory->get_object($o1->ipay_user_id, "ipay_user", "ipay_user_id");
        $o1->PIN_user = $_POST['ipay_pin'];
        $api_response = ipay_remitter_validate($o1);

        if ($api_response['error'] == "0") {
            if ($api_response['statuscode'] == "TXN") {

                if ($api_response['data']['remitter']['is_verified'] == '0') {
                    $result['error'] = '2';
                    $o1->status = "Not Verified";
                } else {
                    $result['error'] = '0';
                    $o1->status = "Verified";
                }
                $o1->balance = "25000";
                $o1->balance_limit = "25000";
                $o1->merchantUserID = $api_response['data']['remitter']['id'];
                $o1->updated_at = todaysDate();
                $o1->ipay_user_id = $updater->update_object($o1, "ipay_user");
                $result['error'] = '0';
                $result['error_msg'] = $api_response['status'];
                $result['ipay_user_id'] = (String) $o1->ipay_user_id;
                $result['remaining'] = (String) $o1->balance;
                $result['total_limit'] = (String) $o1->balance_limit;
                $result['ipay_user_name'] = (String) $o1->first_Name;
                $result['ipay_mobile'] = (String) $o1->mobileNo;
            } else {
                $result['error'] = '1';
                $result['error_msg'] = $api_response['status'];
            }
        } else {
            $result['error'] = "1";
            $result['error_msg'] = $api_response['error_msg'];
        }
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "Something went wrong please try again";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}
echo json_encode($result);
?>