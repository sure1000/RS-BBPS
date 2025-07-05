<?php
include "include.php";
if (isset($o)) {
    $o = $factory->get_object($o->user_id, "users", "user_id");
if ($_POST['change_passowrd_updte'] == 1) {

	$old_password = cpassword($_POST['old_password']);
	$new_password = $_POST['new_password'];
	$confirm_password = $_POST['confirm_password'];
	if ($new_password != $confirm_password) {
		$results['error_msg'] = " New Password & Confirm Password Mismatch";
		$results['error'] = "1";
	} else {
		$sql = "Select user_id from users where user_id = '" . $o->user_id . "'  and  password='" . $old_password . "' and is_active = 1";
		$res = getXbyY($sql);
		$row = count($res);

		if ($row == 1) {
			$o1 = $factory->get_object($res[0]['user_id'], "users", 'user_id');
			$o1->password = cpassword($_POST['new_password']);
			$o1->user_id = $updater->update_object($o1, "users");
			$results['error_msg'] = "Password Changed Successfully";
			$results['error'] = "0";
		} else {
			$results['error_msg'] = "Invalid Old Password";
			$results['error'] = "1";
		}
	}
} else {
	$results['error_msg'] = "Something went wrong please try again";
	$results['error'] = "1";
}
}else {
	$results['error_msg'] = "Something went wrong please try again";
	$results['error'] = "1";
}



echo json_encode($results);
?>