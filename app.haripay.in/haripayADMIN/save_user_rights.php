<?php

session_start();
include "include.php";
include "session.php";

if ($_POST['updte'] ==1) {

	$user=$_POST['id'];
	$service_id=$_POST['service_id'];
	$status=$_POST['status'];
 



	$sql_service="Select * from user_services  where user_id='".$user."' and service_id='".$service_id."'  ";
	$res_service=getXbyY($sql_service);
	$row_service=count($res_service);
	if ($row_service >"0") {
		$sql_update="update user_services set status='".$status."' where user_id='".$user."' and service_id='".$service_id."' ";
		$res_update=setXbyY($sql_update);
		$row_update=count($res_update);	
	}else{
		$sql_services="Select * from services Where service_id='".$service_id."'  ";
		$res_services=getXbyY($sql_services);
		$o2->user_id=$user;
		$o2->service_id = $res_services[0]['service_id'];
		$o2->service_name = $res_services[0]['service_name'];
		$o2->status = $status;
		$o2->is_active = '1';
		$o2->created_at = todaysDate();
		$o2->updated_at = todaysDate();
		$o2->user_service_id = $insertor->insert_object($o2, "user_services");
 
	}

	$result['error']=1;
	

} else {

	$result['error']=0;
	
}

echo json_encode($result);