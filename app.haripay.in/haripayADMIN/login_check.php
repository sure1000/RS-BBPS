<?php
session_start();
include "include.php";

if($updte == 1){ 
	$o->email = $_POST['email'];
	$o->password = cpassword($_POST['password']);

	$sql_check = "Select user_id from users where email = '".$o->email."' and password = '".$o->password."' and user_type = 'Admin' and  is_active = 1";
	$res_check = getXbyY($sql_check);
	$row_check = count($res_check);

	if($row_check == 1){
		$o = $factory->get_object($res_check[0]['user_id'],"users","user_id");
		// $_SESSION['recharge_admin_id'] = $o->user_id;
		// $_SESSION['recharge_app_admin_name'] = $o->name;
		// $_SESSION['last_login'] = $o->last_login;
        
        $o->last_login = todaysDate();
		$o->login_ip = $_SERVER['REMOTE_ADDR'];
        $o->otp = rand(111111, 999999);
        
        //sendsms_payzoom($o->mobile, $mobile_message);   
		$o->user_id = $updater->update_object($o, "users");
                
		$email_from = $res_site[0]['email'];
		$email_to = $o->email;
		$email_subject = "Login OTP";
               // include "mails/forgot_password.php";
                
                $mobile_message = "OTP To Verify your Account on " . $res_site[0]['site_name'] . " is " . $o->otp . ". If this was not from you, there someone is trying to login  on " . $res_site[0]['site_name'];
        sendmail($email_from, $email_to, $email_subject, $mobile_message);
        $result['error'] = 0;
        $result['user_id'] =$o->user_id;
		$result['error_msg'] = "Perfect Match. Verify otp now".$o->otp;
	}else{
		$result['error'] = 1;
		$result['error_msg'] = "Username / Password Mismatch. Please try again";
	}


}

echo json_encode($result);

?>