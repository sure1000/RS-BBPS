<?php
include "include.php";


if ($_POST['updte_ben_verify'] == '1') {

    if ($_POST['ipay_user_id'] > 0) {

        $o1 = $factory->get_object($_POST['ipay_user_id'], "ipay_user", "ipay_user_id");
        $o2->account = $_POST['account'];
        $o2->name = $_POST['name'];
        $o2->ifsc = $_POST['ifsc'];
        $o3->api_id = "8";
        $o3->api_amount = $o1->amount;
        $o3->transaction_type = "Recharge";
        $o3->amount = '3';
        $o3->total_amount = '3';
        $o3->mobile_number = $o1->account;
        $o3->provider_id = '84';
        $o3->circle_name = '0';
        $o3->circle_id = "0";
        $o3->status = "Pending";
        $o3->ref_number = reference_number();
        $o3 = wallet_insert($o, $o3);

        $api_response = ipay_ben_verify($o1, $o2, $o3);
        if ($api_response['error'] == "0") {

            $o3->status = ipay_recharge_status($api_response['status']);

            $o3->transaction_details = " Verify Non Registered Beneficiary to " . $api_response['data']['benename'] . " [ " . $o2->account . " ] Status :" . $o3->status . " " . $api_response['data']['verification_status'];
            $o3->comment = $api_response['status'];
            $o3->updated_at = todaysDate();
            $o3->api_response = $api_response['response'];
            $o3->recharge_url = "0";
            $o3->api_number = $api_response['data']['ipay_id'];
            if ($o3->status == "Success") {
                $o3->opid = $api_response['data']['bankrefno'];
                $o3->wallet_id = $updater->update_object($o3, "wallet");
                $result['ben_name'] = $api_response['data']['benename'];
                $result['error_msg'] = "Verify Non Registered Beneficiary" . $result['ben_name'] . " ID :" . $api_response['data']['ipay_id'] . "" . $api_response['status'];
                $result['error'] = "0";
            } else if ($o3->status == "Failed") {

                $o3->wallet_id = $updater->update_object($o3, "wallet");
                $o3->transaction_type = "Refund";
                $o3->status = "Success";
                $o3->parent_id = $o3->wallet_id;
                $o3 = wallet_insert($o, $o3);
                $result['error_msg'] = $api_response['status'];
                $result['error'] = "2";
            } else if ($o3->status == "Pending") {
                $o3->wallet_id = $updater->update_object($o3, "wallet");
                $result['error_msg'] = $api_response['status'];
                $result['error'] = "3";
            }
        } else {
            $result['error'] = "1";
            $result['error_msg'] = $api_response['error_msg'];
        }
        $user_response = ipay_pay_login($o1->mobileNo);
        if ($user_response['error'] == "0") {
            if ($user_response['statuscode'] == "TXN") {
                $o1->balance = $user_response['data']['remitter']['remaininglimit'];
                $o1->balance_limit = $user_response['data']['remitter']['consumedlimit'];
                $o1->other = $user_response['data']['remitter']['perm_txn_limit'];
                $o1->ipay_user_id = $updater->update_object($o1, "ipay_user");
            }
        }

        $result['ipay_balance'] = (string)$o1->balance;
        $result['ipay_balance_limit'] = (string)$o1->balance_limit;
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


