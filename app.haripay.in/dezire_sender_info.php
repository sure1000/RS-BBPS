<?php

session_start();

include "include.php";
include "session.php";
$_POST['imps_senderinfo_updte'] = 1 ;
if ($_POST['imps_senderinfo_updte'] == '1') {
    $_POST['senderID'] = '71';
    $_POST['merchantUserID'] = '100002';
    $o1->senderID = $_POST['senderID'];
    $o1->merchantUserID = $_POST['merchantUserID'];
   
    
   // $api_reponse = dezire_money_sender_info($o1);
    $api_reponse = dezire_kycstatus_info($o1);
//{
//    "merchantUserID": [
//        "The value 'MerchantUserID' is not valid."
//    ]
//}
    pt($api_reponse);
 
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>


