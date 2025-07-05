<?php
session_start();
include "include.php";
$ajax_logout = 1;
include "session.php";

if($updte == 1){
    $phone_email = $_POST['phone_email'];
    
    $sql = "Select * from users where mobile = '".$phone_email."' or email = '".$phone_email."' and is_active = 1";
    $res = getXbyY($sql);
    $rows = count($res);
    
    if($rows == 1){
        $result['error'] = 0;
        $result['error_msg'] = "User Info found. Please verify before sending money";
        $result['user_id'] = $res[0]['user_id'];
        $result['name'] = $res[0]['name'];
        $result['user_name'] = $res[0]['user_name'];
        $result['mobile'] = $res[0]['mobile'];
        $result['email'] = $res[0]['email'];
        $result['amount_balance'] = $res[0]['amount_balance'];
        $result['credit_amount'] = $res[0]['credit_amount'];
        $result['credit_limit'] = $res[0]['credit_limit'];
        $result['pending_limit'] = ($res[0]['credit_limit'] - $res[0]['credit_amount']);
    }else{
        $result['error'] = 1;
        $result['error_msg'] = "No User found with this Email / Phone Number";
    }
}else{
    $result['error'] = 1;
    $result['error_msg'] = "Something went wrong. Please try again";
}

echo json_encode($result);
?>