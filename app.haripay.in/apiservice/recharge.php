<?php
include "include.php";
$result['error'] = 1;
$result['error_msg'] = "Invalid Parameters";
$result['ip'] = $_SERVER['REMOTE_ADDR'];
if (isset($_GET['uname'])) {
	$uname = $_GET['uname'];
} else {
   echo '{"Please Pass uname Parameter"},';
	
}

if (isset($_GET['api_token'])) {
	$api_token = $_GET['api_token'];
} else {
	echo '{"Please Pass api_token Parameter"},';
}

if (isset($_GET['operator'])) {
	$operator = $_GET['operator'];
} else {
	echo '{"Please Pass operator Parameter"},';
}

if (isset($_GET['circle'])) {
	$circle = $_GET['circle'];
} else {
echo '{"Please Pass circle Parameter"},';
}

if (isset($_GET['number'])) {
	$number = $_GET['number'];
} else {
	echo '{"Please Pass number Parameter"},';
}

if (isset($_GET['amount'])) {
	$amount = $_GET['amount'];
} else {
	echo '{"Please Pass amount Parameter"},';
}

if (isset($_GET['reqid'])) {
	$reqid = $_GET['reqid'];
} else {
	echo '{"Please Pass reqid Parameter"},';
}

if ($uname == "") {
    echo '{"The uname field is required"},';
}

if ($api_token == "") {
	echo '{"The api_token field is required"},';
}

if ($operator == "") {
	echo '{"The operator field is required"},';
}

if ($amount == "") {
	echo '{"The amount field is required"},';
}

if ($reqid == "") {
	echo '{"The reqid field is required"},';
}

 $ip_address = $_SERVER['REMOTE_ADDR'];

