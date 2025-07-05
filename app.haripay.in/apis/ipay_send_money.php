<?php

include "include.php";
if ($_POST['ipay_send_updte'] == '1') {
	if ($o->kyc_id == $_POST['user_pin']) {

    if ($_POST['ipay_user_id'] > 0) {
        $o4 = $factory->get_object($_POST['ipay_user_id'], "ipay_user", "ipay_user_id");
    }
    $beneficiary_id = $_POST['beneficiary_id_ipay'];
    $dezire_amount = $_POST['ipay_send_amount'];
    $transactiontype = $_POST['transactiontype_ipay'];

    if ($beneficiary_id > 0) {
        $o3 = $factory->get_object($beneficiary_id, "ipay_beneficiary", "ipay_beneficiary_id");
        $o3->ifscType = $transactiontype;
    }
    $o1->provider_id = '84';
    $amount_slab = ceil($dezire_amount / 5000);
    $tt_amount = 0;

    if ($amount_slab > 1) {
        $sql_comm = "Select * from dmr_commission where (start_amount <= '5000' and end_amount >='5000' ) and dmr_type = 'Instant Pay'  and is_active = 1";
        $res_comm = getXbyY($sql_comm);
        $tt_amount = 0;
        for ($i = 0; $i < $amount_slab; $i++) {
            if ($i == ($amount_slab - 1)) {
              $pending_amount = $dezire_amount - (5000 * $i);
                $sql_comm = "Select * from dmr_commission where (start_amount <= '" . $pending_amount . "' and end_amount >='" . $pending_amount . "' ) and dmr_type = 'Instant Pay'  and is_active = 1";
                $res_comm = getXbyY($sql_comm);
                $transfer_amount[$i] = $pending_amount;
                 
            } else {
                $transfer_amount[$i] = 5000;
                 
            }
            $tt_amount = $tt_amount + $res_comm[0]['commission_value'];
            $comm_slab[$i] = $res_comm[0]['commission_value'];
        }
    } else {
        $sql_comm = "Select * from dmr_commission where (start_amount <= '" . $dezire_amount . "' and end_amount >='" . $dezire_amount . "' ) and dmr_type = 'Instant Pay'  and is_active = 1";
        $res_comm = getXbyY($sql_comm);
        $row_comm = count($res_comm);
        if ($row_comm > 0) {
            $tt_amount = $res_comm[0]['commission_value'];
        }
        $comm_slab[0] = $tt_amount;
        $transfer_amount[0] = $dezire_amount;
    }


    $o1->amount = $dezire_amount + $tt_amount;
    if ($o1->amount <= $o->amount_balance) {


        for ($i = 0; $i < $amount_slab; $i++) {
            unset($o1->wallet_id);
            $o1->ref_number = "";
            $o1->parent_id = "0";
           
            $o1->api_id = "8";
            $o1->api_amount = $o1->amount;
            $o1->transaction_type = "Recharge";
            $o1->total_amount = $transfer_amount[$i];
            $o1->amount = $transfer_amount[$i] + $comm_slab[$i];
            $o1->mobile_number = $o3->accountNo;
            $o1->circle_name = '0';
            $o1->circle_id = "0";
            $o1->status = "Pending";
            $o1->recharge_path = "App";

            $o1 = wallet_insert($o, $o1);
            $api_response = ipay_send_money($o1, $o4, $o3);
            if ($api_response['error'] == '0') {

                if($api_response['statuscode'] == "ERR"){
                    $o1->status = "Failed";
                    $api_status = "Failed";
                }else{
                    $o1->status = ipay_recharge_status($api_response['status']);
                   $api_status =  $o1->status ;
                }
                $o1->transaction_details = "Money Transfer to " . $o3->beneficiaryName . " [ " . $o3->accountNo . " ] Transaction Type : " . $transactiontype . "";
                $o1->comment = $api_response['status'];
                $o1->gst = "0";
                $o1->updated_at = todaysDate();
                $o1->api_response = $api_response['response'];
                $o1->recharge_url = "0";
                $o1->api_number = $api_response['data']['ipay_id'];
                $o1->opid = $api_response['data']['opr_id'];
                $o1->recharge_url = $api_response['url'];
                

                if ($o1->status == 'Success') {
                    $o1->status = "Success";
                    $o1->wallet_id = $updater->update_object($o1, "wallet");

                    $o1->parent_id = $o1->wallet_id;
                    set_commission($o1, $o, "Money Transfer");
                     $result['error'] = "0";
                } else if ($o1->status == 'Pending') {
                    $o1->status = "Pending";
                    $o1->wallet_id = $updater->update_object($o1, "wallet");
                     $result['error'] = "0";
                } else if ($o1->status == 'Failed') {
                    $o1->status = "Failed";
                    $o1->wallet_id = $updater->update_object($o1, "wallet");
                    $o1->transaction_type = "Refund";
                    $o1->status = "Success";
                    $o1->parent_id = $o1->wallet_id;
                    $o1 = wallet_insert($o, $o1);
                    $result['error'] = "1";
                }
               
                $result['error_msg'] = $api_response['status'];
                $result['status'] = $api_status;
            } else {
                $result['error'] = "1";
                $result['error_msg'] = $api_response['error_msg'];
                 $result['status'] = "Failed";
            }

            $user_response = ipay_pay_login($o4->mobileNo);
            if ($user_response['error'] == "0") {
                if ($user_response['statuscode'] == "TXN") {
                    $o4->balance = $user_response['data']['remitter']['remaininglimit'];
                    $o4->balance_limit = $user_response['data']['remitter']['consumedlimit'];
                    $o4->other = $user_response['data']['remitter']['perm_txn_limit'];
                    $o4->ipay_user_id = $updater->update_object($o4, "ipay_user");
                }
            }

            $result['ipay_balance'] = (string)$o4->balance;
            $result['ipay_balance_limit'] = (string)$o4->balance_limit;
        }
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "Sorry, Your Wallet Balance is less than Required Amount";
    }
	} else {
           $result['error'] = "1";
            $result['error_msg'] = "User Pin Mismatch.";
       }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>


