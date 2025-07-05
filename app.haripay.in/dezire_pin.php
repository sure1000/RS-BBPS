<?php

session_start();

include "include.php";
include "session.php";
if ($_POST['imps_pin_updte'] == '1') {

    $PIN_user = $_POST['imps_pin'];
    $o1->dezire_user_id = $_POST['dezire_user_id'];

    if ($o1->dezire_user_id > 0) {
        $o1 = $factory->get_object($o1->dezire_user_id, "dezire_user", "dezire_user_id");
        $o2->api_id = '16';
        if ($o2->api_id > 0) {
            $o2 = $factory->get_object($o2->api_id, "api", "api_id");
        }
        $plainText = '{"merchantUserID":"' . $o1->merchantUserID . '","senderID":"0","mobile_No":"' . $o1->mobileNo . '","PIN":"' . $PIN_user . '"}';
        $cipher = "AES256";
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        $encData = base64_encode(openssl_encrypt($plainText, $cipher, $o2->md_key, $options = OPENSSL_RAW_DATA, $iv));
        $decData = openssl_decrypt(base64_decode($encData), $cipher, $o2->md_key, OPENSSL_RAW_DATA, $iv);
        $api_response = dezire_money_login($encData);
        if ($api_response['error'] == "0") {
            if ($api_response['status'] == "1") {
                $o1->sender_id = $api_response['senderID'];
                $o1->PIN_user = $PIN_user;
                $o1->updated_at = todaysDate();
                $o1->dezire_user_id = $updater->update_object($o1, "dezire_user");
                $_SESSION['dezire_user_id'] = $o1->dezire_user_id;
                $result['error'] = "0";
                $result['error_msg'] = $api_response['message'];
            } else {

                $result['error'] = "1";
                $result['error_msg'] = $api_response['message'];
            }
        } else {
            $result['error'] = "1";
            $result['error_msg'] = $api_response['error_msg'];
        }
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>


