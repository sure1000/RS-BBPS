<?php
session_start();

include "include.php";
include "session.php";

if (isset($_GET['aid'])) {
	$o1->api_id = $_GET['aid'];
} else {
	$o1->api_id = 0;
}

if ($o1->api_id > 0) {
	$o1 = $factory->get_object($o1->api_id, "api", "api_id");
	$o300 = $factory->get_object($o1->api_id, "api", "api_id");
	
} else {
	$o1->is_active = 1;
}

if ($updte == 1) {

$o1->api_type = $_POST['api_type'];
    $o1->api_name = $_POST['api_name'];

    $o1->balance_check_url = $_POST['balance_check_url'];
    $o1->status_name = $_POST['status_name'];
    $o1->status_check_url = $_POST['status_check_url'];
    $o1->balance_check_url = $_POST['balance_check_url'];
    $o1->bill_fetch_url = $_POST['bill_fetch_url'];
    $o1->success_value = $_POST['success_value'];
    $o1->failed_value = $_POST['failed_value'];
    $o1->pending_value = $_POST['pending_value'];
    $o1->refid_value = $_POST['refid_value'];
    $o1->operator_id = $_POST['operator_id'];
    $o1->lapu_no = $_POST['lapu_no'];
    $o1->remain_balance = $_POST['remain_balance'];
    $o1->remark = $_POST['remark'];
    $o1->method = $_POST['method'];
    $o1->format = $_POST['format'];
    $o1->api_type = $_POST['api_type'];
    $o1->is_active = $_POST['is_active'];
    $o1->api_domain = $_POST['api_domain'];
    $o1->api_username = "0";
    $o1->api_password = "0";
    $o1->api_key = $_POST['api_key'];
    $o1->api_username = $_POST['api_username'];
    $o1->security_key = "0";
    $o1->corporate_id = "0";
    $o1->md_key = "0";
    $o1->date_api = todaysDate();
    ///callback setting
    $o1->callbacksuccess_value = $_POST['callbacksuccess_value'];
    $o1->callbackfailed_value = $_POST['callbackfailed_value'];
    $o1->callbackstatus_value = $_POST['callbackstatus_value'];
    $o1->callbackrefid_value = $_POST['callbackrefid_value'];
    $o1->callbackoperator_id = $_POST['callbackoperator_id'];
    $o1->callbackmethod = $_POST['callbackmethod'];
    $o1->callbackremark = $_POST['callbackremark'];
   
	if ($o1->api_id > 0) {
	    //pt($o300);die;
		
		$id =$o1->api_id;
        $myfile = "../callback_apis$id.php";
        //echo $myfile; die;
        //copy('../callback_apis.php', $myfile);
        
        file_put_contents($myfile,str_replace($o300->callbackstatus_value,$o1->callbackstatus_value,file_get_contents($myfile)));
        file_put_contents($myfile,str_replace($o300->callbackrefid_value,$o1->callbackrefid_value,file_get_contents($myfile)));
        file_put_contents($myfile,str_replace($o300->callbackoperator_id,$o1->callbackoperator_id,file_get_contents($myfile)));
        file_put_contents($myfile,str_replace($o300->callbacksuccess_value,$o1->callbacksuccess_value,file_get_contents($myfile)));
        file_put_contents($myfile,str_replace($o300->callbackfailed_value,$o1->callbackfailed_value,file_get_contents($myfile)));
        file_put_contents($myfile,str_replace('$_'.$o300->callbackmethod,'$_'.$o1->callbackmethod,file_get_contents($myfile)));
        file_put_contents($myfile,str_replace($o300->callbackremark,$o1->callbackremark,file_get_contents($myfile)));
        $o1->api_id = $updater->update_object($o1, "api");
	} else {
	    $o1->api_balance = $_POST['api_balance'];
		$o1->api_id = $insertor->insert_object($o1, "api");
		$id =$o1->api_id;
        $myfile = "../callback_apis$id.php";
        //echo $myfile; die;
        copy('../callback_apis.php', $myfile);
        
        file_put_contents($myfile,str_replace('SSS',$o1->callbackstatus_value,file_get_contents($myfile)));
        file_put_contents($myfile,str_replace('RRR',$o1->callbackrefid_value,file_get_contents($myfile)));
        file_put_contents($myfile,str_replace('OOO',$o1->callbackoperator_id,file_get_contents($myfile)));
        file_put_contents($myfile,str_replace('SUCCC',$o1->callbacksuccess_value,file_get_contents($myfile)));
        file_put_contents($myfile,str_replace('FADDD',$o1->callbackfailed_value,file_get_contents($myfile)));
        file_put_contents($myfile,str_replace('$_METHOD','$_'.$o1->callbackmethod,file_get_contents($myfile)));
        file_put_contents($myfile,str_replace('remark_api',$o1->callbackremark,file_get_contents($myfile)));
	}

	header("location:apis.php?msgid=3");
}

include "html/includes/header.php";
include "html/api_details.php";
include "html/includes/footer.php";
include "js/api_details.js";
?>