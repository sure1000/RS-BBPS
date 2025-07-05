<?php

session_start();

include "include.php";
include "session.php";
if ($_POST['updte'] == '1') {

    $o1->dezire_user_id = $_POST['dezire_user_id'];
    $o2->api_id = '16';
    if($o1->dezire_user_id > 0){
        $o1 = $factory->get_object($o1->dezire_user_id, "dezire_user", "dezire_user_id");
         $o2 = $factory->get_object($o2->api_id, "api", "api_id");
        //  $plainText = '{"merchantUserID":"' . $o1->merchantUserID . '","senderID":"0","mobile_No":"' . $o1->mobileNo . '","PIN":"' . $o1->PIN_user . '"}';
          $plainText = '{"MobileNo":"'.$o1->mobileNo.'","senderID":"'.$o1->sender_id.'","merchantUserID":"'.$o1->merchantUserID.'"}';
         
          $cipher = "AES256";
            $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
            $encData = base64_encode(openssl_encrypt($plainText, $cipher, $o2->md_key, $options = OPENSSL_RAW_DATA, $iv));
            $decData = openssl_decrypt(base64_decode($encData), $cipher, $o2->md_key, OPENSSL_RAW_DATA, $iv);
            $api_response = dezire_forgot_pin($encData);
            if($api_response['error'] == "0"){
                 $result['error'] = "0";
                $result['error_msg'] = $api_response['message'];
            }else{
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


