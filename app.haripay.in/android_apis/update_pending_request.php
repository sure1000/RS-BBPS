<?php
include "include.php";
if ($_POST['pendin_request'] == "1") {
    if ($_POST['request_money_id'] > 0) {
        $o3->decision_date = todaysDate();
        $o3->request_money_id = $_POST['request_money_id'];
        $o3 = $factory->get_object($o3->request_money_id, "request_money", "request_money_id");
        if ($o3->status == "Pending") {
            if ($_POST['remarks'] != "") {
                $o3->decision = $o3->decision . "-" . $_POST['remarks'];
            }
            if ($_POST['request_money_status'] == "Approve") {
                $o3->status = "Transferred";
            } else {
                $o3->status = "Rejected";
            }
            if ($o3->user_id > 0) {
                $o2 = $factory->get_object($o3->user_id, "users", "user_id");
                $o1->user_name = $o2->user_name . " " . $o2->name;
                $o5 = $factory->get_object($o3->request_to, "users", "user_id");
            }
            if ($o3->status == "Transferred") {
                if ($o5->amount_balance > $o3->amount) {
                    $o5->amount_balance = $o5->amount_balance - $o3->amount;
                    $o5 = $updater->update_object($o5, 'users');
                    $o1->parent_id = 0;
                    $o1->api_id = 0;
                    $o1->api_old_balance = 0;
                    $o1->api_amount = 0;
                    $o1->api_new_balance = 0;
                    $o1->api_name = "";
                    $o1->provider_id = "0";
                    $o1->provider_name = "0";
                    $o1->user_id = $o2->user_id;
                    $o1->user_1_id = '1';
                    $o1->user_1_name = 'Admin';
                    $o1->cash_credit = 'Cash';
                    $o1->transfer_type = 'Credit';
                    $o1->user_old_balance = $o2->amount_balance;
                    $o1->total_amount = $o3->amount;
                    $o1->amount = $o3->amount;
                    if ($o1->transfer_type == "Credit") {
                        $o1->transaction_type = 'Recieve Money';
                        $o1->user_new_balance = $o1->user_old_balance + $o3->amount;
                    }
                    $o1->transaction_details = "Rs. " . $o1->amount . " " . $o1->transaction_type . "  By Admin.(Request Money)";
                    $o1->transaction_date = todaysDate();
                    $o1->created_at = $o3->request_date;
                    $o1->updated_at = todaysDate();
                    $o1->ref_number = $o3->ref_number;
                    $o1->api_number = $o3->transaction_number;
                    $o1->opid = $o3->transaction_number;
                    $o1->api_response = "";
                    $o1->commission_ret = "0";
                    $o1->gst = "0";
                    $o1->tds = "0";
                    $o1->recharge_path = "Web";
                    $o1->ip_address = $_SERVER['REMOTE_ADDR'];
                    $o1->request_url = "";
                    $o1->request_url_api = "";
                    $o1->callback_reponse = "";
                    $o1->callback_reponse_api = "";
                    $o1->payment_mode = $o3->transfer_mode;
                    $o1->comment = $o3->remark;
                    $o1->provider_type = $o1->transaction_type;
                    $o1->circle_id = 0;
                    $o1->circle_name = "";
                    $o1->mobile_number = "";
                    $o1->status = "Success";
                    $o1->disputed = "No";
                    $o1->is_active = "1";
                    $o1->month_year = date("F") . "-" . date('Y');
                    $o1->money_file = $o3->file_money;
                    $o1->bank_id = $o3->bank_id;
                    $o1->send_type= $o2->user_type;
                    $o1->bank_details = $o3->bank_details;
                    $o1->wallet_id = $insertor->insert_object($o1, "wallet");
                    $o2->amount_balance = $o1->user_new_balance;
                    $o2->user_id = $updater->update_object($o2, "users");
                    $message = "Your wallet have been " . $o1->transfer_type . "ed with Rs. " . $o1->amount . " by Admin. Your new papaFast balance is Rs. " . $o2->amount_balance;
                    // sendsms_3gsolutions($o2->mobile, $message);
                    sendmail("info@papaFastapi.in", $o2->email, "papaFast Wallet Update By Admin", "Dear " . $o2->name . ",<br/>" . $message . "<br/>Thanks you,<br/> papaFast Team.");
                } else {
                    $result['error_msg'] = "Insufficient Balance";
                    $result['error'] = 1;

                    echo json_encode($result);
                    die();
                }
            } else {
                $message = "Your Payment request  have been rejected  by Admin." . $_POST['remarks'];
                // sendsms_3gsolutions($o2->mobile, $message);
                sendmail("info@papafastapi.in", $o2->email, "papaFast Payment Request Rejected", "Dear " . $o2->name . ",<br/>" . $message . "<br/>Thanks you,<br/> papaFast Team.");
            }
            $o3->decision_date = todaysDate();
            $o4 = $factory->get_object($o3->request_to, "users", "user_id");
            $o3->request_money_id = $updater->update_object($o3, "request_money");
            $notification = "Your Request Money request have been " . $o3->status . " by " . $o4->user_name . " - " . $o4->name;
            insert_notifications($o2->user_id, $notification, "Request Money");
        } else {
            $result['error_msg'] = "Something went wrong please try again";
            $result['error'] = 1;
        }
        $result['error_msg'] = "Information Updated Successfully";
        $result['error'] = '0';
    } else {
        $result['error_msg'] = "Something went wrong please try again";
        $result['error'] = 1;
    }
} else {
    $result['error_msg'] = "Something went wrong please try again";
    $result['error'] = 1;
}


echo json_encode($result);
?>

