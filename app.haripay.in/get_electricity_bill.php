<?php

session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

if ($updte == 1) {
    $userservice_check = check_userServices('Electricity',$o);
 
 if($userservice_check['error'] == '1'){
    $mobile = $_POST['mobile'];
    $provider = $_POST['provider'];
    
    $o3 = $factory->get_object("4", "api", "api_id");
    
    $o1->mobile_number = $_POST['mobile'];
    $o1->provider_id = $_POST['provider'];
    $o1->total_amount = '1';
    $o1->ref_number = reference_number();
    
    $api_response = mplan_bill_info_app($o1->provider_id, $o1->mobile_number);
   //pt($api_response);//die;
    $results = json_decode($api_response);
//pt($api_response);die;//$results
if($results->records[0]->desc == "Payment received for the billing period - no bill due" || $results->records[0]->desc == "Unable to get bill details from biller" || $results->records[0]->desc == "Plan Not Available"){
		$result['error'] = "1";
		$result['error_msg'] = $results->records[0]->desc;
		echo json_encode($result);die;
	}
    if ($results->status == "1"){
        $result['error'] = "0";
        $result['name'] = $results->records[0]->CustomerName;
        $result['amount'] = $results->records[0]->Billamount;
        $result['service'] = "Electricity";
        $result['account'] = $results->records[0]->BillNumber;
        $result['error_msg'] = $results->records[0]->CustomerName;
        $result['json_data'] = $results;
    }else{
		$result['error'] = "1";
		$result['error_msg'] = $results->records[0]->desc;
	}
	
}else{
	    $result['error'] = 1;
        $result['error_msg'] = "You are not authorized for this service";
 }
}

echo json_encode($result);
?>