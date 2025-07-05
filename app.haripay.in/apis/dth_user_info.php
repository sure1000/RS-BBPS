<?php

include "include.php";


if (isset($_POST)) {
    $o->user_id = $_POST['user_id'];
    $o = $factory->get_object($o->user_id, "users", "user_id");
    if ($o->is_active == "1") {

        $mobile = $_POST['mobile'];
        $provider_id = $_POST['provider'];
        $service = $_POST['service'];
        $provider = get_provider_name($provider_id);
        $amount = "0.02";

        if ($amount <= $o->amount_balance) {
            $o3 = $factory->get_object("5", "api", "api_id");

            if ($amount <= $o3->api_balance) {
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
                $result['error'] = "0";


                $total_records = count($values->records);

                if ($total_records > 0) {
                    if (is_array($values->records)) {

                        $res_data[0]['name'] = (string) $values->records[0]->customerName;
                        $res_data[0]['balance'] = (string) $values->records[0]->Balance;
                        $res_data[0]['monthly_recharge'] = (string) $values->records[0]->MonthlyRecharge;
                        $res_data[0]['next_recharge_date'] = (string) $values->records[0]->NextRechargeDate;
                        $res_data[0]['last_recharge_date'] = (string) $values->records[0]->lastrechargedate;
                        $res_data[0]['last_recharge_amount'] = (string) $values->records[0]->lastrechargeamount;
                        $res_data[0]['status'] = (string) $values->records[0]->status;
                        $res_data[0]['plans'] = (string) $values->records[0]->planname;
                        $result['error_msg'] = "User Information Fetched";
                    } else {
                        $result['error_msg'] = "Apologies we were not able to fetch User Information";
                    }
                } else {

                    $result['error_msg'] = "Apologies we were not able to fetch User Information";
                }
                $result['plans'] = $res_data;
            } else {
                $result['error'] = "1";
                $result['error_msg'] = "Apologies. Something is terribly wrong. Admin is already working on it";
                sendmail($res_site[0]['email'], $res_site[0]['email'], $o3->api_name . " API Balance Low", "Please Update API Balance as users are getting failures");
            }
        } else {
            $result['error'] = "1";
            $result['error_msg'] = "Sorry, Your Wallet Balance is less than Required Amount";
        }
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "Something went wrong. Please try again";
    }
}

echo json_encode($result);
?>