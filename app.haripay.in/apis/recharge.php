<?php
include "include.php";
    $o->user_id = $_POST['user_id'];
    $o = $factory->get_object($o->user_id, "users", "user_id");

    if ($o->is_active == "1") {
	
    $o1 = new wallet;
	$o12 = new stdClass();
    $o1->amount = $_POST['amount'];
    $o1->total_amount =$_POST['amount'];
    $o1->mobile_number = $_POST['number'];
    $o1->provider_id = $_POST['provider'];
    $o1->circle_name = $_POST['circle'];
    $pin = $_POST['pin'];
    $o1->circle_id = "0";
	
    if ($o->plan_id > 0) {
       $commission_amount = get_commission($o, $o1);
		// $commission_amount = get_recharge_commission($o, $o1);
        $o1->amount = $commission_amount['pay_amount'];
        $o1->commission_rt = $commission_amount['commission_amount'];
    }
$service_id = "1";
    $stv = $_POST['special'];

    if ($stv == "Special") {
        if ($o1->provider_id == '2') {
            $o1->provider_id = '2';
           
        }
    }
 $userservice_check = check_userServices('Prepaid',$o);

 if($userservice_check['error'] == '1'){
	 
 if($o->kyc_id == $pin && $pin!=''){
	 
 if ($o1->amount <= $o->amount_balance) {
        if ($o->white_label_id > '0')
        {
          // die("khjghgx");
          $user_id= $o->white_label_id;
          $api_id = select_whitelabel_api($user_id);
        }
        else
        {
        $api_id = select_api($o, $o1, $service_id, "0");
      }
$api_id = select_api($o, $o1, $service_id, "0");
/* pt($_SESSION);
pt($api_id);die; */
        $sql_circle = "Select circle_code from api_circle_code where api_id = '" . $api_id . "' and circle_name = '" . $o1->circle_name . "' and is_active = '1'";
        $res_circle = getXbyY($sql_circle);
        $row_circle = count($res_circle);
        if ($row_circle > 0) {
            $o1->circle_id = $res_circle[0]['circle_code'];
        }

        $o1->api_id = $api_id;
        $o1->api_amount = $o1->amount;
        $o1->transaction_type = "Recharge";
        $o1->recharge_path = "APP";
        $o1->white_label_user_id = $o->white_label_id;
        //$o1 = wallet_insert($o, "0", "", $api_id, "Recharge", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Pending", "Web", $o1->circle_id, $o1->circle_name, $parent_id);
        $o1 = wallet_insert($o, $o1);
        // $o1->total_amount = $_POST['prepaid_amount'];
        $total_amount = $o1->total_amount;

		//echo $api_id;
        $result = run_api($o1);
		//pt($result);
        if ($result['error'] == "0") {
            $o1->api_number = $result['tnx_id'];
            $o1->comment = $result['message'];
            $o1->updated_at = todaysDate();
            if ($result['status'] == "Failed") {
                $o1->status = "Failed";
                $o1->api_response = $result['response'];
                  $o1->total_commission = 0;
                $o1->commission_rt = 0;
                $o1->comment = $o1->comment . " - " . todaysDate();
				//pt($o);
				//pt($o1);
				
                $o1->wallet_id = $updater->update_object($o1, "wallet");
              //  '-'.$o1->api_comm;
//echo "<pre>"; print_r($o1);exit;
                $o1->transaction_type = "Refund";
                $o1->status = "Success";
                $o1->total_commission = 0;
                $o1->commission_rt = 0;
                $o1->white_label_user_id = $o->white_label_id;
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
                    //recharge_commission($o1, $o, "Prepaid");
                    set_commission($o1, $o, "Prepaid");
                } else {
                    $result['error'] = 1;
                    $result['error_msg'] = "Recharge Failed. Please Try Again";
                    $o1->status = "Failed";

                    $o1->api_response = "Recharge Failed. No Response From Api";
                    $o1->wallet_id = $updater->update_object($o1, "wallet");
//echo '<pre>'; print_r($o1);
                    //$o1 = wallet_insert($o, "0", "", $api_id, "Refund", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Success", "Web", $o1->circle_id, $o1->circle, $o1->wallet_id);
                    $o1->transaction_type = "Refund";
                    $o1->status = "Success";
                    $o1->white_label_user_id = $o->white_label_id;
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
            $o1->white_label_user_id = $o->white_label_id;
            $o1->parent_id = $o1->wallet_id;
            $o1 = wallet_insert($o, $o1);

            //$o1 = wallet_insert($o, "0", "", $api_id, "Refund", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Success", "Web", $o1->circle_id, $o1->circle, $o1->wallet_id);
        }

        include "recharge_response.php";
    } else {
        $result['error'] = 1;
        $result['error_msg'] = "Sorry, Your Wallet Balance is less than Required Amount";
    }
	
	}else{
	    $result['error'] = 1;
         $result['error_msg'] = "Your pin is not valid";
	}
	
	}else{
	    $result['error'] = 1;
        $result['error_msg'] = "You are not authorized for prepaid service";
	}
} else {
    $result['error'] = 1;
    $result['error_msg'] = "Something went wrong please try again";
}
//echo '<pre>'; print_r($o1); die;
echo json_encode($result);
?>


