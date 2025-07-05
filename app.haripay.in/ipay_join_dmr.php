<?php

session_start();

include "include.php";
include "session.php";

if ($_POST['ipay_login_updte'] == "1") {
	$userservice_check = check_userServices('Money Transfer',$o);

 if($userservice_check['error'] == '1'){
    $o1->customer_mobile = $_POST['ipay_mobile'];
    $results = ipay_pay_login($o1->customer_mobile);

    if ($results['error'] == "0") {
      
        if ($results['statuscode'] == "TXN") {
            $sql = "Select * from ipay_user where user_id = '" . $o->user_id . "' and mobileNo=" . $o1->customer_mobile;
            $res = getXbyY($sql);
            $row = count($res);
            if ($results['data']['remitter']['is_verified'] == "1") {
                $o1->status = "Verified";
                $result['error'] = "0";
                $o1->is_active = "1";
                $result['error_msg'] = "Login Successfully.";
            } else {
                $o1->status = "Not Verified";
                $result['error_msg'] = "Not Verified";
                $result['error'] = "2";
               
            }
            $o1->user_id = $o->user_id;
            $o1->merchantUserID = $results['data']['remitter']['id'];
            $o1->senderCode = "0";
            $o1->sender_id = "0";
            $o1->first_Name = $results['data']['remitter']['name'];
            $o1->last_Name = "";
            $o1->kyc_Flag = $results['data']['remitter']['kycstatus'];
            $o1->kyc_status = $results['data']['remitter']['kycdocs'];
            $o1->mobileNo = $results['data']['remitter']['mobile'];
            $o1->address = $results['data']['remitter']['address'];
            $o1->cityName = $results['data']['remitter']['city'];
            $o1->stateID = "0";
            $o1->state_name = $results['data']['remitter']['state'];
            $o1->pincode = $results['data']['remitter']['pincode'];
            $o1->addressProofNo = "0";
            $o1->addressProof = "0";
            $o1->addressProofUrl = "0";
            $o1->idProofNo = "0";
            $o1->idProof = "0";
            $o1->idProofUrl = "0";
            $o1->PIN_user = "0";
            $o1->updated_at = todaysDate();
            $o1->balance = $results['data']['remitter']['remaininglimit'];
            $o1->balance_limit = $results['data']['remitter']['consumedlimit'];
            $o1->other = $results['data']['remitter']['perm_txn_limit'];
            
            if ($row == "1") {
                $o1->ipay_user_id = $res[0]['ipay_user_id'];
                $o1->ipay_user_id = $updater->update_object($o1, "ipay_user");
            } else {
                $o1->created_at = todaysDate();
                $o1->ipay_user_id = $insertor->insert_object($o1, "ipay_user");
            }
            $result['ipay_user_id'] = $o1->ipay_user_id;
            $total_benificary = count($results['data']['beneficiary']);
            if ($total_benificary > 0) {
                for ($i = 0; $i < $total_benificary; $i++) {
                    $ben_id = $results['data']['beneficiary'][$i]['id'];
                    $sql_ben = "Select * from ipay_beneficiary where  user_id = '" . $o->user_id . "'  and  beneficiary_ID=" . $ben_id;
                    $res_ben = getXbyY($sql_ben);
                    $row_ben = count($res_ben);
                    $o2->user_id = $o->user_id;
                    $o2->ipay_user_id = $o1->ipay_user_id;
                    $o2->beneficiary_ID = $ben_id;
                    $o2->beneficiary_Code = "0";
                    $o2->beneficiaryName = $results['data']['beneficiary'][$i]['name'];
                    $o2->mobileNo = $results['data']['beneficiary'][$i]['mobile'];
                    $o2->beneficiaryAddress = "0";
                    $o2->accountType = "Saving";
                    $o2->ifscType = "IFSC";


                    $o2->bank_name = $results['data']['beneficiary'][$i]['bank'];
                    if ($o2->bank_name != "") {
                        $sql_bank = "Select * from ipay_bank where bank_name = '" . $o2->bank_name . "' ";
                        $res_bank = getXbyY($sql_bank);
                        $row_bank = count($res_bank);

                        $o2->bank_ID = $res_bank[0]['bankID'];
                    }
                    $o2->ifscCode = $results['data']['beneficiary'][$i]['ifsc'];
                    $o2->accountNo = $results['data']['beneficiary'][$i]['account'];
                    $o2->beneficiaryAddress = "0";
                    $o2->MMID = "0";
                    $o2->balance = "0";
                    $o2->other = "0";
                    $o2->is_active = "1";
                    $o2->status = $results['data']['beneficiary'][$i]['status'];
                    if ($o2->status == "1") {
                        $o2->status = "Verified";
                    } else {
                        $o2->status = "Not Verified";
                    }
                    $o2->updated_at = todaysDate();
                    if ($row_ben > 0) {
                        $o2->ipay_beneficiary_id = $res_ben[0]['ipay_beneficiary_id'];
                        $o2->ipay_beneficiary_id = $updater->update_object($o2, "ipay_beneficiary");
                    } else {
                        $o2->created_at = todaysDate();
                        $o2->ipay_beneficiary_id = $insertor->insert_object($o2, "ipay_beneficiary");
                    }
                }
            }

            if ($result['error'] == "0") {
                $_SESSION['ipay_customer_id'] = $o1->ipay_user_id;
            }
        } else if ($results['statuscode'] == "RNF") {
            $result['ipay_mobile'] = $o1->customer_mobile;
            $result['error_msg'] = "Please Register Before Login";
            $result['error'] = "3";
        }
    } else {

        $result['error'] = "1";
        $result['error_msg'] = $results['error_msg'];
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