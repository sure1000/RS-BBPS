<?php

session_start();

include "include.php";
include "session.php";

if($_POST['updte'] > 0){

$mobile = $_POST['ipay_mobile'];
$results = ipay_outlet_otp($mobile);

if($results['status'] == '1'){
	$result['mobile_ipay']= $mobile;
	$result['error']='1';
	$result['error_msg']="OTP Successfully Sent";
}else{
	$result['error']='0';
	$result['error_msg']="Something Went Wrong";
}
}
echo json_encode($result);
?>