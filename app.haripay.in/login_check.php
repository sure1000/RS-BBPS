<?php

session_start();
include "include.php";

if ($updte == 1) {
	$o->email = $_POST['email'];
	$o->password = cpassword($_POST['password']);

	$sql_check = "Select user_id, kyc_id, kyc_date from users where user_type !='Admin' and (email = '" . $o->email . "' or mobile = '" . $o->email . "') and password = '" . $o->password . "' and is_active = 1";
	$res_check = getXbyY($sql_check);
	$row_check = count($res_check);

	if ($row_check == 1) {
	$o = $factory->get_object($res_check[0]['user_id'], "users", "user_id");

		$user_login = 1;

		if ($o->kyc_id == 0) {
			$current_time = strtotime(todaysDate());
			$expiry_time = strtotime($o->kyc_date);

			if ($current_time > $expiry_time) {
				$user_login = 0;
			}
		}

		if ($user_login == 1)
		{

      if($o->user_type == "Whitelabel User")
			{
      $_SESSION['w_id'] = $o->user_id;
			// $_SESSION['w_name'] = $o->user_name;
			// $_SESSION['last_login'] = $o->last_login;
      }
      else
			{
			$_SESSION['user_id'] = $o->user_id;
			$_SESSION['user_name'] = $o->user_name;
			$_SESSION['last_login'] = $o->last_login;
      $_SESSION['white_label_id'] = $o->white_label_id;
      }
			$o->last_login = todaysDate();

			$o->user_id = $updater->update_object($o, "users");
      if($o->user_type == 'Whitelabel User')
			{
      $result['error'] = 2;
			$result['error_msg'] = "Perfect Match. Taking you to Dashboard";
      }else{
			$result['error'] = 0;
			$result['error_msg'] = "Perfect Match. Taking you to Dashboard";
           }
       }
		 else {
			$o->is_active = 0;
			$o->user_id = $updater->update_object($o, "users");

			$result['error'] = 1;
			$result['error_msg'] = "Your Account is Blocked as your KYC was not completed. Please Contact Admin for further action";
		}
	} else {
		$result['error'] = 1;
		$result['error_msg'] = "Username / Password Mismatch. Please try again";
	}
}

echo json_encode($result);
?>
