<?php

session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

if ($updte == 1) {
    $mobile = $_POST['mobile'];
    $service = $_POST['service'];
  //  $substr1 = substr($mobile, 0, 4);
//    $sql = "Select * from user_mobiles where mobile_number = '" . $mobile . "'";
//    $res = getXbyY($sql);
//    $rows = count($res);
//    if ($rows == 1) {
//        $result['provider'] = $res[0]['provider'];
//        $result['provider_id'] = get_provider_name_by_service($result['provider'], $service);
//        $result['circle'] = $res[0]['circle'];
//    } else {
       
     //   $api_response = get_number_info($mobile);
      $api_response = get_number_info_planapi($mobile);
      if($api_response['Operator'] == "BSNL GSM"){
        $api_response['Operator'] = "BSNL";
    }
     else if($api_response['Operator'] == "Reliance Jio Infocomm Limited"){
        $api_response['Operator'] = "JIO";
    }
    $provider_name = ucfirst($api_response['Operator']);
    $circle_name = ucfirst($api_response['Circle']);
    
    if($circle_name == "Bihar and Jharkhand"){
        $circle_name = "Bihar Jharkhand";
    }
   else if($circle_name == "MP and Chattisgarh"){
        $circle_name = "Madhya Pradesh Chhattisgarh";
    }
   else if($circle_name == "Delhi"){
        $circle_name = "Delhi NCR";
    }
  
    
//        $api_response = get_number_info_recharge_plan($mobile);
//        
//        
//         if ($api_response['response']['0']['ported'] == "True") {
//             $provider_name = $api_response['response']['0']['new_operator'] ;
//             $circle_name = $api_response['response']['0']['new_circle'] ;
//         }else{
//             $provider_name = $api_response['response']['0']['old_operator'] ;
//             $circle_name = $api_response['response']['0']['old_circle'] ;
//         }
//          if($provider_name == "Reliance Jio"){
//              $provider_name = "Jio";
//          }
//          if($circle_name == "Delhi"){
//              $circle_name = "Delhi NCR";
//          }
//          else if($circle_name == "UP-East"){
//              $circle_name = "UP East";
//          }
//          else if($circle_name == "UP-West"){
//              $circle_name = "UP West";
//          }

            $result['provider_name'] = $provider_name;
            $result['provider_id'] = get_provider_name_by_service($provider_name, $service);
            $result['circle'] = $circle_name;
            $result['api'] = $api_response;
        
    //}
}

echo json_encode($result);
?>