$sql_user = "Select user_id from users where user_name = '" . $uname . "' and is_active = 1";
//echo $sql_user;
$res_user = getXbyY($sql_user);
$row_users = count($res_user);
//echo $sql_user;
if ($row_users == 1) {
	$o = $factory->get_object($res_user[0]['user_id'], "users", "user_id");

	$sql_auth = "Select * from api_ip_key where user_id = " . $o->user_id . " and ip_address = '" . $ip_address . "' and authorization_key = '" . $api_token . "' and is_active = 1";
	$res_auth = getXbyY($sql_auth);
	$row_auth = count($res_auth);
//echo $sql_auth;
	if ($row_auth == 1) {
		if ($amount <= $o->amount_balance) {
			$sql_ref = "Select wallet_id from wallet where api_ref_number = '" . $reqid . "' and user_id = '" . $o->user_id . "'";
			$res_ref = getXbyY($sql_ref);
			$row_ref = count($res_ref);
			//pt($o1);
            
			if ($row_ref > 0) {
				$result['error_msg'] = "reqid: " . $reqid . " is already used";
				echo json_encode($result);
				die();
			}

			if ($operator > 0) {
				$o2 = $factory->get_object($operator, "providers", "provider_id");
				
				if ($o2->is_active == 1) {
				    $o1 = new wallet;
					//$api_id = select_api($o, $o1, $o2->service_id, "0");
				//pt($api_id);  die;
                    if ($o->plan_id > 0) {
                    $commission_amount = api_get_commission($o, $amount, $operator);
                    $amount1 = $commission_amount['pay_amount'];
                    $commission = $commission_amount['commission_amount'];
                    //pt($commission_amount);  die;
                    }
					$o1->transaction_type = "Recharge";
					$o1->amount = $amount1;
					$o1->total_amount = $amount;
					$o1->commission_rt = $commission;
					$o1->api_ref_number = $_GET['reqid'];
					$o1->mobile_number = $number;
					$o1->provider_id = $o2->provider_id;
					$o1->circle_id = $circle;
					$o1->service_id = $o2->service_id;
					$o1->provider_type = $o2->service;

					$api_id = select_api($o, $o1, $o2->service_id, "0");

					$sql_circle = "Select circle_code, circle_name from api_circle_code where api_id = '" . $api_id . "' and service_circle_id = '" . $circle . "' and is_active = '1'";
					$res_circle = getXbyY($sql_circle);
					$row_circle = count($res_circle);
					if ($row_circle > 0) {
						$circle_code = $res_circle[0]['circle_code'];
					} else {
						$circle_id = "";
					}

					$o1->circle_name = $res_circle[0]['circle_name'];
					$o1->api_id = $api_id;
					$o1->api_amount = $amount;

					$o1->recharge_path = "Api";
					$o1->ref_number = $o1->ref_number;

					$o1 = wallet_insert($o, $o1);

					$result1 = run_api($o1);

					unset($result['error']);
					unset($result['error_msg']);
					$result['reqid'] = $o1->api_ref_number;
					$result['amount'] = $amount;
                    $result['ref_number'] = $o1->ref_number;
					if ($result1['error'] == "0") {
					    
						$o1->api_number = $result1['tnx_id'];
						if ($result1['status'] == "Failed") {
							sleep(1);
							$o1->status = "Failed";
							$o1->api_response = $result1['response'];
							$o1->wallet_id = $updater->update_object($o1, "wallet");

							$o1->transaction_type = "Refund";
							$o1->status = "Success";
							$o1->parent_id = $o1->wallet_id;
							$o1->status_checker = "5";
							$o1 = wallet_insert($o, $o1);

							$result['status'] = "Failed";
							$result['commission'] = 0;
							$result['opid'] = $o1->opid;
                            $result['ref_number'] = $o1->ref_number;
							$result['reqid'] = $o1->api_ref_number;
						} else {
							$o1->api_response = $result1['response'];
							$o1->opid = $result1['opid_id'];
							$o1->comment = $result1['message'];
							if ($result1['status'] == "Pending") {
								$o1->wallet_id = $updater->update_object($o1, "wallet");

								$result['commission'] = 0;
								$result['status'] = "Pending";
								$result['opid'] = $o1->opid;
								$result['ref_number'] = $o1->ref_number;
								$result['reqid'] = $o1->api_ref_number;
							} else if ($result1['status'] == "Success") {
								$o1->status = "Success";
								$o1->wallet_id = $updater->update_object($o1, "wallet");
								$o1->parent_id = $o1->wallet_id;
								set_commission($o1, $o, "Prepaid");

								$sql_comm = "Select amount from wallet where parent_id = " . $o1->parent_id;
								$res_comm = getXbyY($sql_comm);

								$result['commission'] = $res_comm[0]['amount'];
								$result['status'] = "Success";
								$result['opid'] = $o1->opid;
								$result['ref_number'] = $o1->ref_number;
								$result['reqid'] = $o1->api_ref_number;
								
							} else {
							    sleep(1);
								$result['error'] = 1;
								$result['error_msg'] = "Recharge Failed. Please Try Again";
								$o1->status = "Failed";
								$o1->api_response = "Recharge Failed. No Response From Api";
								$o1->wallet_id = $updater->update_object($o1, "wallet");

								//$o1 = wallet_insert($o, "0", "", $api_id, "Refund", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Success", "Web", $o1->circle_id, $o1->circle, $o1->wallet_id);
								$o1->transaction_type = "Refund";
								$o1->status = "Success";
								$o1->parent_id = $o1->wallet_id;
								 $o1->status_checker = "3";
								$o1 = wallet_insert($o, $o1);

								$result['commission'] = 0;
								$result['status'] = "Failed";
								$result['opid'] = $o1->opid;
								$result['ref_number'] = $o1->ref_number;
								$result['reqid'] = $o1->api_ref_number;
							}
						}
					} else {
					    sleep(1);
						$result['error'] = 1;
						$result['error_msg'] = "Recharge Failed. Please Try Again";
						$o1->status = "Failed";
						$o1->api_response = "Recharge Failed. No Response From Api";
						$o1->wallet_id = $updater->update_object($o1, "wallet");

						$o1->transaction_type = "Refund";
						$o1->status = "Success";
						$o1->parent_id = $o1->wallet_id;
						 $o1->status_checker = "2";
						$o1 = wallet_insert($o, $o1);

						$result['commission'] = 0;
						$result['status'] = "Failed";
						$result['opid'] = $o1->opid;
                        $result['ref_number'] = $o1->ref_number;
						//$o1 = wallet_insert($o, "0", "", $api_id, "Refund", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Success", "Web", $o1->circle_id, $o1->circle, $o1->wallet_id);
					}

				} else {
					$result['error_msg'] = "Please Check Operator Code";
					echo json_encode($result);
					die();
				}
			} else {
				$result['error_msg'] = "Please Check Operator Code";
				echo json_encode($result);
				die();
			}

		} else {
			$result['error_msg'] = "You donot have enough balance";
			echo json_encode($result);
			die();
		}

	} else {
		echo json_encode($result);
		die();
	}

} else {
	echo json_encode($result);
	die();
}

echo json_encode($result);
?>