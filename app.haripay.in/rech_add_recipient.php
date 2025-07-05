<?php

session_start();
include "include.php";
include "session.php";

if ($updte > 0) {


    $o2 = $factory->get_object($_SESSION['rech_customer_id'], "rech_customer", "rech_customer_id");

    $customerMobile = $o2->customerMobile;
    $beneficiaryName = $_POST['rech_recipient_name'];
    $beneficiaryMobileNumber = $_POST['rech_receipient_mobile'];
    $ifscCode = $_POST['rech_ifsc'];
    $beneficiaryAccountNumber = $_POST['rech_account'];
    $bank_name = $_POST['bank_rech'];


    $sql = "Select * from rech_beneficiary where rech_customer_id='" . $o2->rech_customer_id . "'  and beneficiaryAccountNumber='" . $beneficiaryAccountNumber . "'  and user_id = '" . $o->user_id . "' and is_active = '1'";
    $res = getXbyY($sql);
    $rows = count($res);
    if ($rows > 0) {
        if ($res[0]['otp_status'] == 'Verify') {
            $flag = 1;
        } else {
            $flag = 0;
        }
    } else {
        $flag = 0;
    }
    if ($flag == 0) {
        $result = rech_customer_ben($customerMobile, $beneficiaryName, $beneficiaryMobileNumber, $ifscCode, $beneficiaryAccountNumber);
        if ($result['data']['error_code'] == "200") {

            $sql = "Select * from rech_beneficiary where beneficiaryId='" . $result['data']['beneficiaryId'] . "' ";
            $res = getXbyY($sql);
            $rows = count($res);
            if ($rows > 0) {
                $o1 = $factory->get_object($res[0]['rech_beneficiary_id'], "rech_beneficiary", "rech_beneficiary_id");
            }
            $o1->user_id = $o->user_id;
            $o1->rech_customer_id = $o2->rech_customer_id;
            $o1->beneficiaryName = $beneficiaryName;
            $o1->beneficiaryMobileNumber = $beneficiaryMobileNumber;
            $o1->beneficiaryAccountNumber = $beneficiaryAccountNumber;
            $o1->ifscCode = $ifscCode;
            $o1->beneficiaryId = $result['data']['beneficiaryId'];
            $o1->other = $bank_name;
            $o1->is_active = 2;
            $o1->otp_status = "Pending";
            if ($o1->rech_beneficiary_id > 0) {
                $o1->rech_beneficiary_id = $updater->update_object($o1, "rech_beneficiary");
            } else {
                $o1->rech_beneficiary = $insertor->insert_object($o1, "rech_beneficiary");
            }

            $results['error'] = "Recipient added successfully." . $result['data']['resText'];
            $results['status'] = 1;
            $results['rech_benificiary_id_otp'] = $o1->beneficiaryId;
        } else {

            $results['error'] = "Process Failed." . $result['data']['resText'];
            $results['status'] = 0;
        }
    } else {
        $results['error'] = "Already Registrated";
        $results['status'] = 0;
    }
}
echo json_encode($results);
?>