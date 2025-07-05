<?php

session_start();
include "include.php";
$ajax_logout = 1;
include "session.php";

if ($_POST['updte'] > 0) {
    $o1->wallet_id = $_POST['wallet_id'];
    $api_id = $_POST['api_id'];
     if($api_id > 0){

    $o1 = $factory->get_object($o1->wallet_id, "wallet", "wallet_id");
    $o2 = $factory->get_object($o1->user_id, "users", "user_id");
    $o1->ref_number = reference_number();
    if ($o1->status == "Failed") {
        
        //$service_id = get_service_id($o1->provider_type);
	

	if ($o1->amount <= $o2->amount_balance) {
		
		 $o1->opid = "Retry";
		 $o1->wallet_id = $updater->update_object($o1, "wallet");
		$sql_circle = "Select circle_code from api_circle_code where api_id = '" . $api_id . "' and circle_name = '" . $o1->circle_name . "' and is_active = '1'";
		$res_circle = getXbyY($sql_circle);
		$row_circle = count($res_circle);
		if ($row_circle > 0) {
			$o1->circle_id = $res_circle[0]['circle_code'];
		}
                $o1->api_id = $api_id;
                 $o1->opid = "0";
		$o1 = wallet_insert($o2, $o1);

		$result = run_api($o1);
                if ($result['error'] == "0") {
			$o1->api_number = $result['tnx_id'];
			$o1->updated_at = todaysDate();
			if ($result['status'] == "Failed") {
				$o1->status = "Failed";
				$o1->api_response = $result['response'];
                                $o1->comment = $o1->comment . " - Retry From Admin ";
				$o1->wallet_id = $updater->update_object($o1, "wallet");
                                $o1->transaction_type = "Refund";
				$o1->status = "Success";
				$o1->parent_id = $o1->wallet_id;
				$o1 = wallet_insert($o2, $o1);
			} else {
				$o1->api_response = $result['response'];
				$o1->opid = $result['opid_id'];
				$o1->comment = $result['message'] . " - " . todaysDate();
				if ($result['status'] == "Pending") {
					$o1 = $factory->get_object($o1->wallet_id, "wallet", "wallet_id");
                                        $o1->api_response = $result['response'];
				        $o1->opid = $result['opid_id'];
				        $o1->comment = $result['message'] . " - Retry From Admin ";
                                        $o1->api_number = $result['tnx_id'];
			                $o1->updated_at = todaysDate();
					if ($o1->status == "Pending") {
				        $o1->wallet_id = $updater->update_object($o1, "wallet");
					}

				} else if ($result['status'] == "Success") {
					$o1->status = "Success";
					$o1->wallet_id = $updater->update_object($o1, "wallet");
					$o1->parent_id = $o1->wallet_id;
					set_commission($o1, $o2, $o1->provider_type);
				} else {
					$result['error'] = "1";
					$result['error_msg'] = "Recharge Failed. Please Try Again";
					$o1->status = "Failed";
					$o1->api_response = "Recharge Failed. No Response From Api";
					$o1->wallet_id = $updater->update_object($o1, "wallet");

					//$o1 = wallet_insert($o, "0", "", $api_id, "Refund", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Success", "Web", $o1->circle_id, $o1->circle, $o1->wallet_id);
					$o1->transaction_type = "Refund";
					$o1->status = "Success";
					$o1->parent_id = $o1->wallet_id;
					$o1 = wallet_insert($o2, $o1);
				}
                                
			}
                        if($result['error'] == "0"){
                            $result['error'] = "0";
                            $result['error_msg'] = "Recharge ". $result['status'];
                            $result['opid_id'] =$result['opid_id'] ;
                            $result['status'] =$result['status'] ;
                        }
		} else {
			$result['error'] = "1";
			$result['error_msg'] = "Recharge Failed. Please Try Again";
			$o1->status = "Failed";
			$o1->api_response = "Recharge Failed. No Response From Api";
			$o1->wallet_id = $updater->update_object($o1, "wallet");

			$o1->transaction_type = "Refund";
			$o1->status = "Success";
			$o1->parent_id = $o1->wallet_id;
			$o1 = wallet_insert($o2, $o1);

		}

		//include "recharge_response.php";
	} else {
		$result['error'] = "1";
		$result['error_msg'] = "Sorry,  Wallet Balance is less than Required Amount";
	}
         
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "Status Already Update :" . $o1->status;
    }
     }else{
          $result['error'] = "1";
            $result['error_msg'] = "Please select api.";
     }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong. Please try again";
}

echo json_encode($result);
?>