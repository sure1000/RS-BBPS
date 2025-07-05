<?php
session_start();

include "include.php";
include "session.php";

if($_POST['updte'] > 0){
$o1->mobile=$_POST['ipay_mobile_reg'];
$o1->pan=$_POST['ipay_pan_reg'];
$o1->name=$_POST['ipay_name_reg'];
$o1->email=$_POST['ipay_email_reg'];
$o1->company=$_POST['ipay_company_reg'];
$o1->address=$_POST['ipay_address_reg'];
$o1->otp=$_POST['ipay_otp_reg'];
$o1->pincode=$_POST['ipay_pincode_reg'];
$results =ipay_outlet_registration($o1);
if($results['status'] == '1'){
	sendmail($email_from ,$o1->email,"Outlet Status:ShibaTechnology",$results['error']);
	$o2 =$factory->get_object("8","api","api_id");
	$o2->security_key =$results[''];
	$o2=$updater->update_object($o2,"api");
    $result['error']='1';
	$result['error_msg']="Check Outlet Status On Mail,Now";
}else{
	$result['error']='0';
	$result['error_msg']="Something Went Wrong";

}







}
echo json_encode($result);
?>