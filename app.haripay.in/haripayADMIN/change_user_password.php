<?php
session_start();
include "include.php";
$ajax_logout = 1;
include "session.php";

if($updte == 1){
    $o1->user_id = $_POST['user_id'];
    $o1 = $factory->get_object($o1->user_id,"users", "user_id");
    
    if($o1->user_id > 0){
        $paswd = substr(md5(rand(10000,99999)),0,8);
        $o1->password = cpassword($paswd);
        //pt($o1);
        $o1->user_id = $updater->update_object($o1,"users");
        
        $result['error'] = 0;
        $result['new_password'] = $paswd;
        $result['error_msg'] = "New Password is: ".$paswd;
    }
}else{
    $result['error'] = 1;
    $result['error_msg'] = "Something went wrong. Please try again";
}

echo json_encode($result);
?>