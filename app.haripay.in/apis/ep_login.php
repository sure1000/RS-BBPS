<?php

include "include.php";



if ($_POST['dmt_userpin_updte'] == "1") {

    $o1->mobile = $_POST['dmt_pinmobile'];
    $o1->pin = $_POST['dmt_userpin'];

    $results = ep_login($o1);

    if ($results['data']['error'] == '0') {
        $sql = "Select paytm_user_id from paytm_user where mobileNo='" . $o1->mobile . "' and is_active ='1'";
        $res = getXbyY($sql);
        $row = count($res);
        $flag = "1";
        if ($row == 1) {

            $o1 = $factory->get_object($res[0]['paytm_user_id'], "paytm_user", "paytm_user_id");
            $o1->updated_at = todaysDate();
            $o1->paytm_user_id = $updater->update_object($o1, "paytm_user");
            $result['paytm_user_id'] = $o1->paytm_user_id;
            $result['error'] = "0";
            $result['error_msg'] = $results['data']['error_msg'];
            $flag = "0";
        } else if ($row == 0) {
            $result['error'] = "0";
            $result['error_msg'] = $results['data']['error_msg'];
            $o1->user_id = $o->user_id;
            $o1->paytm_otp = '0';
            $o1->merchantUserID = '0';
            $o1->first_Name = $results['data']['merchant']['first_Name'];
            $o1->last_Name = $results['data']['merchant']['last_Name'];
            $o1->mobileNo = $results['data']['merchant']['mobileNo'];
            $o1->address = $results['data']['merchant']['address'];
            $o1->cityName = $results['data']['merchant']['cityName'];
            $o1->pincode = $results['data']['merchant']['pincode'];
            $o1->status = $results['data']['merchant']['status'];
            $o1->state_name = $results['data']['merchant']['state_name'];
            $o1->balance = $results['data']['merchant']['balance'];
            $o1->senderCode = $results['data']['merchant']['senderCode'];
            $o1->kyc_Flag = '0';
            $o1->kyc_status = 'Not verified';
            $o1->stateID = '0';
            $o1->addressProofNo = '0';
            $o1->addressProof = '0';
            $o1->addressProofUrl = '0';
            $o1->idProofNo = '0';
            $o1->idProof = '0';
            $o1->idProofUrl = '0';
            $o1->PIN_user = $_POST['dmt_userpin'];
            $o1->created_at = todaysDate();
            $o1->updated_at = todaysDate();
            $o1->is_active = 1;

            $o1->paytm_user_id = $insertor->insert_object($o1, "paytm_user");
            $result['paytm_user_id'] = $o1->paytm_user_id;
            $flag = "0";
        } else {
            $result['error'] = "1";
            $result['error_msg'] = "Something went wrong please try again";
        }
        if ($flag == "0") {

            $tt_ben = count($results['data']['beneficiary']);

            if ($tt_ben > 0) {
                for ($i = 0; $i < $tt_ben; $i++) {
                    $ben_mobile = $results['data']['beneficiary'][$i]['mobileNo'];
                    $accountNo = $results['data']['beneficiary'][$i]['accountNo'];

                    $sql = "Select paytm_beneficiary_id from paytm_beneficiary where  paytm_user_id = '" . $o1->paytm_user_id . "' and accountNo = '" . $accountNo . "'  ";
                    $res = getXbyY($sql);
                    $row = count($res);
                    if ($row == "1") {
                        $o2 = $factory->get_object($res[0]['paytm_beneficiary_id'], "paytm_beneficiary", "paytm_beneficiary_id");
                    }
                    $o2->user_id = $o->user_id;
                    $o2->paytm_user_id = $o1->paytm_user_id;
                    $o2->beneficiary_Code = "NP" . $o2->user_id . "-B" . $o2->paytm_user_id;
                    $o2->ben_otp = rand(500000, 999999);
                    $o2->beneficiaryName = $results['data']['beneficiary'][$i]['beneficiaryName'];
                    $o2->beneficiaryAddress = $results['data']['beneficiary'][$i]['beneficiaryAddress'];
                    $o2->mobileNo = $results['data']['beneficiary'][$i]['mobileNo'];
                    $o2->accountType = '1';
                    $o2->ifscType = '1';
                    $o2->bank_ID = '0';
                    $o2->bank_name = '0';
                    $o2->ifscCode = $results['data']['beneficiary'][$i]['ifscCode'];
                    $o2->accountNo = $results['data']['beneficiary'][$i]['accountNo'];
                    $o2->MMID = '0';
                    $o2->created_at = todaysDate();
                    $o2->updated_at = todaysDate();
                    $o2->balance = '0';
                    $o2->other = '0';
                    $o2->status = 'Verified';
                    $o2->is_active = '1';



                    if ($o2->paytm_beneficiary_id > 0) {
                        $o2->paytm_beneficiary_id = $updater->update_object($o2, "paytm_beneficiary");
                    } else {
                        $o2->paytm_beneficiary_id = $insertor->insert_object($o2, "paytm_beneficiary");
                    }
                    unset($o2);
                    unset($accountNo);
                }
            }
        }
    } else {
        $result['dmt_mobile'] = $results['data']['mobile'];
        $result['error'] = "1";
        $result['error_msg'] = $results['data']['error_msg'];
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>