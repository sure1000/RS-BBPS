<?php
include "include.php";
if(isset($_POST['updte2'])){
	$updte = $_POST['updte2'];
}else{
	$updte = 0;
}

if($updte == 1){
	$o->email = $_POST['reset_email'];
	$o->otp = $_POST['verification_code'];
	$o->password = cpassword($_POST['new_password']);

	$sql_check = "Select user_id from users where email = '".$o->email."' and user_type = 'Admin' and otp = '".$o->otp."' and is_active = 1";
	$res_check = getXbyY($sql_check);
	$row_check = count($res_check);

	if($row_check == 1){

		$o = $factory->get_object($res_check[0]['user_id'], "users","user_id");

		$o->password = cpassword($_POST['confirm_password']);
		$o->otp = round(100000,999999);

		$o->user_id = $updater->update_object($o,"users");

		$result['error'] = 0;
		$result['error_msg'] = "Password Reset Successfully. Kindly login with New Password";
                
		$email_from = $res_site[0]['email'];
		$email_to = $o->email;
		$email_subject = "Password Reset for " . $res_site[0]['site_name'];

		include "mails/reset_password.php";

		sendmail($email_from, $email_to, $email_subject, $email_message);
	}else{
		$result['error'] = 1;
		$result['error_msg'] = "Verification Code mismatch. Please Try Again";
	}
}
$result['error'] = 0;

echo json_encode($result);

?>