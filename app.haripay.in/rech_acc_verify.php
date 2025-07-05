<?php

session_start();

include "include.php";
include "session.php";

$page = "send_eko_money";

if ($updte > 0) {
$o6 = $factory->get_object($_SESSION['rech_customer_id'], "rech_customer", "rech_customer_id");

    if (5 <= $o->amount_balance) {

        $benificiary_acc = $_POST['rech_acc_number'];
        $ipay_ifsc = $_POST['rech_ifsc'];

        $customerMobile = $o6->customerMobile;
        $ref_number = reference_number();

        $result = rech_ben_acc_verify($customerMobile, $benificiary_acc, $ipay_ifsc, $ref_number);

        if ($result['data']['resCode'] == "200" || $result['data']['error_code'] == "200") {
            $o5->user_id = $o->user_id;
            $o5->rech_customer_id = $o6->rech_customer_id;
            $o5->urid = $result['data']['optid'];
            $o5->amount = 3;
            $o5->is_active = 1;
            $o5->orderId = $result['data']['orderId'];
            $o5->other = $result['data']['resText'];
            $o5->beneficiaryName = $result['data']['beneficiaryName'];

            $o5->status = $result['data']['status'];
            $o5->rech_transaction_id = $insertor->insert_object($o5, "rech_transaction");
            $o5->api_id = "6";
            $o5->transaction_type ="";
            $o1 = wallet_insert($o,$o5);
            // $o1->api_id = "6";
            // $o1->api_name = "Rechapi";
            // $o1->parent_id ="0";
            // $o1->provider_id = "107";
            // $o1->operator = "203";
            // $o1->provider_name ="Rech DMR";
            // $o1->provider_type = "Money Transfer";
            // $o1->api_transaction_id = $o5->urid;
            // $o1->user_id = $o->user_id;
            // $o1->recharge_type = "rech_send_money";
            // $o1->recharge_date = todaysDate();
            // $o1->is_active = 1;
            // $o1->status = "Success";
            // // $o1->amount = $o5->amount;
            // $o1->ref_number = $o1->api_transaction_id;
            // // $o1->recharge_id = $insertor->insert_object($o1, "recharge");
            // $o2->user_id = $o->user_id;
            // $o2->user_name = $o->user_name ." ".$o->name;
            // $o2->parent_id = 0;
            // $o2->transaction_type = "rech_send_money";
            // $o2->api_id = 0;
            // $o2->api_name = "";
            // $o2->api_transaction_id = $o1->api_transaction_id;
            // $o2->dmr_id = 0;
            // $o2->recharge_id = $o1->recharge_id;
            // $o2->flight_id = 0;
            // $o2->hotel_id = 0;
            // $o2->amount = $o1->amount;

            // $o2->transaction_date = todaysDate();
            // $o2->user_old_balance = $o->amount_balance;
            // $o2->user_new_balance = $o->amount_balance - $o2->amount;
            // $o2->ip_address = $_SERVER['REMOTE_ADDR'];
            // $o2->ref_number = $o2->api_transaction_id;
            // $o2->rech_transaction_id = $o5->rech_transaction_id;
            // $o2->opid = $o5->urid;
            // $o2->comments = "";
            // $o2->status = "Success";
            // $o2->is_active = 1;
            // $o2->recharge_path = "Web";
            // $o2->wallet_type ="DMR";
            // $o2->wallet_id = $insertor->insert_object($o2, "wallet");

            // $o->amount_balance = $o->amount_balance - $o2->amount;
            // $o->user_id = $updater->update_object($o, "users");

            $results['error'] = "Transaction Successfull";
            $results['status'] = 1;
            $results['ben_name'] = $o5->beneficiaryName;
            $results['charged_amt'] = $o5->amount;
            $results['ver_status'] = $result['data']['status'];
            $results['benificiary_acc'] = $benificiary_acc;
            $results['ipay_ifsc'] = $ipay_ifsc;
        } else {
            $results['error'] = $result['data']['resText'];
            $results['ver_status'] = $result['data']['status'];
            $results['ben_name'] = "Null";
            $results['charged_amt'] = 0;
            $results['benificiary_acc'] = $benificiary_acc;
            $results['ipay_ifsc'] = $ipay_ifsc;
            $results['status'] = 0;
        }
    } else {
        $results['error'] = "You donot have enough balance";
        $results['status'] = 0;
    }
}
echo json_encode($results);
?>
