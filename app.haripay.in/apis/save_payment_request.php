<?php

include "include.php";


if ($_POST['updte'] > 0) {
    if ($_POST['request_money_id'] > 0) {
        $o3->request_money_id = $_POST['request_money_id'];
        $o3 = $factory->get_object($o3->request_money_id, "request_money", "request_money_id");
        if ($o3->status == "Pending" && $o3->requested_user_id == $o->user_id) {

            if ($o3->wallet_type == "Aeps") {
                $remaining_amount = $o->aeps_balance - $o3->amount;
                $user_amount = $o->aeps_balance;
            } else if ($o3->wallet_type == "Dmr") {
                $remaining_amount = $o->dmr_balance - $o3->amount;
                $user_amount = $o->dmr_balance;
            } else {
                $remaining_amount = $o->amount_balance - $o3->amount;
                $user_amount = $o->amount_balance;
            }
            if ($remaining_amount >= $o->capping_amount) {
                if ($_POST['remarks'] != "") {
                    $o3->remark = $o3->remark . "-" . $_POST['remarks'];
                }
                if ($_POST['request_money_status'] == "Approve") {
                    $o3->status = "Transferred";
                } else {
                    $o3->status = "Rejected";
                }
                if ($o3->user_id > 0) {
                    $o2 = $factory->get_object($o3->user_id, "users", "user_id");
                    $o1->user_name = $o2->user_name . " " . $o2->name;
                }
                if ($o3->status == "Transferred") {
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

                    if ($o3->wallet_type == "Aeps") {
                        $o1->user_old_balance = $o2->aeps_balance;
                    } else if ($o3->wallet_type == "Dmr") {
                        $o1->user_old_balance = $o2->dmr_balance;
                    } else {
                        $o1->user_old_balance = $o2->amount_balance;
                    }
                    //$o1->user_old_balance = $o2->amount_balance;
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
                    $o1->bank_details = $o3->bank_details;
                    $o1->wallet_balance = $o3->wallet_type;
                    $o1->wallet_id = $insertor->insert_object($o1, "wallet");

                    //  $o7->amount_balance = $o1->user_new_balance;
                    if ($o3->wallet_type == "Aeps") {
                        $o2->aeps_balance = $o1->user_new_balance;
                        $amount_balance = $o2->aeps_balance;
                    } else if ($o3->wallet_type == "Dmr") {
                        $o2->dmr_balance = $o1->user_new_balance;
                        $amount_balance = $o2->dmr_balance;
                    } else {
                        $o2->amount_balance = $o1->user_new_balance;
                        $amount_balance = $o2->amount_balance;
                    }



                    $o2->user_id = $updater->update_object($o2, "users");


                    //Send Money
                    $o7->parent_id = 0;
                    $o7->api_id = 0;
                    $o7->api_old_balance = 0;
                    $o7->api_amount = 0;
                    $o7->api_new_balance = 0;
                    $o7->api_name = "";
                    $o7->provider_id = "0";
                    $o7->provider_name = "0";
                    $o7->user_id = $o->user_id;
                    $o7->user_name = $o->user_name . " " . $o->name;
                    $o7->user_1_id = $o2->user_id;
                    $o7->user_1_name = $o2->user_name . " " . $o2->name;
                    $o7->cash_credit = 'Cash';
                    $o7->transfer_type = "Debit";
                    $o7->user_old_balance = $user_amount;
                    $o7->total_amount = $o3->amount;
                    $o7->amount = $o3->amount;
                    $o7->transaction_type = 'Send Money';
                    $o7->user_new_balance = $o7->user_old_balance - $o3->amount;
                    $o7->transaction_details = "Rs. " . $o7->amount . " Money Transfer to " . $o7->user_1_name;
                    $o7->transaction_date = todaysDate();
                    $o7->created_at = todaysDate();
                    $o7->updated_at = todaysDate();
                    $o7->ref_number = reference_number();
                    $o7->api_number = $o3->transaction_number;
                    $o7->opid = $o3->transaction_number;
                    $o7->api_response = "";
                    $o7->commission_ret = "0";
                    $o7->gst = "0";
                    $o7->tds = "0";
                    $o7->recharge_path = "Web";
                    $o7->ip_address = $_SERVER['REMOTE_ADDR'];
                    $o7->request_url = "";
                    $o7->request_url_api = "";
                    $o7->callback_reponse = "";
                    $o7->callback_reponse_api = "";
                    $o7->payment_mode = $o3->transfer_mode;
                    $o7->comment = $_POST['remark'];
                    $o7->provider_type = $o7->transaction_type;
                    $o7->circle_id = 0;
                    $o7->circle_name = "";
                    $o7->mobile_number = "";
                    $o7->status = "Success";
                    $o7->disputed = "No";
                    $o7->disputed = "No";
                    $o7->is_active = "1";
                    $o7->month_year = date("F") . "-" . date('Y');
                    $o7->money_file = $o3->file_money;

                    $o7->send_user_type = $o->user_type;
                    $o7->bank_details = $o3->bank_details;
                    $o7->bank_id = $o3->bank_id;
                    $o7->wallet_id = $insertor->insert_object($o7, "wallet");
                    if ($o3->wallet_type == "Aeps") {
                        $o->aeps_balance = $o7->user_new_balance;
                    } else if ($o3->wallet_type == "Dmr") {
                        $o->dmr_balance = $o7->user_new_balance;
                    } else {
                        $o->amount_balance = $o7->user_new_balance;
                    }

                    $o->user_id = $updater->update_object($o, "users");

                    $user_type = strtolower($o2->user_type);
                    $user_type = explode(" ", $user_type);
                    $count_user_type = count($user_type);
                    if ($count_user_type == "1") {
                        $sms_type = $user_type[0];
                    } else {
                        $sms_type = $user_type[0] . "_" . $user_type[1];
                    }
                    $sql_sms = "Select * from sms_settings where is_active='1' and category='Fund Transfer' and " . $sms_type . " ='Yes' ";
                    $res_sms = getXbyY($sql_sms);
                    $row_sms = count($res_sms);
                    if ($row_sms > 0) {

                        $find_array = ["{MobileNo}", "{Password}", "{Pin}", " {FromUserId}", "{ToUserId}", "{Amount}", "{CurrentBalance}", "{Reason}", "{TransactionId}", "{OperatorName}", "{OperatorId}", "{OTP}", "{Date}", "{Time}", "{company_name}", "&nbsp;", "{transaction type}"];
                        $replace_array = [$o2->mobile, $password, $pin, $from_user_id, $to_user_id, $o1->amount, $o2->amount_balance, $reason, $transaction_id, $operator_name, $operator_id, $o1->otp, $date, $time, $res_site[0]['site_name'], " ", $o1->transfer_type];
                        $mobile_message = str_ireplace($find_array, $replace_array, $res_sms[0]['content']);
                        sendsms_3gsolutions($o2->mobile, $mobile_message);
                    }
                    //    $message = "Your wallet have been " . $o1->transfer_type . "ed with Rs. " . $o1->amount . " by Admin. Your new Neope balance is Rs. " . $amount_balance;
                    // sendsms_3gsolutions($o2->mobile, $message);
                    // sendmail("info@neope.in", $o2->email, "Neope Wallet Update By Admin", "Dear " . $o2->name . ",<br/>" . $message . "<br/>Thanks you,<br/> Neope Team.");
                } else {

                    $user_type = strtolower($o2->user_type);
                    $user_type = explode(" ", $user_type);
                    $count_user_type = count($user_type);
                    if ($count_user_type == "1") {
                        $sms_type = $user_type[0];
                    } else {
                        $sms_type = $user_type[0] . "_" . $user_type[1];
                    }
                    $sql_sms = "Select * from sms_settings where is_active='1' and category='Payment Rejected' and " . $sms_type . " ='Yes' ";
                    $res_sms = getXbyY($sql_sms);
                    $row_sms = count($res_sms);
                    if ($row_sms > 0) {
                        $reason = $_POST['remarks'];
                        $find_array = ["{MobileNo}", "{Password}", "{Pin}", " {FromUserId}", "{ToUserId}", "{Amount}", "{CurrentBalance}", "{Reason}", "{TransactionId}", "{OperatorName}", "{OperatorId}", "{OTP}", "{Date}", "{Time}", "{company_name}", "&nbsp;", "{transaction type}"];
                        $replace_array = [$o2->mobile, $password, $pin, $from_user_id, $to_user_id, $o1->amount, $o2->amount_balance, $reason, $transaction_id, $operator_name, $operator_id, $o1->otp, $date, $time, $res_site[0]['site_name'], " ", $o1->transfer_type];
                        $mobile_message = str_ireplace($find_array, $replace_array, $res_sms[0]['content']);
                        sendsms_3gsolutions($o2->mobile, $mobile_message);
                    }
                    // $message = "Your Payment request  have been rejected  by Admin." . $_POST['remarks'];
                    // sendsms_3gsolutions($o2->mobile, $message);
                    //  sendmail("info@neope.in", $o2->email, "Neope Payment Request Rejected", "Dear " . $o2->name . ",<br/>" . $message . "<br/>Thanks you,<br/> Neope Team.");
                }
                $o3->request_money_id = $updater->update_object($o3, "request_money");
                $notification = "Your Request Money request have been " . $o3->status . " by Admin.";
                insert_notifications($o2->user_id, $notification, "Request Money");
                $result['error_msg'] = "Information Updated Successfully";
                $result['error'] = '0';
            } else {
                $result['error'] = 1;
                $result['error_msg'] = "Insufficient Balance";
            }
        } else {
            $result['error_msg'] = "Something went wrong please try again";
            $result['error'] = 1;
        }
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