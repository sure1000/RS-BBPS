<?php
session_start();

include "include.php";
include "session.php";

if($_POST['updte'] > 0){
	$sql = "select * from userServices where user_id ='".$_POST['user_id']."' and is_active ='1'";
	$res = getXbyY($sql);
	$row = count($res);
    if($row > 0){
    	$o1 =$factory->get_object($res[0]['userService_id'],"userServices","userService_id");
    	if($_POST['service_name'] == 'postpaid'){
   	$o1->postpaid_service =$_POST['status_val'];
   }
   if($_POST['service_name'] == 'prepaid'){
   	$o1->prepaid_service =$_POST['status_val'];
   }
    if($_POST['service_name'] == 'landline'){
   	$o1->landline_service =$_POST['status_val'];
   }
    if($_POST['service_name'] == 'dth'){
   	$o1->dth_service =$_POST['status_val'];
   }
   if($_POST['service_name'] == 'electricity'){
   	$o1->electricity_service =$_POST['status_val'];
   }
   
  if($_POST['service_name'] == 'dmr'){
   	$o1->dmr_service =$_POST['status_val'];
   }
 $o1->userService_id =$updater->update_object($o1,"userServices");
    }else{

   $o1->user_id =$_POST['user_id'];
   if($_POST['service_name'] == 'postpaid'){
   	$o1->postpaid_service =$_POST['status_val'];
   }else{
   	$o1->postpaid_service ='Yes';
   }
   if($_POST['service_name'] == 'prepaid'){
   	$o1->prepaid_service =$_POST['status_val'];
   }else{
   	$o1->prepaid_service ='Yes';
   }
    if($_POST['service_name'] == 'landline'){
   	$o1->landline_service =$_POST['status_val'];
   }else{
   	$o1->landline_service ='Yes';
   }
    if($_POST['service_name'] == 'dth'){
   	$o1->dth_service =$_POST['status_val'];
   }else{
   	$o1->dth_service ='Yes';
   }
   if($_POST['service_name'] == 'electricity'){
   	$o1->electricity_service =$_POST['status_val'];
   }else{
   	$o1->electricity_service ='Yes';
   }
   
  if($_POST['service_name'] == 'dmr'){
   	$o1->dmr_service =$_POST['status_val'];
   }else{
   	 $o1->dmr_service ='Yes';
   }
   $o1->created_on =todaysDate();
   $o1->is_active =1;
   $o1->userService_id = $insertor->insert_object($o1,"userServices");
}
$result['error']=1;
}
echo json_encode($result);
?>
