<?php
include "include.php";


if ($_POST['dth_info'] == "1" ) {
    $mobile = $_POST['mobile'];
    $service = $_POST['service'];
    $provider = $_POST['provider'];
  
    $o3 = $factory->get_object("10", "api", "api_id");
    $provider_api_code = get_api_provider_code($provider, $o3->api_name);
   
    $api_response = fetch_dth_info($mobile, $provider_api_code);
    
    $aa = json_decode(json_encode($api_response->DATA), true);
    $bb = "Next Recharge Date";
    $cc = "PIN Code";
    $aa["next_recharge_date"] = $aa[$bb];
    $aa["pin_code"] = $aa[$cc];
    
    if($api_response->error == "0"){
        
        //$api_response->DATA
         $result['error'] = "0";
         $result['VC'] = $api_response->DATA->VC;
         $result['dth_Name'] = $api_response->DATA->Name;
         $result['dth_Rmn'] = $api_response->DATA->Rmn;
         $result['dth_Balance'] = "Rs. ".$api_response->DATA->Balance;
         $result['dth_Monthly'] = $api_response->DATA->Monthly;
         $result['dth_Next_recharge'] = $aa['next_recharge_date'];
         $result['dth_Address'] = $api_response->DATA->Address;
         $result['dth_Plan'] = $api_response->DATA->Plan;
         $result['dth_City'] = $api_response->DATA->City;
         $result['dth_State'] = $api_response->DATA->State;
         $result['dth_Pin'] = $aa["pin_code"];
         $result['dth_District'] = $api_response->DATA->District;
          $result['error_msg'] = $api_response->Message;
        
    }else{
        $result['error'] = "1";
        $result['error_msg'] = $api_response->Message;
        
    }

}

echo json_encode($result);
?>