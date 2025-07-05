<?php
include "include.php";

if ($_POST['electricity_updte'] == '1') {

    $o1 = new wallet;

    $o1->amount = $_POST['electricity_amount'];
    $o1->total_amount =$_POST['electricity_amount'];
    $o1->mobile_number = $_POST['electricity_account_number'];
    $customer_number =$_POST['electricity_mobile'];
    // $customer_name =$_POST['electricity_customer_name'];
    $o1->provider_id = $_POST['electricity_provider'];
    $o1->circle_id = "0";
    $service_id = "7";
     if ($o1->amount <= $o->amount_balance) {
    if ( $o1->total_amount < 10000) {

        $o1->api_amount = $o1->amount;
        $o1->transaction_type = "Recharge";

        //$o1 = wallet_insert($o, "0", "", $api_id, "Recharge", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Pending", "Web", $o1->circle_id, $o1->circle_name, $parent_id);
        $o1 = wallet_insert($o, $o1);
        // $o1->total_amount = $_POST['prepaid_amount'];
        $total_amount = $o1->total_amount;

        $result = recharge_rechapi($o1);

        if ($result['error'] == "0") {
            $o1->api_number = $result['tnx_id'];
            $o1->comment = $result['message'];
            $o1->updated_at = todaysDate();
            if ($result['status'] == "Failed") {
                $o1->status = "Failed";
                $o1->api_response = $result['response'];
                $o1->comment = $o1->comment . " - " . todaysDate();
                $o1->wallet_id = $updater->update_object($o1, "wallet");

                $o1->transaction_type = "Refund";
                $o1->status = "Success";
                $o1->parent_id = $o1->wallet_id;
                $o1 = wallet_insert($o, $o1);
                 $result['error_msg'] = "Recharge " .$result['status'] ;
            } else {
                $o1->api_response = $result['response'];
                $o1->opid = $result['opid_id'];
                $o1->comment = $result['message'] . " - " . todaysDate();
                if ($result['status'] == "Pending") {
                    $o1 = $factory->get_object($o1->wallet_id, "wallet", "wallet_id");
                    $o1->api_response = $result['response'];
                    $o1->opid = $result['opid_id'];
                    $o1->comment = $result['message'] . " - " . todaysDate();
                    $o1->api_number = $result['tnx_id'];
                    $o1->updated_at = todaysDate();
                    if ($o1->status == "Pending") {
                        $o1->wallet_id = $updater->update_object($o1, "wallet");
                    }
                     $result['error_msg'] = "Recharge " .$result['status'] ;
                    } else if ($result['status'] == "Success") {
                      $o1->status = "Success";
                      $o1->wallet_id = $updater->update_object($o1, "wallet");
                      $o1->parent_id = $o1->wallet_id;
                      set_commission($o1, $o, "Prepaid");

                    if($o->white_label_id > 0) {
                        $user_type1=$o1->user_type;
                        $sql_sms = "Select * from sms_settings where is_active='1' and category='Successfully Recharge' and ".$user_type1." ='Yes'";

                        $res_sms = getXbyY($sql_sms);
                        $row_sms = count($res_sms);
                        if ($row_sms > 0) {
                            $name = $o->name;
                            $eamil = $o1->email;
                            $pin = $o->kyc_id;
                            $user_type = $o1->user_type;
                            $password = $_POST['password'];
                            $find_array = ["{MobileNo}", "{Password}", "{Pin}", "{Name}", "{Email}", "{User Type}", " {FromUserId}", "{ToUserId}", "{Amount}", "{CurrentBalance}", "{Reason}", "{TransactionId}", "{OperatorName}", "{OperatorId}", "{OTP}", "{Date}", "{Time}", "{Company Name}", "&nbsp;"];
                            $replace_array = [$o1->mobile, $password, $pin,  $name, $eamil, $user_type, $from_user_id, $to_user_id, $amount, $current_balance, $reason, $transaction_id, $operator_name, $operator_id, $o1->otp, $date, $time, $res_site[0]['site_name'], " "];

                            $message = str_ireplace($find_array, $replace_array, $res_sms[0]['content']);
                            sendsms_payzoom($o1->mobile, $message);
                        }

                    }
                    else {
                       $mobile_message ="Electricity bill successfully paid";
                       //sendsms_payzoom($customer_number,$mobile_message);
                     }
                       $result['error'] = 0;
                       $result['error_msg'] = "Recharge " .$result['status'];
                } else {
                    $result['error'] = 1;
                    $result['error_msg'] = "Recharge Failed. Please Try Again";
                    $o1->status = "Failed";
                    $o1->api_response = "Recharge Failed. No Response From Api";
                    $o1->wallet_id = $updater->update_object($o1, "wallet");

                    //$o1 = wallet_insert($o, "0", "", $api_id, "Refund", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Success", "Web", $o1->circle_id, $o1->circle, $o1->wallet_id);
                    $o1->transaction_type = "Refund";
                    $o1->status = "Success";
                    $o1->parent_id = $o1->wallet_id;
                    $o1 = wallet_insert($o, $o1);
                }
            }
        } else {
            $result['error'] = 1;
            $result['error_msg'] = "Recharge Failed. Please Try Again";
            $o1->status = "Failed";
            $o1->api_response = "Recharge Failed. No Response From Api";
            $o1->wallet_id = $updater->update_object($o1, "wallet");

            $o1->transaction_type = "Refund";
            $o1->status = "Success";
            $o1->parent_id = $o1->wallet_id;
            $o1 = wallet_insert($o, $o1);

            //$o1 = wallet_insert($o, "0", "", $api_id, "Refund", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Success", "Web", $o1->circle_id, $o1->circle, $o1->wallet_id);
        }

       // include "recharge_response.php";
    }else{
        $result['error'] = 1;
        $result['error_msg'] = "Max limit 10000";
    }
    } else {
        $result['error'] = 1;
        $result['error_msg'] = "Sorry, Your Wallet Balance is less than Required Amount";
    }
} else {
    $result['error'] = 1;
    $result['error_msg'] = "Something went wrong please try again";
}
$result['amount'] = $_POST['electricity_amount'];
echo json_encode($result);
?>
