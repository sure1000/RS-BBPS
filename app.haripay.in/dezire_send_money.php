<?php

session_start();

include "include.php";
include "session.php";

if ($_POST['imps_send_updte'] == '1') {
    $o2->api_id = '16';
    if ($o2->api_id > 0) {
        $o2 = $factory->get_object($o2->api_id, "api", "api_id");
    }
    if ($_SESSION['dezire_user_id'] > 0) {
        $o4 = $factory->get_object($_SESSION['dezire_user_id'], "dezire_user", "dezire_user_id");
    }
    $beneficiary_id = $_POST['beneficiary_id'];
    $dezire_amount = $_POST['dezire_amount'];
    $transactiontype = $_POST['transactiontype'];

    if ($beneficiary_id > 0) {
        $o3 = $factory->get_object($beneficiary_id, "dezire_beneficiary", "dezire_beneficiary_id");
    }
    if ($transactiontype == "IMPSIFSC") {
        $type = "1";
    } else if ($transactiontype == "NEFT") {
        $type = "2";
    } else {
        $type = "0";
    }

    if ($o2->is_active == "1") {
        $o1->provider_id = '84';
        $sql_comm = "Select * from user_plan_service where user_plan_id = " . $o->plan_id . " and provider_id = " . $o1->provider_id . " and is_active = 1";
        $res_comm = getXbyY($sql_comm);
        $row_comm = count($res_comm);

        if ($row_comm > 0) {
            if ($res_comm[0]['commission_percentage'] > 0) {
                $comm_amount = round(($res_comm[0]['commission_percentage'] / 100) * $dezire_amount, 2);
            } else {
                $comm_amount = $res[0]['commission_amount'];
            }
        } else {
            $comm_amount = 0;
        }

        $o1->amount = $dezire_amount + $comm_amount;
        if ($o1->amount <= $o->amount_balance) {
            $amount_slab = ceil($dezire_amount / 5000);

            if ($row_comm > 0) {
                if ($res_comm[0]['commission_percentage'] > 0) {
                    $slab_amount = round(($res_comm[0]['commission_percentage'] / 100) * 5000, 2);
                    $last_amount = round(($res_comm[0]['commission_percentage'] / 100) * ($dezire_amount % 5000), 2);
                } else {
                    $slab_amount = $res[0]['commission_amount'];
                    $last_amount = $res[0]['commission_amount'];
                }
            } else {
                $slab_amount = 0;
                $last_amount = 0;
            }

            for ($i = 0; $i < $amount_slab; $i++) {
                $o1->api_id = $o2->api_id;
                $o1->api_amount = $o1->amount;
                $o1->transaction_type = "Recharge";
                $o1->amount = $o1->amount;
                $o1->mobile_number = $o3->accountNo;
                $o1->circle_name = '0';
                $o1->circle_id = "0";
                $o1->status = "Pending";
                if ($amount_slab > 1) {
                    if ($i == ($o1->amount_slab - 1)) {
                        $o1->amount = $dezire_amount % 5000;
                        $transfer_amount = $o1->amount;
                        $o1->amount = $o1->amount + $last_amount;
                        $commision_amt = $last_amount;
                    } else {
                        $o1->amount = 5000 + $slab_amount;
                        $transfer_amount = 5000;
                          $commision_amt = $slab_amount;
                    }
                } else {
                    $transfer_amount = $dezire_amount;
                    $o1->amount = $dezire_amount + $last_amount;
                    $commision_amt = $last_amount;
                }
                $gst_amount = round($commision_amt * 18 / 100, 2);
                $o1->amount = $o1->amount +$gst_amount;
                $o1 = wallet_insert($o, $o1);
                $wallet_id = $o1->wallet_id;
                $plainText = '{"transactionCode":"' . $o1->ref_number . '","senderID":"' . $o4->sender_id . '","beneficiaryID":' . $o3->beneficiary_ID . ',"merchantUserID":"' . $o4->merchantUserID . '","transAmount":"' . $transfer_amount . '","transactionType":"' . $type . '","remark":"' . $_POST['dezire_remark'] . '"}';
                $cipher = "AES256";
                $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
                $encData = base64_encode(openssl_encrypt($plainText, $cipher, $o2->md_key, $options = OPENSSL_RAW_DATA, $iv));
                $decData = openssl_decrypt(base64_decode($encData), $cipher, $o2->md_key, OPENSSL_RAW_DATA, $iv);
                $api_response = dezire_send_money($encData);
                if ($api_response['error'] == '0') {
                    if ($api_response['message'] == "The Session is expired. Please Re-login with Sender") {
                        $plainText_login = '{"merchantUserID":"' . $o4->merchantUserID . '","senderID":"0","mobile_No":"' . $o4->mobileNo . '","PIN":"' . $o4->PIN_user . '"}';
                        $cipher = "AES256";
                        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
                        $encData_login = base64_encode(openssl_encrypt($plainText_login, $cipher, $o2->md_key, $options = OPENSSL_RAW_DATA, $iv));

                        $decData_login = openssl_decrypt(base64_decode($encData_login), $cipher, $o2->md_key, OPENSSL_RAW_DATA, $iv);

                        $api_response_login = dezire_money_login($encData_login);
                        if ($api_response_login['status'] == "1") {
                            $_SESSION['dezire_user_id'] = $o4->dezire_user_id;
                            $result['status'] = "Success";
                            $api_response = dezire_send_money($encData);
                        } else {
                            $result['status'] = "Failed";
                            $api_response['status'] = "0";
                        }
                    }
                    $o1->transaction_details = "Money Transfer to " . $o3->beneficiaryName . " [ " . $o3->accountNo . " ] Transaction Type : " . $transactiontype . "";
                    $o1->comment = $api_response['message'];
                    $o1->gst = $gst_amount;
                    $o1->updated_at = todaysDate();
                    $o1->api_response = $api_response['response'];
                    $o1->recharge_url = $api_response['url'] . "&" . $plainText;
                    $o1->api_number = $api_response['transactionCode'];
                    if ($api_response['status'] == '1') {
                        $o1->status = "Success";

                        $o1->opid = $api_response['transactionCode'];
                        $o1->wallet_id = $updater->update_object($o1, "wallet");
                        // set_commission($o1, $o, "Prepaid");
                        $result['status'] = "Success";
                    } else if ($api_response['status'] == '3') {
                        $o1->status = "Pending";
                        $o1->wallet_id = $updater->update_object($o1, "wallet");
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
                    $result['wallet_id'] = $wallet_id;
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
                    $result['wallet_id'] = $wallet_id;
                    $result['error_msg'] = $api_response['erroe_msg'];
                }
            }
        } else {
            $result['error'] = 1;
            $result['error_msg'] = "Sorry, Your Wallet Balance is less than Required Amount";
        }
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "Operator down. Please wait";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>


