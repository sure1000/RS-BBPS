<?php

session_start();
include "include.php";
include "session.php";

if($_POST['rech_updte'] == "1"){
    $o1->customerMobile = $_POST['rech_mobile'];
    $results = rech_remitter_details($o1->customerMobile);
  // pt($results);
      if($results['data']['error_code'] == "123"){
        $result['status'] = "2";
       $result['rech_mobile_reg'] = $o1->customerMobile;
       $result['error_msg'] = "Not Registered";
   }else if($results['data']['error_code'] == "200"){
    $sql_customer = "select * from rech_customer where  customerMobile='" . $o1->customerMobile . "' ";
    $res_customer = getXbyY($sql_customer, $fetchType);
    $rows_customer = count($res_customer);
   
    if($rows_customer > 0){
        if($results['data']['details']['otpVerified'] == '1'){
   $o1=$factory->get_object($res_customer[0]['rech_customer_id'],"rech_customer","rech_customer_id");
      $o1->otp_status = "Verified";
      $o1->is_active='1';
       $_SESSION['rech_customer_id'] = $o1->rech_customer_id;
   $o1 =$updater->update_object($o1,"rech_customer");

    }
  }else{
    $o1->customerMobile =  $o1->customerMobile;
    $o1->user_id =$o->user_id;
    $o1->customerName = $results['data']['details']['name'];
    $o1->customerPincode ="123456";
    $o1->otp_status ="Verified";
    $o1->is_active ='1';
    $o1->creditUsed ='0';
    $o1->other ='0';
    $o1->rech_customer_id =$insertor->insert_object($o1,"rech_customer");
   $_SESSION['rech_customer_id'] = $o1->rech_customer_id;
  }
     
       $result['status'] = "1";
       $result['error'] = "Login Successful";  
    

   }else{
    

       $result['status'] = "2";
       $result['rech_mobile_reg'] = $o1->customerMobile;
       $result['error_msg'] = "Not Registered";  
    

   }
   
}else if($_POST['rech_updte'] == "2"){
    $o1->user_id =$o->user_id;
    $o1->customerName = $_POST['rech_name'];
    $o1->customerPincode = $_POST['rech_pincode'];
    $o1->customerMobile = $_POST['rech_mobile_re'];
    $o1->creditUsed = "0";
    $o1->other = "0";
    $o1->otp_status = "Not Verified";
    $o1->is_active = "2";
    $sql_customer = "select * from rech_customer where  customerMobile='" . $o1->customerMobile . "' ";
    $res_customer = getXbyY($sql_customer, $fetchType);
    $rows_customer = count($res_customer);
 
     $results = rech_customer($o1);
 
    if ($results['data']['error_code'] == "178") {
     if ($rows_customer == 0) {

    $o1->rech_customer_id = $insertor->insert_object($o1, "rech_customer");
    $_SESSION['rech_customer_id'] = $o1->rech_customer_id;
    if($results['data']['otpRequired'] == '1'){
    $result['rech_mobile_verify']=$o1->customerMobile;
    $result['error'] = $results['data']['resText'];
    $result['status'] = "0";
    $result['otpRequired'] = $results['data']['otpRequired'];
    }else{
        $result['status'] = "1";
    $result['error'] = "Login Successful";
    }
    
        } else if ($rows_customer > 0) {
          
            $_SESSION['rech_customer_id'] = $res_customer[0]['rech_customer_id'];
           if($results['data']['otpRequired'] == '1'){
    $result['error'] = $results['data']['resText'];
   $result['status'] = "0";
    $result['otpRequired'] = $results['data']['otpRequired'];
   
    }else{
        $result['status'] = "1";
    $result['error'] = "Login Successful";
    }
        }   
    }else if($results['data']['error_code'] == "200"){
      if ($rows_customer == 0) {

    $o1->rech_customer_id = $insertor->insert_object($o1, "rech_customer");
    $_SESSION['rech_customer_id'] = $o1->rech_customer_id;
    $result['rech_mobile_verify']=$o1->customerMobile;
         $result['otpRequired'] =$results['data']['otpRequired'];
         $result['error'] = $results['data']['resText'];
         $result['status'] = "0";

      }
      if($rows_customer > 0){
         $result['rech_mobile_verify']=$o1->customerMobile;
         $result['otpRequired'] =$results['data']['otpRequired'];
         $result['error'] = $results['data']['resText'];
         $result['status'] = "0";

      }

    }else{
         $result['rech_mobile_verify']=$o1->customerMobile;
         $result['otpRequired'] =$results['data']['otpRequired'];
         $result['error'] = $results['data']['resText'];
         $result['status'] = "0";

    }
  
}else{
     $result['status'] = "2";
    $result['error'] = "Something went wrong please try again";
}


    echo json_encode($result);

?>

