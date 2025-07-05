<?php

session_start();
include "include.php";
$ajax_logout = 1;
include "session.php";

if ($_POST['id'] > 0) {
    $api_id = $_POST['id'];
//   if($api_id == '7'){
//    $response = balance_jri($api_id);
//   } else if($api_id == '8') {
//       $response = balance_tiptopmoney($api_id);
//   } else if($api_id == '12') {
//       $response = balance_shrimoney($api_id);
//   
//   } else if($api_id == '16') {
//       $response = dezire_get_balance($api_id);
//   }
   
    if($api_id == "2"){
        $response =  balance_roundpay($api_id);
       
    }
   else if($api_id == "4"){
        $response =  balance_ezulix($api_id);
       
    }
   else if($api_id == "5"){
        $response =  balance_cyrus($api_id);
       
    }
    else if($api_id =="6"){
         $response =  balance_rech($api_id);
        
    }
$o1 = $factory->get_object($api_id,"api","api_id");
$o1->api_balance =$response['Balance'];

$o1=$updater->update_object($o1,"api");
    if ($response['Balance'] != "") {
      

        $result['Balance'] = $response['Balance'];
      
        $result['error'] = 0;
        $result['error_msg'] = $response['Status'];
        
    } else {
        $result['error'] = 1;
        $result['error_msg'] = $response['Status'];
    }
} else {
    $result['error'] = 1;
    $result['error_msg'] = "Something went wrong. Please try again";
}

echo json_encode($result);
?>