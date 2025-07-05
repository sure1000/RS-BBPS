<?php

session_start();

include "include.php";
include "session.php";

if ($_POST['updte'] == '1') {

    $o1->account = $_POST['account'];
    $o1->name = $_POST['name'];
    $o1->ifsc = $_POST['ifsc'];
    $o2->api_id = '16';
    if ($o2->api_id > 0) {

        $o2 = $factory->get_object($o2->api_id, "api", "api_id");
        if ($o2->is_active == "1") {
            if ($_SESSION['dezire_user_id'] > 0) {
                $o4 = $factory->get_object($_SESSION['dezire_user_id'], "dezire_user", "dezire_user_id");
                $o1->merchantTransID = reference_number();
                $o1->api_id = $o2->api_id;
                $o1->api_amount = $o1->amount;
                $o1->transaction_type = "Recharge";
                $o1->amount = '3.50';
                $o1->mobile_number = $o1->account;
                $o1->provider_id = '84';
                $o1->circle_name = '0';
                $o1->circle_id = "0";
                $o1->status = "Pending";
                $o1 = wallet_insert($o, $o1);
                $text = '{"senderID":"' . $o4->sender_id . '","merchantUserID":"' . $o4->merchantUserID . '","beneficiaryName":"' . $o1->name . '","IFSCCode":"' . $o1->ifsc . '","AccountNo":"' . $o1->account . '","merchantTransID":"' . $o1->merchantTransID . '","transactionCode":"' . $o1->ref_number . '"}';

                $cipher = "AES256";
                $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
                $encData = base64_encode(openssl_encrypt($text, $cipher, $o2->md_key, $options = OPENSSL_RAW_DATA, $iv));

                $decData = openssl_decrypt(base64_decode($encData), $cipher, $o2->md_key, OPENSSL_RAW_DATA, $iv);

                $api_response = dezire_ben_verify($encData);

                if ($api_response['error'] == "0") {

                    if ($api_response['verifystatus'] == "VERIFIED") {
                        $status = "Success";
                    } else {
                        $status = "Failed";
                    }
                    $o1->transaction_details = " Verify Non Registered Beneficiary to " . $api_response['verifiedname'] . " [ " . $o1->account . " ] MerchantTransID : " . $o1->merchantTransID . " Status :" . $status;
                    $o1->comment = $api_response['message'];
                    $o1->updated_at = todaysDate();
                    $o1->api_response = $api_response['response'];
                    $o1->recharge_url = $api_response['url'] . "&" . $plainText;
                    $o1->api_number = $api_response['merchantTransID'];

                    if ($api_response['status'] == '1') {

                        $o1->status = "Success";
                        $o1->opid = $api_response['merchantTransID'];
                        $o1->wallet_id = $updater->update_object($o1, "wallet");
                        // set_commission($o1, $o, "Prepaid");
                        $result['status'] = "Success";
                    } else {
                        $o1->status = "Failed";
                        $o1->wallet_id = $updater->update_object($o1, "wallet");
                        $o1->transaction_type = "Refund";
                        $o1->status = "Success";
                        $o1->parent_id = $o1->wallet_id;
                        $o1 = wallet_insert($o, $o1);
                        $result['status'] = "Failed";
                    }
                    $result['error'] = "0";
                    $result['error_msg'] = $api_response['message'];
                } else {
                    $o1->status = "Failed";
                    $o1->api_response = "Recharge Failed. No Response From Api";
                    $o1->wallet_id = $updater->update_object($o1, "wallet");

                    $o1->transaction_type = "Refund";
                    $o1->status = "Success";
                    $o1->parent_id = $o1->wallet_id;
                    $o1 = wallet_insert($o, $o1);
                    $result['error'] = "1";
                    $result['error_msg'] = $api_response['erroe_msg'];
                }
            }
        } else {
            $result['error'] = "1";
            $result['error_msg'] = "Operator down. Please wait";
        }
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>


