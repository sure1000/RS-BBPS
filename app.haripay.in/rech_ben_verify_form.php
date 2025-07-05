<?php

session_start();

include "include.php";
include "session.php";

if ($updte > 0) {
   // pt($_POST);die();
   $o2 = $factory->get_object($_SESSION['rech_customer_id'], "rech_customer", "rech_customer_id");
    $customerMobile = $o2->customerMobile;
    $beneficiary_id = $_POST['rech_benificiary_id_otp'];
    $otp = $_POST['rech_otp'];
    $result = rech_ben_validate($customerMobile,$beneficiary_id, $otp);
       if ($result['data']['error_code'] == "200") {
        $query = "Update rech_beneficiary set otp_status = 'Verify' , is_active=1 where beneficiaryId='".$beneficiary_id."'";
        $set = setXbyY($query);
        $results['error'] = "Verification successful ";
        $results['status'] = 1;
       
       } else {

        $results['error'] = "Process Failed.".$result['data']['resText'];
        $results['status'] = 0;
    }
 
   
    echo json_encode($results);
}
?>