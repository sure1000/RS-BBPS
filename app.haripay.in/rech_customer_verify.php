<?php
session_start();
include "include.php";
include "session.php";
if ($_POST['verify_updte'] > 0) {
    $mobile = $_POST['rech_mobile_verify'];
    $otp = $_POST['otp'];
    if($otp !=""){
    	$result =rech_verify_cutomer($mobile,$otp);
      
        if ($result['data']['error_code'] == "200") {
        $sql ="Select * from rech_customer where customerMobile='".$mobile."' and is_active='2'";
        $res =getXbyY($sql);
        $row=count($res);
        if($row > 0){
            $o1 = $factory->get_object($res[0]['rech_customer_id'] ,"rech_customer" ,"rech_customer_id");
            $o1->otp_status='Verified';
            $o1->is_active = '1';
            // $_SESSION['rech_customer_id'] = $o1->rech_customer_id;
            $o1 =$updater->update_object($o1,"rech_customer");

        }

 $results['status'] = 1;
$results['error'] = $result['data']['resText'];
        }else{

$results['status'] = 0;
$results['error'] = $result['data']['resText'];
        }
      

    }else{

    }


  echo json_encode($results);
}


?>