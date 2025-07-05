<?php

session_start();
include "include.php";
$ajax_logout = 1;
include "session.php";

if ($_POST['updte'] > 0) {
    $o1->wallet_id = $_POST['wallet_id'];
    $status = $_POST['status'];
    $opid = $_POST['opid'];
    $o1 = $factory->get_object($o1->wallet_id, "wallet", "wallet_id");
    $o2 = $factory->get_object($o1->user_id, "users", "user_id");
    $o3 = $factory->get_object($o1->wallet_id, "wallet", "parent_id");
    $o1->updated_at = todaysDate();
    if ($status == "Success") {
        if ($o1->status == "Failed") {
            $o1->status = "Success";
            $o1 = wallet_insert($o2, $o1);
            $o1->parent_id = $o1->wallet_id;
            set_commission($o1, $o2, $o1->provider_type);
              $result['error'] = 0;
            $result['error_msg'] = "Status  Updated Successfully :" . $status;
        } else {
            $result['error'] = 1;
            $result['error_msg'] = "Status Already Update :" . $status;
        }
    } else if ($status == "Failed") {
		//pt($o1);
        if ($o1->status == "Success") {
            $o1->status = "Failed";
            $o1->comment = $o1->comment . " - Manual " . $status;
           
           $o1->wallet_id = $updater->update_object($o1, "wallet");
            $o1->api_comm = '-'.$o1->api_comm;
            $o1->transaction_type = "Refund";
            $o1->status = "Success";
            $o1->total_commission = $o1->total_commission;
                $o1->commission_rt = $o1->commission_rt;
            $o1->parent_id = $o1->wallet_id;
            $o1->amount  = $o1->amount;
            $o1->api_amount  = $o1->api_amount - $o3->api_amount;
			//echo '<pre>';print_r($o1);
           $o1 = wallet_insert($o2, $o1);
			//die;
			//distributor
			//echo '<pre>'; print_r($o1);
			$wallet_id = $_POST['wallet_id'];
			$parent_id = $o1->parent_user_id;
			$o2 = $factory->get_object($parent_id, "users", "user_id");
			$sql = "Select amount,commission_earned from wallet where parent_id = ".$wallet_id." AND user_id='".$parent_id."' LIMIT 1";
			$res = getXbyY($sql);
			$amount = $res[0]['amount'];
			
			if($o2->parent_id){
			$o1->amount = $amount;
			$o1->commission_rt = 0;
			$o1->total_commission = 0;
			$o1->transaction_type = "Reverse";
			$o1->commission_earned = $res[0]['commission_earned'];
			$o1 = wallet_insert($o2, $o1);
			}
			/* pt($o1);
			pt($o2);
			die; */
			//master distributor
			$parent_id = $o1->parent_user_id;
			if($o2->parent_id){
			$o2 = $factory->get_object($parent_id, "users", "user_id");
			$sql = "Select amount,commission_earned  from wallet where parent_id = ".$wallet_id." AND user_id='".$parent_id."' LIMIT 1";
			$res = getXbyY($sql);
			$amount = $res[0]['amount'];
			
			$o1->amount = $amount;
			$o1->commission_rt = 0;
			$o1->total_commission = 0;
			$o1->transaction_type = "Reverse";
			$o1->commission_earned = $res[0]['commission_earned'];
			$o1 = wallet_insert($o2, $o1);	
			}
			//die;
            $result['error'] = 0;
            $result['error_msg'] = "Status  Updated Successfully :" . $status;
        } else {
            $result['error'] = 1;
            $result['error_msg'] = "Status Already Update :" . $o1->status;
        }
    } else {
        $result['error'] = 1;
        $result['error_msg'] = "Invailed Status";
    }

} else {
    $result['error'] = 1;
    $result['error_msg'] = "Something went wrong. Please try again";
}

echo json_encode($result);
?>