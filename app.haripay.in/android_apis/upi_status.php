<?php
include 'include.php';
    $_date_time = todaysDate();
    $sql_log = "INSERT INTO `upi_logs` (`user_id`, `ref_number`, `request`, `response`, `status`, `insert_date`) VALUES ('" . $o->user_id . "', '" . $_POST['ref_number'] . "', '" . $_POST['request'] . "', '" . $_POST['json_data'] . "', '" . $_POST['status'] . "', '" . $_date_time . "');";
    $r = setXbyY($sql_log);
    ///
    $sql_upi_log = "Select * from upi_logs where ref_number = '" . $_POST['ref_number'] . "'";
    $res_upi_log = getXbyY($sql_upi_log);
    $row_upi_log = count($res_upi_log);
    if($row_upi_log){
        //$my_array_data = json_decode($res_upi_log[0]['response'], TRUE);
        $RequestStatus = $res_upi_log[0]['status'];
        $ClientId = $_POST['ref_number'];
    }
    //pt($ClientId);die;
if ($ClientId != "") {
	$sql = "Select request_money_id, status, amount from request_money where status = 'Pending' and transaction_number = '" . $ClientId . "'";
    $res = getXbyY($sql);
    $row = count($res);

    
    if ($row == 1) {
        $o1 = $factory->get_object($res[0]['request_money_id'], "request_money", "request_money_id");
        if ($RequestStatus == 'SUCCESS' ||$RequestStatus == 'Success') {
            $status = 'Success';
        } else if ($RequestStatus == "USER_CANCELLED" ||$RequestStatus == "FAILURE" ||$RequestStatus == "Failed") {
            $status = 'Failed';
        }else{
           echo "Transaction  Pending Wait 24 Hours"; 
        }
        
			$o1->decision_date = todaysDate();
			
			//pt($o1);die;
        if ($status == "Success") {
            $o1->status = "Transferred";
			$o1->decision = "Transferred Done";
            $o1->request_money_id = $updater->update_object($o1, "request_money");
			/////add money
			$o = $factory->get_object($o1->user_id, "users", "user_id");
			
			$senders_name = "UPI Gateway";
			$recived_by = $o->user_name;
            if ($o->user_id > 0) {
                $o2 = new wallet;
                $o2->user_1_id = $o->user_id;
                $o2->user_1_name = $senders_name;
                $o2->transaction_type = "Recieve Money";
                $o2->cash_credit = "Credit";
                $o2->total_amount = $res[0]['amount'];
                $o2->amount = $res[0]['amount'];
                $o2->ref_number = $res[0]['ref_number'];
                $o2->order_id = $ClientId;
                $o2->status = "Success";
                $o2->recharge_path = "App";
                $o2->send_type = "Admin";
                $o2 = wallet_insert($o, $o2);
				
            }
            $email_from = $res_site[0]['email'];
            $email_to = $o1->email;
            $email_subject = $res_site[0]['site_name'] . " has Sent " . $o2->amount . " to your wallet";

            $email_message = "<html><head><title>Wallet update for " . $res_site[0]['site_name'] . "</title></head><body style='font-family: Arial, Helvetica, sans-serif;'>
			<table style='border:1px solid #ccc;border-radius:8px;' cellpadding='8'>
			<tr><td><img src='" . $res_site[0]['site_url'] . "/img/" . $res_site[0]['logo'] . "' width='256' /></td></tr>
			<tr><td style>Greetings " . $o1->name . "</td></tr>
			<tr><td>Your " . $res_site[0]['site_name'] . " wallet has been updated. The details for the same are as following:</td></tr>
			<tr><td><b>Old Amount: INR. " . $o2->user_old_balance . "</td></tr>
			<tr><td><b>Amount Sent: INR. " . $o2->amount . "</td></tr>
			<tr><td><b>New Amount: INR. " . $o2->user_new_balance . "</td></tr>
			
			<tr><td>The same will reflect in your wallet on " . $res[$i]['site_name'] . ". Incase, it is not showing, please logout and login again</td></tr>
			<tr><td>Thanking you</td></tr>
			<tr><td>Admin - " . $res_site[0]['site_name'] . "</td></tr>
			<tr><td>Email: " . $res_site[0]['email'] . "</td></tr>
			<tr><td>Phone: " . $res_site[0]['mobile'] . "</td></tr></table></body></html>";
            sendmail($email_from, $email_to, $email_subject, $email_message);
            $message = "Your wallet have been Credited with Rs. " . $o2->amount . " by UPI Gateway Your new  balance is Rs. " . $o2->user_new_balance;
            sendsms_payzoom($o1->mobile, $message);
            $result['error'] = '1';
            echo "Amount Successfully Credited";
			} else if ($status == "Failed") {
			  
			$o1->decision = "Failed";
            $o1->status = "Rejected";
            $o1->request_money_id = $updater->update_object($o1, "request_money");
  echo "Transaction  Failed";
        }
    }
}
?>
