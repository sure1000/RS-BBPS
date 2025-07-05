<?php

session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

if ($updte == 1) {
    $mobile = $_POST['mobile'];
    $provider_id = $_POST['provider'];
    $service = $_POST['service'];
    $provider = get_provider_name($provider_id);
    $amount = "0.02";
    
    if($amount <= $o->amount_balance){
        $o3 = $factory->get_object("5","api","api_id");
        
        if($amount <= $o3->api_balance){
            $o2 = new wallet;
            
            $o2->api_id = 5;
            $o2->transaction_type = "User Info Check";
            $o2->api_amount = $amount;
            $o2->amount = $amount;
            $o2->provider_id = $provider_id;
            $o2->mobile_number = $mobile;
            $o2->status = "Success";
            
            $o2 = wallet_insert($o, $o2);

            $provider_api_code = get_api_provider_code($o2->provider_id, $o2->api_name);

            $user_info = mplan_roffers($provider_api_code, $mobile, "dth_user_info");

            $o2->api_response = $user_info;
            $o2->wallet_id = $updater->update_object($o2, "wallet");



            $values = json_decode($user_info);



            $result['amount_balance'] = $o2->user_new_balance;
            $result['error'] = 0;
            $result['error_msg'] = "User Information Fetched";

            $total_records = count($values->records);

            if($total_records > 0){
                if(is_array($values->records)){
                    $sstring = "<div class='row'><div class='col-md-12'>Customer Name: <b>".$values->records[0]->customerName."</b></div>"
                        . "<div class='col-md-12'>Balance: <b>:<i class='fa fa-rupee-sign'></i> ".$values->records[0]->Balance."</b></div>"
                        . "<div class='col-md-12'>Monthly Recharge: <b><i class='fa fa-rupee-sign'></i> ".$values->records[0]->MonthlyRecharge."</b></div>"
                        . "<div class='col-md-12'>Next Recharge Date: <b>:".$values->records[0]->NextRechargeDate."</b></div>"
                        . "<div class='col-md-12'>Last Recharge Date: <b>:".$values->records[0]->lastrechargedate."</b></div>"
                        . "<div class='col-md-12'>Last Recharge Amount: <b>:<i class='fa fa-rupee-sign'></i> ".$values->records[0]->lastrechargeamount."</b></div>"
                        . "<div class='col-md-12'>Status: <b>".$values->records[0]->status."</b></div>"
                        . "<div class='col-md-12'>Plans: <b>".str_replace(',', '<br />', $values->records[0]->planname)."</b></div>"
                        . "</div>";
                }else{
                    $sstring = "<div class='row'><div class='col-md-12'>Apologies we were not able to fetch User Information</div></div>";
                }        
            }else{
                $sstring = "<div class='row'><div class='col-md-12'>Apologies we were not able to fetch User Information</div></div>";
            }
            $result['plans'] = $sstring;
        }else{
            $result['error'] = 1;
            $result['error_msg'] = "Apologies. Something is terribly wrong. Admin is already working on it";
            sendmail($res_site[0]['email'], $res_site[0]['email'], $o3->api_name." API Balance Low", "Please Update API Balance as users are getting failures");
        }
    }else{
        $result['error'] = 1;
        $result['error_msg'] = "Sorry, Your Wallet Balance is less than Required Amount";
    }
}

echo json_encode($result);
?>