<?php

include "include.php";

if ($_POST['updte'] == '1') {
    $o1->ipay_user_id = $_POST['ipay_user_id'];
    $o2->ipay_beneficiary_id = $_POST['benificiary_id_del'];
    
    if ($o1->ipay_user_id > 0 && $o2->ipay_beneficiary_id > 0) {
        $o1 = $factory->get_object($o1->ipay_user_id, "ipay_user", "ipay_user_id");
        $o2 = $factory->get_object($o2->ipay_beneficiary_id, "ipay_beneficiary", "ipay_beneficiary_id");
        $o2->otp = $_POST['ipay_del_otp'];
        $api_response = ipay_del_ben($o1, $o2);
       
        if ($api_response['error'] == "0") {

            if ($api_response['statuscode'] == "TXN") {

                  if ($api_response['data']['otp'] == "1") {
                    $result['error'] = "2";
                    $result['error_msg'] = "OTP Mismatch";
                } else if ($api_response['data']['otp'] == "0") {
                    $o2->is_active = "2";
                    $o2->ipay_beneficiary_id = $updater->update_object($o2, "ipay_beneficiary");
                    $result['error'] = "0";
                    $result['error_msg'] = $api_response['status'];
                }else if ($api_response['data'] == "Success") {
                    $o2->is_active = "2";
                    $o2->ipay_beneficiary_id = $updater->update_object($o2, "ipay_beneficiary");
                    $result['error'] = "0";
                    $result['error_msg'] = $api_response['status'];
                }
            } else {
                $result['error'] = "1";
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




