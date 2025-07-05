<?php

session_start();

include "include.php";
include "session.php";
if ($_POST['imps_login_updte'] == '1') {

    $o1->mobile = $_POST['imps_mobile'];

    $sql = "Select dezire_user_id , PIN_user from dezire_user where mobileNo='" . $o1->mobile . "'";
    $res = getXbyY($sql);
    $row = count($res);

    if ($row == "1") {
        if ($res[0]['PIN_user'] > 0) {
            $o1 = $factory->get_object($res[0]['dezire_user_id'], "dezire_user", "dezire_user_id");
            $o2->api_id = '16';
            if ($o2->api_id > 0) {
                $o2 = $factory->get_object($o2->api_id, "api", "api_id");
            }
            $plainText = '{"merchantUserID":"' . $o1->merchantUserID . '","senderID":"0","mobile_No":"' . $o1->mobileNo . '","PIN":"' . $o1->PIN_user . '"}';
            $cipher = "AES256";
            $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
            $encData = base64_encode(openssl_encrypt($plainText, $cipher, $o2->md_key, $options = OPENSSL_RAW_DATA, $iv));
            $decData = openssl_decrypt(base64_decode($encData), $cipher, $o2->md_key, OPENSSL_RAW_DATA, $iv);
            $api_response = dezire_money_login($encData);

            if ($api_response['error'] == "0") {
                if ($api_response['status'] == "1") {
                    $o1->sender_id = $api_response['senderID'];
                    $o1->updated_at = todaysDate();
                    $o1->dezire_user_id = $updater->update_object($o1, "dezire_user");
                    $_SESSION['dezire_user_id'] = $o1->dezire_user_id;
                    $result['error'] = "0";
                    $result['error_msg'] = $api_response['message'];
                } else {
                    if ($api_response['message'] == 'Invalid Mobile Number or PIN or SenderID or merchantUserID!') {
                        $result['error'] = "3";
                        $result['dezire_user_id'] = $o1->dezire_user_id ;
                        $result['error_msg'] = "Enter Pin";
                    } else {
                        $result['error'] = "1";
                        $result['error_msg'] = $api_response['message'];
                    }
                }
            } else {
                $result['error'] = "1";
                $result['error_msg'] = $api_response['error_msg'];
            }
        } else {
            $result['error'] = "3";
            $result['dezire_user_id'] = $res[0]['dezire_user_id'] ;
            $result['error_msg'] = "Enter Pin";
        }
    } else {
        $result['error'] = "2";
        $result['dezire_mobile'] = $_POST['imps_mobile'];
        $result['error_msg'] = "Not Registered";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>


