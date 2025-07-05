<?php
session_start();
include "include.php";
include "session.php";

if ($_POST['updte'] == 1) {
  
	 $wallet_id = $_POST['wallet_id'];
	 $status = $_POST['status'];
	 $remark = $_POST['dispute_resolution'];
	if($wallet_id > 0){
        $o1 = $factory->get_object($wallet_id, "wallet", "wallet_id");
        $o2 = $factory->get_object($wallet_id, "disputes", "wallet_id");
        $o3 = $factory->get_object($o1->user_id, "users", "user_id");
    if($o1->status == "Success"){

        $o2->dispute_resolution = $remark ;
        $o2->resolution_date = todaysDate();
        $o2->is_active = '1';
        $o2->dispute_id = $updater->update_object($o2,"disputes");
        if($status == "Approve"){
 
                $o1->status = "Failed";
				$o1->updated_at = todaysDate();
				$o1->disputed = "Resolved";
				$o1->wallet_id = $updater->update_object($o1, "wallet");

				$notification = "Dispute Resolved";
		        insert_notifications($res_pending[$i]['user_id'],$notification);

				
				$o1->transaction_type = "Refund";
				$o1->status = "Success";
				$o1->parent_id = $o1->wallet_id;
				$o1 = wallet_insert($o3, $o1);

				$result['error'] = "0";
				$result['error_msg'] = "Successfully Approved";


        }else if($status == "Reject"){

				$o1->updated_at = todaysDate();
				$o1->disputed = "Rejected";
				$o1->wallet_id = $updater->update_object($o1, "wallet");
				$result['error'] = "0";
				$result['error_msg'] = "Unfortunately Rejected";
        		}else{
        		$result['error'] = 1;
				$result['error_msg'] = "Something went wrong. Please try again";
       			 }
    }else{
    	$result['error'] = 1;
		$result['error_msg'] = "Status Already Update. Please Reload the Page";
         }
    }else{
	 	$result['error'] = 1;
	    $result['error_msg'] = "Something went wrong. Please try again";
	}
	
} else {
	$result['error'] = 1;
	$result['error_msg'] = "Something went wrong. Please try again";
     }
echo json_encode($result);

?>