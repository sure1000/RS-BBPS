<?php

include "include.php";


if ($_POST['ipay_add_ben_updte'] > 0) {

  if($_POST['ipay_user_id'] > 0){
    $o2 = $factory->get_object($_POST['ipay_user_id'], "ipay_user", "ipay_user_id");

    $o1->beneficiaryName = $_POST['beneficiaryName_ipay'];
    $o1->mobileNo = $_POST['mobileNo_ipay'];
    $o1->bank_ID = $_POST['bank_ID_pay'];
    
    if($o1->bank_ID > 0){
         $o3 = $factory->get_object($o1->bank_ID, "ipay_bank", "bankID");
     
         $o1->bank_name = $o3->bank_name;
    }
    $o1->ifscCode = $_POST['ifscCode_pay'];
    $o1->accountNo = $_POST['accountNo_pay'];
    $o1->ipay_user_id = $_POST['ipay_user_id'];
    $o1->user_id = $o->user_id;
    $o1->is_active = "1";
    $sql = "Select * from ipay_beneficiary where ipay_user_id='".$_POST['ipay_user_id'] ."' and accountNo='" . $o1->accountNo . "'  and user_id = '" . $o->user_id . "'";
    $res = getXbyY($sql);
    $rows = count($res);
    if ($rows == 0) {
        $api_result = ipay_add_beneficiary($o1, $o2);
        if ($api_result['error'] == "0") {

            if ($api_result['statuscode'] == "TXN") {
                $o1->beneficiary_ID = $api_result['data']['beneficiary']['id'];
                $o1->beneficiary_Code = $o2->remitter_id;

                if ($api_result['data']['beneficiary']['status'] == "1") {
                    $o1->status = "Verified";
                    $results['error'] = "0";
                    $results['error_msg'] = " Recipient added successfully." . $api_result['status'];
                } else {
                    $o1->status = "Not Verified";
                    $results['error'] = "2";
                    $results['error_msg'] = $api_result['status'];
                }
                $o1->ipay_beneficiary_id = $insertor->insert_object($o1, "ipay_beneficiary");
            } else {
                $results['error_msg'] = $api_result['status'];
                $results['error'] = "1";
            }
        } else {
            $results['error_msg'] = $api_result['error_msg'];
            $results['error'] = "1";
        }
    } else {
        $results['error_msg'] = "Already Registrated";
        $results['error'] = "1";
    }
  }else{
      $result['error'] = "1";
    $result['error_msg'] = "Invalid User";
  }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}
echo json_encode($results);
?>

