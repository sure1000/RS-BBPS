<?php
session_start();
include 'include.php';


if($_POST['user_id'] > 0){
   $o= $factory->get_object($_POST['user_id'],"users","user_id");

   if($o->otp == $_POST['otp']){

   	    $_SESSION['recharge_admin_id'] = $o->user_id;
		$_SESSION['recharge_app_admin_name'] = $o->name;
		$_SESSION['last_login'] = $o->last_login;
        $result['error'] = 0;
		$result['error_msg'] = "Perfect Match, Taking you to dashboard";
   }else{
   	$result['error'] = 1;
		$result['error_msg'] = "Invalid OTP";
   }

}else{
		$result['error'] = 1;
		$result['error_msg'] = "Something went wrong";
	}


echo json_encode($result);

?>