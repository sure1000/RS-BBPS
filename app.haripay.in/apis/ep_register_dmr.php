<?php

include "include.php";


if ($_POST['dmt_join_updte'] == "1") {

    $o1->merchantUserID = '';
    $o1->paytm_otp = '';
    $o1->user_id = $o->user_id;
    $o1->first_Name = $_POST['dmt_first_Name'];
    $o1->last_Name = $_POST['dmt_last_Name'];
    $o1->kyc_Flag = '0';
    $o1->kyc_status = 'Not verified';
    $o1->mobileNo = $_POST['dmt_mobileNo'];
    $o1->address = $_POST['dmt_address'];
    $o1->cityName = $_POST['dmt_area'];
    $o1->stateID = '0';
    $o1->state_name = $_POST['dmt_state'];
    $o1->pincode = $_POST['dmt_pincode'];
    $o1->addressProofNo = '0';
    $o1->addressProof = '0';
    $o1->addressProofUrl = '0';
    $o1->idProofNo = '0';
    $o1->idProof = '0';
    $o1->idProofUrl = '0';
    $o1->status = 'Not Verified';
    $o1->PIN_user = $_POST['rg_dmt_userpin'];
    $o1->created_at = todaysDate();
    $o1->updated_at = todaysDate();
    $o1->balance = '25000';
    $o1->balance_limit = '25000';
    $o1->other = '0';
    $o1->is_active = '2';
    $results = ep_register_dmr($o1);
 

    if ($results['data']['error'] == '0') {
        $o1->senderCode = $results['data']['senderCode'];
        $o1->paytm_user_id = $insertor->insert_object($o1, "paytm_user");
        $result['error'] = "0";
        $result['mobileNo'] = $results['data']['mobile'];
        $result['error_msg'] = $results['data']['error_msg'];
    } else {
        $result['error'] = "1";
        $result['mobileNo'] = $results['data']['mobile'];
        $result['error_msg'] = $results['data']['error_msg'];
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>