<?php



session_start();

include "include.php";
include "session.php";
$page = "send_eko_money";
$ajax_logout = 1;

if ($_POST['rech_send_updte'] > 0) {

    $o6 = $factory->get_object($_SESSION['rech_customer_id'], "rech_customer", "rech_customer_id");

    $o3 = $factory->get_object($_POST['beneficiary_id'], "rech_beneficiary", "rech_beneficiary_id");

    $customerMobile = $o6->customerMobile;
    $benificiary_id = $o3->beneficiaryId;
    $rech_amount = $_POST['rech_amount'];

    $sucess_amount = 0;
    $failed_amount = 0;
    if ($rech_amount <= $o->amount_balance) {

        $amount_counter = ceil($rech_amount / 5000);

        for ($i = 0; $i < $amount_counter; $i++) {
            $agentid = reference_number();
            if ($i == $amount_counter - 1) {
                $transaction_amount = $rech_amount - (5000 * $i);
            } else {
                $transaction_amount = 5000;
            }

          $result = send_rech_money($customerMobile, $transaction_amount, $benificiary_id, $agentid);

            $o5->user_id = $o->user_id;
            $o5->rech_customer_id = $o6->rech_customer_id;
            $o5->rech_beneficiary_id = $o3->rech_beneficiary_id;

            $o5->other = $result['data']['resText'];
            $o5->beneficiaryId = $result['data']['beneficiaryId'];
            $o5->amount = $transaction_amount;
            $o5->urid = $agentid;


            $o5->beneficiaryName = $result['data']['beneficiaryName'];
            $o5->beneficiaryAccountNumber = $result['data']['beneficiaryAccountNumber'];
            $o5->orderId = $result['data']['orderId'];
            $o5->creditUsed = $result['data']['creditUsed'];
            $o5->is_active = 1;


            $recharge_status = $result['data']['status'];
          

            if ($recharge_status == "SUCCESS") {
                $recharge_status = "Success";
            } else if ($recharge_status == "PENDING") {
                $recharge_status = "Accepted";
            } else if ($recharge_status == "FAILED") {
                $recharge_status = 'Failed';
            }



            if ($recharge_status == "Success" || $recharge_status == "Accepted") {

                $amount_deduct = ipay_amount_deduct($transaction_amount);
                $o5->status = $recharge_status;

                $o5->rech_transaction_id = $insertor->insert_object($o5, "rech_transaction");



                $o6->creditUsed = $o5->creditUsed;
                $o6->rech_customer_id = $updater->update_object($o6, "rech_customer");
                $results['error'] = "Transaction Successfull";
                $results['status'] = 1;
                $sucess_amount = $sucess_amount + $transaction_amount;
            } else {
                $o5->status = "Failed";
                $o5->rech_transaction_id = $insertor->insert_object($o5, "rech_transaction");
                $results['error'] = $result['data']['resText'];
                $results['status'] = 0;
                $failed_amount = $failed_amount + $transaction_amount;
            }

            $o1->api_id = "22";
            $o1->api_name = "Rech Api";
            $o1->account_number =  $o5->beneficiaryAccountNumber;
            $o1->provider_id = "203";
            $o1->operator = "203";
            $o1->provider = "Money transfer";
            $o1->api_transaction_id = $o5->orderId;
            $o1->user_id = $o->user_id;
            $o1->recharge_type = "rech_send_money";
            $o1->recharge_date = todaysDate();
            $o1->is_active = 1;

            $o1->mobile = "";
            if ($recharge_status == "Success") {
                $o1->status = "Success";
                $o1->amount = $transaction_amount + $amount_deduct;
            } else if ($recharge_status == "Accepted") {
                $o1->status = "Accepted";
                $o1->amount = $transaction_amount + $amount_deduct;
            } else {
                $o1->status = "Failed";
                $o1->amount = $transaction_amount;
            }
            $o1->ref_number = $o5->urid;
            $o1->recharge_id = $insertor->insert_object($o1, "recharge");


            $o2->user_id = $o->user_id;
            $o2->parent_id = 0;
            $o2->transaction_type = "rech_send_money";
            $o2->api_id = "22";
            $o2->api_name = "Rech Api";
            $o2->api_transaction_id = $o1->api_transaction_id;
            $o2->dmr_id = 0;
            $o2->recharge_id = $o1->recharge_id;
            $o2->flight_id = 0;
            $o2->hotel_id = 0;
            $o2->amount = $transaction_amount + $amount_deduct;
            $o2->transaction_date = todaysDate();
            $o2->previous_balance = $o->amount_balance;

            $o2->ip_address = $_SERVER['REMOTE_ADDR'];
            $o2->ref_number = $o5->urid;
            $o2->rech_transaction_id = $o5->rech_transaction_id;
            $o2->opid = $o5->urid;
            $o2->comments = $result['data']['resText'];

            if ($recharge_status == "Success") {
                $o2->new_balance = $o->amount_balance - $o2->amount;
                $o2->status = "Success";
            } else if ($recharge_status == "Accepted") {
                $o2->new_balance = $o->amount_balance - $o2->amount;
                $o2->status = "Accepted";
            } else {
                $o2->new_balance = $o->amount_balance;
                $o2->status = "Failed";
            }

            $o2->is_active = 1;
            $o2->recharge_path = "Web";
             $o2->wallet_type ="DMR";
            $o2->wallet_id = $insertor->insert_object($o2, "wallet");




            if ($recharge_status == "Success" || $recharge_status == "Accepted") {
                $o->amount_balance = $o->amount_balance - $o2->amount;
                $o->user_id = $updater->update_object($o, "users");
            }

            if ($recharge_status == "Success") {
                $o->amount_balance = set_commission_ipay($o->user_id, $o2->wallet_id, "ipay_dmr");
            }



            unset($o2->wallet_id);
            unset($o1->recharge_id);
            unset($o5->instantpay_transation_id);
        }
        $results['transfered_amount'] = $sucess_amount;

        if ($results['transfered_amount'] > 0 && $sucess_amount < $ipay_amount) {
            $results['status'] = 1;
            $results['error'] = "Partial Amount Transfered.<br /> Total Money Transfered: Rs. " . $sucess_amount;
        } else if ($results['transfered_amount'] > 0 && $sucess_amount == $ipay_amount) {
            $results['status'] = 1;
            $results['error'] = "Transaction Successful";
        } else {
            $results['status'] = 0;
            $results['error'] = "Transaction Failed";
        }
    } else {
        $results['error'] = "You donot have enough balance";
        $results['status'] = 0;
        $results['transfered_amount'] = 0;
    }
    $results['dmramount'] = $o6->creditUsed;
    $results['amount_balance'] = $o->amount_balance;
}
echo json_encode($results);
?>
