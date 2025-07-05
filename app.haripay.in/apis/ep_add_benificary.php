<?php

include "include.php";



if ($_POST['ben_add_updte'] == "1") {
    if ($_POST['dmt_remitter_id'] > 0 || $_POST['dmt_remitter_id'] != '') {
        $o2 = $factory->get_object($_POST['dmt_remitter_id'], "paytm_user", "paytm_user_id");
    }
    $sql = "Select paytm_beneficiary_id from paytm_beneficiary where  paytm_user_id = '" . $_POST['dmt_remitter_id'] . "' and  accountNo='" . $_POST['account_number'] . "'";
    $res = getXbyY($sql);
    $row = count($res);

    if ($row > 0) {
        $result['error'] = "1";
        $result['error_msg'] = "Account Number Already Exist.";
    } else {
        
        
       
        $o1->user_mobile = $o2->mobileNo;
        $o1->beneficiaryName = $_POST['ben_name'];
        $o1->mobileNo = $_POST['ben_mobile'];
        $o1->ifscCode = $_POST['ifse_code'];
        $o1->accountNo = $_POST['account_number'];
        $o1->beneficiaryAddress = $_POST['Ben_address'];
        $o1->user_id = $o->user_id;
        $o1->paytm_user_id = $o2->paytm_user_id;
        $o1->beneficiary_Code = "";
        $o1->ben_otp = "";
        $o1->accountType = '1';
        $o1->ifscType = '1';
        $o1->bank_ID = '0';
        $o1->bank_name = "";
        $o1->MMID = '0';
        $o1->created_at = todaysDate();
        $o1->updated_at = todaysDate();
        $o1->balance = '0';
        $o1->other = $_POST['other_dmt'];
        $o1->status = 'Verified';
        $o1->is_active = '1';
        $results = ep_add_benificary($o1);

        if ($results['data']['error'] == '0') {
            $o1->beneficiary_ID = $results['data']['beneficiary_ID'];

            //$api_response =  Check_ben_verify($o1);
            //$o1->other = $api_response['status'];
            $o1->paytm_beneficiary_id = $insertor->insert_object($o1, "paytm_beneficiary");
            $result['beneficiary_ID'] = $results['data']['beneficiary_ID'];
            $result['error'] = "0";
            $result['error_msg'] = $results['data']['error_msg'];
        } else {
            $result['error'] = "1";
            $result['error_msg'] = $results['data']['error_msg'];
        }
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>