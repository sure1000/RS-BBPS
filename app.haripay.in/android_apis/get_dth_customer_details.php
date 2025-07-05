<?php

include "include.php";


if ($_POST['dth_updte'] == 1) {
    $mobile = $_POST['mobile'];
    $provider_id = $_POST['provider'];
    $service = $_POST['service'];
    $provider = get_provider_name($provider_id);
    $amount = "0.02";

    if ($amount <= $o->amount_balance) {
        $o3 = $factory->get_object("7", "api", "api_id");
       
        $o2->transaction_type = "User Info Check";
        $o2->api_id = $o3->api_id;
        $o2->api_amount = $amount;
        $o2->amount = $amount;
        $o2->provider_id = $provider_id;
        $o2->mobile_number = $mobile;
        $o2->status = "Success";
        wallet_insert_new($o, $o2);
      
        $provider_api_code = get_api_provider_code($o2->provider_id, $o2->api_name);

        $user_info = mplan_roffers($provider_api_code, $mobile, "dth_user_info");
    
        $o2->api_response = $user_info;
        $o2->wallet_id = $updater->update_object($o2, "wallet");

        $values = json_decode($user_info);

        $result['error'] = "0";
        $result['error_msg'] = "User Information Fetched";

        $total_records = count($values->records);
        $data = (json_decode($values->data->Plan));
        $data_show = "Next Recharge Date";
        $result['Name'] = $values->data->Name;
        $result['Rmn'] = $values->data->Rmn;
        $result['VC'] = $values->data->VC;
        $result['Monthly'] = $values->data->Monthly;
        $result['Balance'] = $values->data->Balance;
        $result['Balance'] = $values->data->Balance;
        $result['Next_Recharge_Date'] = $values->data->$data_show;

        for ($i = 0; $i < count($data); $i++) {
            $sstring[$i]['desc'] = $data[$i];
        }
        $result['plans'] = $sstring;
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "Sorry, Your Wallet Balance is less than Required Amount";
    }
}

echo json_encode($result);
?>