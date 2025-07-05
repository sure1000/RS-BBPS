<?php

session_start();

include "include.php";
include "session.php";

if($_POST['dmr_commission_id'] > 0){
$o1->dmr_commission_id	= $_POST['dmr_commission_id'];
$o1->start_amount=$_POST['start_amount'];
$o1->end_amount=$_POST['end_amount'];
$o1->dmr_type=$_POST['dmr_type'];
$o1->commission_value=$_POST['commission_value'];
$o1->plan_id=$_POST['plan_id'];
$o1->is_active=1;

$o1->dmr_commission_id = $updater->update_object($o1, "dmr_commission");
$result['error'] ='1';
$result['error_msg']="Data updated Successfully!!";		
	
}else{
$o1->start_amount=$_POST['start_amount'];
$o1->end_amount=$_POST['end_amount'];
$o1->dmr_type=$_POST['dmr_type'];
$o1->commission_value=$_POST['commission_value'];
$o1->is_active=1;

$o1->dmr_commission_id = $insertor->insert_object($o1, "dmr_commission");
$result['error'] ='1';
$result['error_msg']="Data Saved Successfully!!";	
}


echo json_encode($result);
?>