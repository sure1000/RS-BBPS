<?php
session_start();
include 'include.php';


if($_POST['user_id'] > 0){
   $o= $factory->get_object($_POST['user_id'],"users","user_id");
   $o->otp = rand(5000, 9999);
   $mobile_message = "OTP To Verify your Account on " . $res_site[0]['site_name'] . " is " . $o->otp . ". If this was not from you, there someone is trying to login  on " . $res_site[0]['site_name'];
   sendsms_payzoom($o->mobile, $mobile_message);   
   $o->user_id = $updater->update_object($o, "users");
        $result['user_id'] = $o->user_id ;
        $result['error'] = 0;
		$result['error_msg'] = "OTP resend successfully";


}else{
		$result['error'] = 1;
		$result['error_msg'] = "Something went wrong";
	}


echo json_encode($result);

?>