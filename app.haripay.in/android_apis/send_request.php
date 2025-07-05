<?php

include "include.php";
if ($o->user_id > 0) {
    $o1->user_id = $o->user_id;
    $o1->amount = $_POST['request_money'];
    $o1->cash_credit = $_POST['cash_credit'];
    $o1->request_date = todaysDate();
    $o1->status = "Pending";
    $o1->ref_number = reference_number();
    $o1->transfer_mode = $_POST['transfer_mode'];
    $o1->transaction_number = $_POST['transaction_number'];
    $o1->is_active = 1;
    $o1->request_to=$_POST['request_user'];
    $old_amount = $o->amount_balance;
    $old_credit = $o->credit_amount;

    // if($o->parent_id > 0){
    //     $o7 =$factory->get_object($o->parent_id,"users","user_id");
    //     $sql_dfs ="Select user_id from users where parent_id ='".$o7->user_id."' and user_type = 'DSE'";
    //     $res_dfs =getXbyY( $sql_dfs);
    //     $row_dfs=count($res_dfs);
    // }
        

  if ($o1->cash_credit == "Credit") {
        $pending_limit = $o->credit_limit - $o->credit_amount;

        if ($o1->amount > $pending_limit) {
            $result['error'] = 1;
            $result['error_msg'] = "Credit Amount is Greater than your Pending Limit. Maximum Credit Available is Rs. " . $pending_limit;
        } else {
            $o3 = $factory->get_object("1", "users", "user_id");
            $user_1_name = $o3->user_name . " " . $o3->name;
                        
                        $o2 = new wallet;
                        $o2->user_1_id = 1;
                        $o2->user_1_name = $user_1_name;
                        $o2->transaction_type = "Recieve Money";
                        $o2->cash_credit = "Credit";
                        $o2->amount = $o1->amount;
                        $o2->status = "Success";
            
                        //$o2 = wallet_insert($o, "1", $user_1_name, "0", "Recieve Money", "Credit", "0", $o1->amount, "0", "", "Success", "Web", "0", "", "0");
                        $o2 = wallet_insert($o, $o2);

            $notification = "Credit Amount Rs. " . $o1->amount . " out of Rs. " . $pending_limit . " is used by " . $o->name;
                       // $sql="select * From users where user_id = '".$o1->user_id."' and is_active = 1";
                        //$res=getXbyY('$sql');
                       // $row=count($res);
                        
            insert_notifications("1", $notification);

            $email_to = $res_site[0]['email'];
            $email_from = $o->email;
            $email_subject = $notification;
            //$email_message = "Verification Code : ".$o->new_password;
            /*$email_message = "<html><head><title>" . $notification . "</title></head><body style='font-family: Arial, Helvetica, sans-serif;'>
                <table style='border:1px solid #ccc;border-radius:8px;' cellpadding='8'>
                <tr><td><img src='" . $res_site[0]['site_url'] . "/img/logo.png' width='256' /></td></tr>
                <tr><td style>Greetings Admin</td></tr>
                <tr><td>" . $o->name . " (" . $o->user_name . ") has used the Credit Limit. Details of the same are as follows</td></tr>
                <tr><td>Old Amount: Rs. " . $old_amount . "</td></tr>
                <tr><td>Old Credit Amount: Rs. " . $old_credit . "</td></tr>
                <tr><td>Amount: Rs. " . $o1->amount . "</td></tr>
                <tr><td>New Amount: Rs. " . ($old_amount + $o1->amount) . "</td></tr>
                <tr><td>New Credit Amount: Rs. " . ($old_credit + $o1->amount) . "</td></tr>
                <tr><td>Pending Limit: Rs. " . ($o->credit_limit - $o->credit_amount) . "</td></tr>

                <tr><td>Thanking you</td></tr>
                <tr><td>Admin - " . $res_site[0]['site_name'] . "</td></tr>
                <tr><td>Email: " . $res_site[0]['email'] . "</td></tr>
*/

            include "mails/send_request_credit.php";

            sendmail($email_from, $email_to, $email_subject, $email_message);

            $result['amount_balance'] = $old_amount + $o1->amount;
            $result['credit_amount'] = $old_credit + $o1->amount;
            $result['pending_limit'] = $o->credit_limit - $o->credit_amount;

            $result['error'] = 0;
            $result['error_msg'] = "Wallet Amount updated. Now your current Credit is Rs. " . $result['credit_amount'];
        }

    } else if($o1->cash_credit == "Cash") {

        
        
        $o1->request_money_id = $insertor->insert_object($o1, "request_money");

        $notification = $o->name . " has sent a Request to Top Up Balance by " . $o1->amount;
        insert_notifications($o1->request_to, $notification);

        $email_to = $res_site[0]['email'];
        $email_from = $o->email;
        $email_subject = $notification;
        //$email_message = "Verification Code : ".$o->new_password;
        include "mails/send_request.php";

        sendmail($email_from, $email_to, $email_subject, $email_message);

        $result['error'] = 0;
        $result['error_msg'] = "Request has been forwarded to Admin. Admin will respond shortly";
    }else{
         $result['error'] = "1";
    $result['error_msg'] = "Something went wrong. Please try again";
    }
}
// $result['error']="3";
echo json_encode($result);
?>