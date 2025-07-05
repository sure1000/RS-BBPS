<?php
session_start();
include"include.php";
include"session.php";

if ($_POST['updte']=="1") {
	$message=strip_tags($_POST['message']);
	if ($message =="") {
		$result['error']="1";
		$result['error_msg']="Please Enter Message";
		echo json_encode($result);
		die();
	}
if ($_POST['user_type'] !="0" && $_POST['phone_email']=="" ) {
		$user_type =$_POST['user_type'];
		if ($user_type=="All") {
			$sql="Select * from users Where  is_active='1' and user_type !='Admin' ";		
		}else{
			$sql="Select * from users Where user_type='".$user_type."'  and is_active='1' ";
		}	
		$res=getXbyY($sql);
		$row=count($res);
		if ($row>0) {
			for ($i=0; $i <$row ; $i++) { 

             sendsms_payzoom($res[$i]['mobile'], $message);   
				

			}
			$result['error']="0";
			$result['error_msg']="Send Successfully ";
		}else{
			$result['error']="1";
			$result['error_msg']="No user in this user type";

		}

	}else{
 
		$number =explode("," , $_POST['phone_email']);
		$count =count($number);

		for ($i=0; $i <$count ; $i++) { 
			$number[$i] = str_replace(' ', '', $number[$i]);
			
              sendsms_payzoom($number[$i], $message);   
			// $response_sms_api = $data['buffer'];
			// $api_id =$data['api_id'];
			// $api_name=$data['api_name'];

			// $o1->api_id = $api_id;
			// $o1->api_name= $api_name;
			// $o1->mobile_no = $number[$i];
			// $o1->message = $message;
			// $o1->response_sms_api = $response_sms_api;
			// $o1->created_at = todaysDate();
			// $o1->is_active='1';
			// $o1->sms_report_id = $insertor->insert_object($o1, "sms_report");
			// unset($o1->sms_report_id);
		}
		$result['error']="0";
		$result['error_msg']="Send Successfully ";

	}
}else{
	$result['error']="1";
	$result['error_msg']="Something went wrong Please try again";
}

echo json_encode($result);

?>
