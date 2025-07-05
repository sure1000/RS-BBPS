<?php
include "include.php";

	if (isset($_POST['updte1'])) {
	$updte = $_POST['updte1'];
} else {
	$updte = 0;
}
function randomPassword()
	{
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}
if ($updte == 1) {
	$o->email = $_POST['forgot_email'];

	$sql_check = "Select user_id from users where( email = '" . $o->email . "' or mobile = '" . $o->email . "') and is_active > 0";
	$res_check = getXbyY($sql_check);
	$row_check = count($res_check);

	if ($row_check == 1) {
		$o = $factory->get_object($res_check[0]['user_id'], "users", "user_id");
        $pin = rand(1111,9999);
		$pass= randomPassword();
		$o->password = cpassword($pass);
		$o->kyc_id = $pin;

		$o->user_id = $updater->update_object($o, "users");

		$email_from = $res_site[0]['email'];
		$email_to = $o->email;
		$email_subject = "Password  & Pin Reset for " . $res_site[0]['site_name'];
        $email_message ="Your Password is ".$pass." & Pin is " . $pin;		

		sendmail($email_from, $email_to, $email_subject, $email_message);

	//	$mobile_message = "Password for " . $res_site[0]['site_name'] . " is " . $pass . " & Pin is  " . $pin . " If this was not from you, there is nothing to worry, just ignore the request";
		$mobile_message = "Dear fastsbpay user your password is " . $pass . "& pin is   " . $pin . " Thanks you...";
		//pt($email_message);
		sendsms_payzoom($o->mobile, $mobile_message);

		$result['error'] = 0;
		$result['error_msg'] = "Password & Pin sent on your mobile and email. Please verify to change your password ";
	} else {
		$result['error'] = 1;
		$result['error_msg'] = "No user found with this email. Please check email";
	}
}


echo json_encode($result);
?>