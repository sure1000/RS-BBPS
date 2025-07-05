<?php

$verify_email = 1;
include "include.php";

if ($_POST['email_otp'] != "" && $_POST['mobile_otp'] != "") {

	$o->email_otp = $_POST['email_otp'];
	$o->mobile_otp = $_POST['mobile_otp'];
	$o->user_id = $_POST['user_id'];

	$sql_check = "Select user_id from users where email_otp = '" . $o->email_otp . "' and mobile_otp = '" . $o->mobile_otp . "' and user_id ='" . $o->user_id . "'";
	$res_check = getXbyY($sql_check);
	$rows_check = count($res_check);

	if ($rows_check == 1) {
		$o = $factory->get_factory($res_check[0]['user_id'], "users", "user_id");
		$user_type = $o->user_type;
		$o->mobile_verified = "Yes";
		$o->email_verified = "Yes";
		$o->is_active = 1;
		$o->last_login = todaysDate();
		if ($o->profile_pic == "") {
			$my_profile_pic = "./img/avatar.svg";
		} else {
			$my_profile_pic = "./profile_picture/thumbs/" . $o->profile_pic;
		}
		$result['user_id'] = $o->user_id;
		$result['dealer_code'] = $o->user_name;
		$result['user_name'] = $o->name;
		$result['email'] = $o->email;
		$result['amount_balance'] = $o->amount_balance;
		$result['user_type'] = $o->user_type;
		$result['last_login'] = $o->last_login;
		$result['my_profile_pic'] = $my_profile_pic;

		$o = $updater->update_object($o, "users");

		if ($user_type == 'Retailer' || $user_type == "Api User") {
			$o2->user_id = $result['user_id'];
			$o3->user_id = $result['user_id'];
			$sql_services = "Select service_id,service_name from services";
			$res_services = getXbyY($sql_services);
			$rows_services = count($res_services);
			if ($rows_services > 0) {
				for ($i = 0; $i < $rows_services; $i++) {
					$o2->service_id = $res_services[$i]['service_id'];
					$o2->service_name = $res_services[$i]['service_name'];
					$o2->status = 'No';
					$o2->is_active = '1';
					$o2->created_at = todaysDate();
					$o2->updated_at = todaysDate();
					$o2->user_service_id = $insertor->insert_object($o2, "user_services");
				}
			}
			$sql_p = "Select provider_id,provider from providers";
			$res_p = getXbyY($sql_p);
			$rows_p = count($res_p);
			if ($rows_p > 0) {
				for ($p = 0; $p < $rows_p; $p++) {
					$o3->provider_id = $res_p[$p]['provider_id'];
					$o3->provider_name = $res_p[$p]['provider'];
					$o3->amount_limit = '0';
					$o3->block_status = 'No';
					$o3->is_active = '1';
					$o3->created_date = todaysDate();
					$o3->updated_at = todaysDate();
					$o3->user_operator_block_id = $insertor->insert_object($o3, "user_operator_amount_block");
				}
			}
		}
		$result['error'] = "0";
		$result['error_msg'] = "Account Verified. Perfect! Taking you to Dashboard";
	} else {
		$result['error'] = "1";
		$result['error_msg'] = "Email & Mobile OTP mismatch";
	}
} else {
	$result['error'] = "1";
	$result['error_msg'] = "Please Enter Mobile & Email Otp.";
}

echo json_encode($result);
?>