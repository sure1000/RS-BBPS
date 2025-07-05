<?php

session_start();

include "include.php";
include "session.php";

if ($_POST['dth_updte'] == '1') {
	$o1 = new wallet;
	$o1->amount = $_POST['dth_amount'];
	$o1->total_amount =$_POST['dth_amount'];
	$total_amount =$_POST['dth_amount'];
	$o1->mobile_number = $_POST['dth_number'];
	$o1->provider_id = $_POST['dth_provider'];
	$o1->circle_name = " ";
	$o1->circle_id = "0";
	$service_id = "4";
	$userservice_check = check_userServices('DTH',$o);
 
 if($userservice_check['error'] == '1'){
    if($o->plan_id > 0){
        $commission_amount = get_commission($o,$o1);
        $o1->amount = $commission_amount['pay_amount'];
        $o1->commission_rt = $commission_amount['commission_amount'];
        }
	if ($o1->amount <= $o->amount_balance) {
		$api_id = select_api($o, $o1, $service_id, "0");

		//$o1 = wallet_insert($o, "0", "", $api_id, "Recharge", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Pending", "Web", $o1->circle_id, $o1->circle_name, $parent_id);
		$o1->api_id = $api_id;
		$o1->transaction_type = "Recharge";
		$o1->api_amount = $o1->amount;
		$o1->status = "Pending";

		$o1 = wallet_insert($o, $o1);
                 $o1->total_amount = $_POST['dth_amount'];

		$result = run_api($o1);
	
		if ($result['error'] == "0") {
                    $o1->api_number = $result['tnx_id'];
                    $o1->updated_at = todaysDate();
			if ($result['status'] == "Failed") {
				$o1->status = "Failed";
				$o1->api_response = $result['response'];
				$o1->wallet_id = $updater->update_object($o1, "wallet");

				//$o1 = wallet_insert($o, "0", "", $api_id, "Refund", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Success", "Web", $o1->circle_id, $o1->circle, $o1->wallet_id);
				$o1->transaction_type = "Refund";
				$o1->status = "Success";
				$o1->parent_id = $o1->wallet_id;
				$o1 = wallet_insert($o, $o1);
			} else {
				$o1->api_response = $result['response'];
				$o1->opid = $result['opid_id'];
				$o1->comment = $result['message'];
				if ($result['status'] == "Success") {
					$o1->status = "Success";
					$o1->wallet_id = $updater->update_object($o1, "wallet");

					$o1->status = "Success";
					$o1->parent_id = $o1->wallet_id;

					set_commission($o1, $o, "DTH");
				} else {
					$o1->wallet_id = $updater->update_object($o1, "wallet");
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
	}else{
	    $result['error'] = 1;
        $result['error_msg'] = "You are not authorized for DTH service";
 }
	
} else {
	$result['error'] = 1;
	$result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>
