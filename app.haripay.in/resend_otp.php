<?php

session_start();
include "include.php";

if ($_POST['user_id'] > 0) {
	$user_id = $_POST['user_id'];
} else {
	$user_id = 0;
}if ($user_id > 0) {

	$o = $factory->get_factory($user_id, "users", "user_id");
	if ($_POST['type'] == 'email') {
		$o->otp_email = rand(5000, 9999);

		include "mails/register.php";

		sendmail($o->email, "Resend OTP Email for ", $email_message);
		$o = $updater->update_object($o, "users");
		$result['error'] = 0;
		$result['error_msg'] = "Otp has been Resend to your mail";
	}
	if ($_POST['type'] == 'mobile') {
		$o->mobile_otp = rand(5000, 9999);
		$mobile_message = "OTP To Verify your Account on " . $res_site[0]['site_name'] . " is " . $o->mobile_otp . ". If this was not from you, there someone is trying to register your Email / Mobile No on " . $res_site[0]['site_name'];
		sendsms_payzoom($o->mobile, $mobile_message);
		$o = $updater->update_object($o, "users");
		$result['error'] = 0;
		$result['error_msg'] = "Otp has been Resend to your mobile";
	}

} else {
	$result['error'] = 1;
	$result['error_msg'] = "Something Went Wrong Please try again";
}
echo json_encode($result);
?>
