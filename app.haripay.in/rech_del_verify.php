<?php

include "include.php";
include "session.php";

if ($updte > 0) {

   $o2 = $factory->get_object($_SESSION['rech_customer_id'], "rech_customer", "rech_customer_id");
    $customerMobile = $o2->customerMobile;
   
    $otp = $_POST['rech_otp_ben'];
    $beneficiary_id = $_POST['rech_benificiary_id1'];

    $result = rech_ben_remove_verify($customerMobile, $beneficiary_id,$otp);


    if ($result['data']['error_code'] == "200") {
       $sql = "Update rech_beneficiary set is_active=0 ,otp_status='Delete' where rech_beneficiary_id=" . $beneficiary_id;
        $res = setXbyY($sql);
        $results['status'] = 1;
         $results['error'] = "Beneficiary Remove successfully.";
       
    } else {
        $results['status'] = 0;
        $results['error'] = "Error, recipient could not be removed" .$result['status'];
    }
}
echo json_encode($results);
?>