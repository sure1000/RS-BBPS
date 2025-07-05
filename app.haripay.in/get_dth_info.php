<?php

session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

if ($updte == 1) {
    $mobile = $_POST['mobile'];
    $service = "dth_user_info";
    $provider = $_POST['provider'];
    
    // $o3 = $factory->get_object("9", "api", "api_id");
   
    $o3 = $factory->get_object("4", "api", "api_id");
  
    $provider_api_code = get_api_provider_code($provider, $o3->api_name);
   
    $api_response = mplan_roffers($provider_api_code, $mobile, $service);
     //pt($api_response);die;
//     $aa = json_decode(json_encode($api_response->records), true);
//     $bb = "Next Recharge Date";
//     $cc = "PIN Code";
//     $aa["next_recharge_date"] = $aa[$bb];
//     $aa["pin_code"] = $aa[$cc];
    
    if($api_response->status == "1"){
        
         $result['error'] = "0";
         $result['VC'] = $api_response->tel;
         $result['dth_Name'] = $api_response->records[0]->customerName;
         //$result['dth_Rmn'] = $api_response->records->Rmn;
         $result['dth_Balance'] = "Rs. ".$api_response->records[0]->Balance;
         $result['dth_Monthly'] = $api_response->records[0]->MonthlyRecharge;
         $result['dth_Next_recharge'] = $api_response->records[0]->NextRechargeDate;
         //$result['dth_Address'] = $api_response->records->Address;
         $result['dth_Plan'] = $api_response->records[0]->planname;
         //$result['dth_City'] = $api_response->records->City;
        // $result['dth_State'] = $api_response->records->State;
         //$result['dth_Pin'] = $aa["pin_code"];
         //$result['dth_District'] = $api_response->records->District;
         $result['error_msg'] = $api_response->records[0]->msg;
         $result['json_data'] = $api_response;
        

    }else{
        $result['error'] = "1";
    }
     
    
      
$result['plans'] = $sstring;
}


echo json_encode($result);
?>