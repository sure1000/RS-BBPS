<?php
include "include.php";


if ($_POST['electricity_updte'] == '1') {

    $o1->amount = $_POST['elec_amount'];
    $o1->mobile_number = $_POST['electricity_account_number'];
    $o1->provider_id = $_POST['electricity_circle'];
    $o1->circle_name = $_POST['electricity_state'];
    $o1->circle_id = "0";
    $o1->status = "Pending";
    $o1->transaction_type = "Recharge";
    $o1->opid = $_POST['requestId'];
    $o1->total_amount = $_POST['elec_amount'];
    if ($o11->is_electricity == "Yes") {
        if ($o1->amount <= $o->amount_balance) {
            $pending_amount = $o->amount_balance - $o1->amount;
            if ($pending_amount >= $o->capping_amount) {

                $o1->api_id = "1";
                $tn_dtt = "Rs." . $_POST['elec_amount'] . " Paid For :" . $_POST['CustomerName'] . " (" . $_POST['electricity_mobile'] . ") - Due Date :" . $_POST['due_date'] . " Bill Number : " . $_POST['bill_number_elec'] . " Account Number : " . $_POST['electricity_account_number'];
                $parent_id = '0';
                $o1 = wallet_insert_new($o, $o1);
                $o1->ref_number = "NP" . $o1->wallet_id;
                $o1->status = "Success";
                $o1->transaction_details = $tn_dtt;
                $o1->elec_status = "Pending";

                $o1->wallet_id = $updater->update_object($o1, "wallet");
                 $result['error'] = "0";
                $result['error_msg'] = "Recharge " .$o1->status;
              // include "recharge_response.php";
            } else {
                $result['error'] = "1";
                $result['error_msg'] = "Sorry, Your Wallet Balance is less than Required Amount";
            }
        } else {
            $result['error'] = "1";
            $result['error_msg'] = "Sorry, Your Wallet Balance is less than Required Amount";
        }
    } else {
        $result['error'] = '1';
        $result['error_msg'] = 'Your services to pay electricity bill is not activated. Please contact Administrator for more details.';
    }
} else {
    $result['error'] = 1;
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>


