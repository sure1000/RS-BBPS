<?php
include "include.php";


if ($_POST['user_id']) {
    $mobile = $_POST['mobile'];
    $service = $_POST['service'];
    $provider = $_POST['provider'];
  
    $o3 = $factory->get_object("3", "api", "api_id");
    $provider_api_code = get_api_provider_code($provider, $o3->api_name);
   
    $api_response = fetch_dth_info($mobile, $provider_api_code);
    $aa = json_decode(json_encode($api_response->records), true);
    if($aa[0]){
        
         //$api_response->DATA
         $result['error'] = "0";
         $result['data'] = $aa[0];
          $result['error_msg'] = '';
        
    }else{
        $result['error'] = "1";
        $result['error_msg'] = $api_response->Message;
        
    }

}

echo json_encode($result);
?>