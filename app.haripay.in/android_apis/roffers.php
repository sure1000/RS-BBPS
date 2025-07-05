<?php
include "include.php";

if ($_POST) {
    
    $mobile = $_POST['mobile'];
    $provider_id = $_POST['provider'];
    $service = $_POST['service'];
  
   // $o3 = $factory->get_object("9", "api", "api_id");
   
    $o3 = $factory->get_object("4", "api", "api_id");

    $provider = get_provider_name($provider_id);
    $provider_api_code = get_api_provider_code($provider_id,$o3->api_name);
    $offers = plan_api_roffers($provider_api_code, $mobile, $service);
	//pt($offers);die;
    $result['plans'] = $offers;
     $result['error'] = "0";
    }


echo json_encode($result);
?>