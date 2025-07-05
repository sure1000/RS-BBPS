<?php

include "include.php";
include "session.php";

if ($updte > 0) {
 
    $o2 = $factory->get_object($_SESSION['rech_customer_id'], "rech_customer", "rech_customer_id");
  //  pt($o2);
    $benificiary_id = $_POST['ben_id'];
    
    $result = ipay_ver_resend($benificiary_id,$o2->remitter_id);
 
    if ($result['statuscode'] == "TXN") {

        //$results['error'] = "Resend otp .".$result['status'];
        $results['status'] = 1;
        $results['benificiary_id'] =$benificiary_id ;
    } else {

        $results['error'] = "Process Failed.".$result['status'];
        $results['status'] = 0;
    }
    echo json_encode($results);
}
?>