<?php
include "include.php";

if (isset($_POST['updte1'])) {
	$updte = $_POST['updte1'];
} else {
	$updte = 0;
}

if ($updte == 1) {
	$o->email = $_POST['forgot_email'];

	$sql_check = "Select user_id from users where (email = '" . $o->email . "' or mobile = '" . $o->email . "' )and is_active > 0";
	$res_check = getXbyY($sql_check);
	$row_check = count($res_check);

	if ($row_check == 1) {
		$o = $factory->get_object($res_check[0]['user_id'], "users", "user_id");

		$o->otp = rand(100000, 999999);

		$o->user_id = $updater->update_object($o, "users");

		$email_from = $res_site[0]['email'];
		$email_to = $o->email;
		$email_subject = "Password Reset for " . $res_site[0]['site_name'];
		//$email_message = "Verification Code : ".$o->new_password;
                   $email_message =  $o->otp;
		include "mails/forgot_password.php";

		/*$email_message = "<html><head><title>Password Reset for " . $res_site[0]['site_name'] . "</title></head><body style='font-family: Arial, Helvetica, sans-serif;'>
			<table style='border:1px solid #ccc;border-radius:8px;' cellpadding='8'>
			<tr><td><img src='" . $res_site[0]['site_url'] . "/img/logo.png' width='256' /></td></tr>
			<tr><td style>Greetings " . $o->user_name . "</td></tr>
			<tr><td>Someone has requested to reset password for your account. In order to protect and verify that it was a valid request, we are sending a verification code that is required to reset the password. The verification code is as follows:</td></tr>
			<tr><td><b>Verification Code: " . $o->otp . "</td></tr>
			<tr><td>If this was not a valid request, there is nothing to worry and just ignore the request. Nothing will happen to your password</td></tr>
			<tr><td>Thanking you</td></tr>
			<tr><td>Admin - " . $res_site[0]['site_name'] . "</td></tr>
			<tr><td>Email: " . $res_site[0]['email'] . "</td></tr>
		*/

		sendmail($email_from, $email_to, $email_subject, $email_message);

		//$mobile_message = "OTP for " . $res_site[0]['site_name'] . " is " . $o->otp . ". If this was not from you, there is nothing to worry, just ignore the request";
		//sendsms_payzoom($o->mobile, $mobile_message);

		$result['error'] = 0;
		$result['error_msg'] = "Verification Code Sent to your email address. Please verify to change your password";
	} else {
		$result['error'] = 1;
		$result['error_msg'] = "No user found with this email. Please check email";
	}
}

echo json_encode($result);
?>