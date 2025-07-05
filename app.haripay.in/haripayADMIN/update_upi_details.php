<?php
session_start();
include 'include.php';
include "session.php";


if($_POST){
       // pt($_POST);die;
    $o1->payeeVPA = $_POST['payeeVPA'];
    $o1->payeeName = $_POST['payeeName'];
    $o1->payeeMerchantCode = $_POST['payeeMerchantCode'];
    $o1->minimumAmount = $_POST['minimumAmount'];
    $o1->transactionRefUrl = $_POST['transactionRefUrl'];
    $o1->aid = $_POST['aid'];
     $o1->upi_setup_id = $_POST['user_id'];
     $updater->update_object($o1, "upi_setup");
     $result['error']= 1;
     $result['error_msg']="Update successfully.";
    
}

 header('location:upi_settings.php');
 // echo json_encode($result);
  ?>
