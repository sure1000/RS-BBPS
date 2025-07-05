<?php
session_start();

include "include.php";
include "session.php";

if($updte==1){

	$user_id=$_POST['user_id'];
 

	$sql_services = "Select * from services where is_active=1";
	$res_services = getXbyY($sql_services);
	$rows_services = count($res_services);	

	for($i=0;$i<$rows_services;$i++) { 

		$result['body'].='  <div class="col-md-6">
		<div class="row">
		<div class="col-md-6">
		<span>'.$res_services[$i]['service_name'].' </span>
		</div>
		<div class="col-md-6">
		<label class="switch">
		<input type="checkbox" name="status_'.$i.'" id="status_'.$i.'"';


		$sql_user_services = "Select * from user_services where user_id='".$user_id."' and service_id='".$res_services[$i]['service_id']."' and status='Yes' and is_active=1";
		$res_user_services = getXbyY($sql_user_services);
		$rows_user_services = count($res_user_services);	

		if($rows_user_services>0){
			$result['body'].=' checked="checked"';
		} 

		$result['body'].='  onclick="save_user_rights('.$res_services[$i]['service_id'].','.$i.','.$user_id.')"  value="Yes">
		<span class="slider round span_margin">Yes</span>
		</label>

		</div>
		<input type="hidden" name="loop_id" id="loop_id" value="'.$i.'">
		<input type="hidden" name="service_id" id="service_id" value="'.$res_services[$i]['service_id'].'">
		<input type="hidden" name="user_id" id="user_id" value="'. $user_id .'" />

		</div>
		</div>';


	}
	$result['error']='1';

} else {
	$result['error']='0';
}



echo json_encode($result);