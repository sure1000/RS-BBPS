<?php

session_start();
include "include.php";
$ajax_logout = 1;
include "session.php";

if ($_POST['wallet_id'] > 0) {
    $o1->wallet_id = $_POST['wallet_id'];
    $o1 = $factory->get_object($o1->wallet_id, "wallet", "wallet_id");
    if($o1->api_id == "2"){
         $response = recharge_status_roundpay($o1);
         $response = $response['response'];
    }else if($o1->api_id == "4"){
         $response = recharge_status_ezulix($o1);
         $response = $response['response'];
    }else if($o1->api_id == "5"){
         $response = recharge_status_cyrus($o1);
         
         $response = $response['response'];
    }else if ($o1->api_id == '6') {
       $response = rechapi_status($o1);
   }
   else if ($o1->api_id == '12') {
       $response = recharge_status_ezytm($o1);
        $response = $response['response'];
   } else{
       $response = ""; 
    }
    

//    if ($o1->api_id == '7') {
//        $response = jri_status($o1);
//    } else if ($o1->api_id == '8') {
//        $response = status_tiptopmoney($o1);
//    } else if ($o1->api_id == '9') {
//        $response = rechapi_status($o1);
//    } else if ($o1->api_id == '10') {
//        $response = threeg_status($o1);
//    } else if ($o1->api_id == '6') {
//        $response = status_easymywallet($o1->ref_number);
//    } else if ($o1->api_id == '13') {
//        $response = status_Mrobotics($o1->ref_number);
//    } else if ($o1->api_id == '15') {
//        $response = status_ezytm($o1->ref_number);
//    } else if ($o1->api_id == '16' && $o1->provider_id =="84") {
//            $response = dezire_status($o1);
//            $response = $response['response'];
//    }else {
//        
//    }

    $result['error'] = 0;
    $result['response'] = $response;
    $result['error_msg'] = "Success";
} else {
    $result['error'] = 1;
    $result['error_msg'] = "Something went wrong. Please try again";
}

echo json_encode($result);
?>