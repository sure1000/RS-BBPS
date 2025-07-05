<?php

session_start();

include "include.php";
include "session.php";

if ($_POST['dth_activation_updte'] == '1') {
	$o1 = new wallet;
	$o1->amount = $_POST['dth_activation_amount'];
	$o1->mobile_number = $_POST['dth_activation_mobile'];
	$o1->provider_id = $_POST['dth_activation_provider'];
	//$o1->circle_name = " ";
	//$o1->circle_id = "0";
	$service_id = "5";
	

	if ($o1->amount <= $o->amount_balance) {
		$api_id = select_api($o, $o1, $service_id, "0");

		$sql_circle = "Select circle_code from api_circle_code where api_id = '" . $api_id . "' and circle_name = '" . $o1->circle_name . "' and is_active = '1'";
		$res_circle = getXbyY($sql_circle);
		$row_circle = count($res_circle);
		if ($row_circle > 0) {
			$o1->circle_id = $res_circle[0]['circle_code'];
		}

		$o1->api_id = $api_id;
		$o1->api_amount = $o1->amount;

		$o1->transaction_type = "Recharge";
	

		//$o1 = wallet_insert($o, "0", "", $api_id, "Recharge", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Pending", "Web", $o1->circle_id, $o1->circle_name, $parent_id);
		$o1 = wallet_insert($o, $o1);
	
		$result = run_api($o1);

		if ($result['error'] == "0") {
			$o1->api_number = $result['tnx_id'];
			$o1->updated_at = todaysDate();
			if ($result['status'] == "Failed") {
				$o1->status = "Failed";
				$o1->api_response = $result['response'];
				$o1->comment = $o1->comment . " - " . todaysDate();
				$o1->wallet_id = $updater->update_object($o1, "wallet");

				//$o1 = wallet_insert($o, "0", "", $api_id, "Refund", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Success", "Web", $o1->circle_id, $o1->circle, $o1->wallet_id);

				$o1->transaction_type = "Refund";
				$o1->status = "Success";
				$o1->parent_id = $o1->wallet_id;
				$o1 = wallet_insert($o, $o1);
			} else {
				$o1->api_response = $result['response'];
				$o1->opid = $result['opid_id'];
				$o1->comment = $result['message'] . " - " . todaysDate();
				if ($result['status'] == "Pending") {
					$o1 = $factory->get_object($o1->wallet_id, "wallet", "wallet_id");
					$o1->api_response = $result['response'];
					$o1->opid = $result['opid_id'];
					$o1->comment = $result['message'] . " - " . todaysDate();
					$o1->api_number = $result['tnx_id'];
					$o1->updated_at = todaysDate();
					if ($o1->status == "Pending") {
						$o1->wallet_id = $updater->update_object($o1, "wallet");
					}

				} else if ($result['status'] == "Success") {
					$o1->status = "Success";
					$o1->wallet_id = $updater->update_object($o1, "wallet");
					$o1->parent_id = $o1->wallet_id;
					set_commission($o1, $o, "dth_activation");
				} else {
					$result['error'] = 1;
					$result['error_msg'] = "Recharge Failed. Please Try Again";
					$o1->status = "Failed";
					$o1->api_response = "Recharge Failed. No Response From Api";
					$o1->wallet_id = $updater->update_object($o1, "wallet");

					//$o1 = wallet_insert($o, "0", "", $api_id, "Refund", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Success", "Web", $o1->circle_id, $o1->circle, $o1->wallet_id);
					$o1->transaction_type = "Refund";
					$o1->status = "Success";
					$o1->parent_id = $o1->wallet_id;
					$o1 = wallet_insert($o, $o1);
				}
			}
		} else {
			$result['error'] = 1;
			$result['error_msg'] = "Recharge Failed. Please Try Again";
			$o1->status = "Failed";
			$o1->api_response = "Recharge Failed. No Response From Api";
			$o1->wallet_id = $updater->update_object($o1, "wallet");

			$o1->transaction_type = "Refund";
			$o1->status = "Success";
			$o1->parent_id = $o1->wallet_id;
			$o1 = wallet_insert($o, $o1);

			//$o1 = wallet_insert($o, "0", "", $api_id, "Refund", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Success", "Web", $o1->circle_id, $o1->circle, $o1->wallet_id);
		}

		include "recharge_response.php";
	} else {
		$result['error'] = 1;
		$result['error_msg'] = "Sorry, Your Wallet Balance is less than Required Amount";
	}
} else {
	$result['error'] = 1;
	$result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*if ($o1->amount <= $o->amount_balance) {
		$api_id = select_api($o, $o1, $service_id, "0");
		
		$o1 = wallet_insert($o, "0", "", $api_id, "Recharge", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Pending", "Web", $o1->circle_id, $o1->circle_name, $parent_id);
		$o1->api_id = $api_id;
		$o1->transaction_type = "Recharge";
		$o1->api_amount = $o1->amount;
		$o1->status = "Pending";

		$o1 = dth_activation_insert($o, $o1);
		$result = run_api($o1);
		if ($result['error'] == "0") {
			if ($result['status'] == "Failed") {
				$o1->status = "Failed";
				$o1->api_response = $result['response'];
				$o1->dth_activation_id = $updater->update_object($o1, "dth_activation");

				//$o1 = wallet_insert($o, "0", "", $api_id, "Refund", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Success", "Web", $o1->circle_id, $o1->circle, $o1->wallet_id);
				$o1->transaction_type = "Refund";
				$o1->status = "Success";
				$o1->parent_id = $o1->dth_activation_id;
				$o1 = dth_activation_insert($o, $o1);
			} else {
				$o1->api_response = $result['response'];
				$o1->opid = $result['opid_id'];
				$o1->comment = $result['message'];
				if ($result['status'] == "Success") {
					$o1->status = "Success";
					$o1->dth_activation_id = $updater->update_object($o1, "dth_activation");

					$o1->status = "Success";
					$o1->parent_id = $o1->dth_activation_id;

					set_commission($o1, $o, "DTH Activation");
				} else {
					$o1->dth_activation_id = $updater->update_object($o1, "dth_activation");
				}
			}
		} else {
			$result['error'] = 1;
		}

		include "recharge_response.php";
	} else {
		$result['error'] = 1;
		$result['error_msg'] = "Sorry, Your Wallet Balance is less than Required Amount";
	}
} else {
	$result['error'] = 1;
	$result['error_msg'] = "Something went wrong please try again";
}
echo json_encode($result); */
?>
