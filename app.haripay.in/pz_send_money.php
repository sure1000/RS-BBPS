<?php

session_start();

include "include.php";
include "session.php";

$result['error'] = "1";
$result['error_msg'] = "Something went wrong please try again";

//die(json_encode($result));
$_POST['pz_send_updte'] = '1';
if ($_POST['pz_send_updte'] == '1') {
$userservice_check = check_userServices('dmr',$o);
 
 if($userservice_check['error'] == '1'){


    $beneficiary_id = $_POST['ben_name_pz'];
    $account = $_POST['pz_account'];
    $pz_ifsc = $_POST['pz_account'];
    $dezire_amount = $_POST['pz_amount'];
    $o1->provider_id = '84';
    $amount_slab = ceil($dezire_amount / 5000);
    $o1->ref_number = reference_number();
    $tt_amount = 0;
    $o2->md_key = '617C2A647D';
    //$plainText = 'EZ904522|100|' . $o1->ref_number . '';
    $plainText = 'EZ904522|100|9870987012';
    //$cipher = "SHA512";
    $hashed = hash('sha512', $plainText, true);
    
    $encData = base64_encode($hashed, "617C2A647D");
    
    echo $encData;
    echo "<br />";
    echo "RY6yOTunCZhnvSVbXsTRRg4dzEYhpHEiIQ6KsTyBjAFOyytX0N3UolVqq/XO4ZNPD8AwsZIRs7MSTIjqYnXqNw==";
    die();
    $decData = openssl_decrypt(base64_decode($encData), $cipher, $o2->md_key, OPENSSL_RAW_DATA, $iv);
 pt($encData);
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ezulix.in/payout/dmr/txn/bank",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\r\n \"AgentOrderId\": \"$o1->ref_number\",\r\n \"Amount\": \"100\",\r\n \"BeneficiaryAccount\": \"$account\",\r\n \"BeneficiaryIFSC\": \"$pz_ifsc\",\r\n \"Date\": \"2019-10-31\"\r\n} \r\n",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/json",
            "memberid: EZ904522",
            "chksum: ".$encData.""
          
            
            
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    pt($response);
    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }

    die();

    $o1->amount = $dezire_amount;

    if ($o1->amount <= $o->amount_balance) {

        for ($i = 0; $i < $amount_slab; $i++) {
            unset($o1->wallet_id);
            $o1->ref_number = "";
            $o1->parent_id = "0";

            $o1->api_id = "8";
            $o1->api_amount = $o1->amount;
            $o1->transaction_type = "Recharge";
            $o1->total_amount = $transfer_amount[$i];
            $o1->amount = $transfer_amount[$i] + $comm_slab[$i];
            $o1->mobile_number = $o3->accountNo;
            $o1->circle_name = '0';
            $o1->circle_id = "0";
            $o1->status = "Pending";
            $o1->recharge_path = "Web";

            $o1 = wallet_insert($o, $o1);

            $api_response = ipay_send_money($o1, $o4, $o3);

            if ($api_response['error'] == '0') {

                if ($api_response['statuscode'] == "ERR") {
                    $o1->status = "Failed";
                } else {
                    $o1->status = ipay_recharge_status($api_response['status']);
                }

                $o1->transaction_details = "Money Transfer to " . $o3->beneficiaryName . " [ " . $o3->accountNo . " ] Transaction Type : " . $transactiontype . "";
                $o1->comment = $api_response['status'];
                $o1->gst = "0";
                $o1->updated_at = todaysDate();
                $o1->api_response = $api_response['response'];
                $o1->recharge_url = $api_response['url'];
                $o1->recharge_url = "0";
                $o1->api_number = $api_response['data']['ipay_id'];
                $o1->opid = $api_response['data']['opr_id'];

                if ($o1->status == 'Success') {
                    $o1->status = "Success";
                    $o1->wallet_id = $updater->update_object($o1, "wallet");

                    $o1->parent_id = $o1->wallet_id;
                    set_commission($o1, $o, "Money Transfer");
                    $result['error'] = "0";
                } else if ($o1->status == 'Pending') {
                    $o1->status = "Pending";
                    $o1->wallet_id = $updater->update_object($o1, "wallet");
                    $result['error'] = "0";
                } else if ($o1->status == 'Failed') {
                    $o1->status = "Failed";
                    $o1->wallet_id = $updater->update_object($o1, "wallet");
                    $o1->transaction_type = "Refund";
                    $o1->status = "Success";
                    $o1->parent_id = $o1->wallet_id;
                    $o1 = wallet_insert($o, $o1);
                    $result['error'] = "1";
                }

                $result['error_msg'] = $api_response['status'];
            } else {
                $result['error'] = "1";
                $result['error_msg'] = $api_response['error_msg'];
            }

            $user_response = ipay_pay_login($o4->mobileNo);
            if ($user_response['error'] == "0") {
                if ($user_response['statuscode'] == "TXN") {
                    $o4->balance = $user_response['data']['remitter']['remaininglimit'];
                    $o4->balance_limit = $user_response['data']['remitter']['consumedlimit'];
                    $o4->other = $user_response['data']['remitter']['perm_txn_limit'];
                    $o4->ipay_user_id = $updater->update_object($o4, "ipay_user");
                }
            }

            $result['ipay_balance'] = $o4->balance;
            $result['ipay_balance_limit'] = $o4->balance_limit;
        }
    } else {
        $result['error'] = 1;
        $result['error_msg'] = "Sorry, Your Wallet Balance is less than Required Amount";
    }
	
	}else{
	    $result['error'] = "1";
        $result['error_msg'] = "You are not authorized for dmr service";
 }
	
	
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>



