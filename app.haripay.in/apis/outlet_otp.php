<?php

include "include.php";
if (isset($_POST)) {
    $o->user_id = $_POST['user_id'];
    $o = $factory->get_object($o->user_id, "users", "user_id");
    if ($o->is_active == "1") {
if($o->route =='8' ){
$o1=$factory->get_object($o->route,"api","api_id");
$mobile =$o->mobile;
$api_result = create_outlet_otp($o1,$mobile);

if($api_result['error'] == "0"){
	
 if($api_result['data']['response']['status_code'] == 'RCS' && $api_result['data']['response']['OTP'] == 'N'  ){

 	if($api_result['data']['response']['BBPS'] == 'INACTIVE' || $api_result['data']['response']['BBPS'] == 'ACTIVE'){
    if($api_result['data']['response']['BBPS'] == 'INACTIVE'){
      $o->outlet_status ='Pending';
      $o->outlet_id =$api_result['data']['response']['OutletID'];
    }else if($api_result['data']['response']['BBPS'] == 'ACTIVE'){
      $o->outlet_status ='Verified';
      $o->outlet_id =$api_result['data']['response']['OutletID'];
    }
    $o= $updater->update_object($o, "users");
 		$result['error'] ='2';
 		 $result['error_msg']= "BBPS:".$api_result['data']['response']['BBPS']."OutletId:".$api_result['data']['response']['OutletID']."Otp:".$api_result['data']['response']['OTP'];
 	}

 }else if($api_result['data']['response']['OTP'] == 'Y' ){
  $result['mobile']=$api_result['mobile_number'];
$result['error']='0';
  $result['error_msg']= $api_result['error_msg'];

 }else{
 	$result['error']='0';
  $result['error_msg']= $api_result['error_msg'];
  $result['mobile']=$api_result['mobile_number'];
 }


 
}else{
  $result['error']='1';
  $result['error_msg'] = $api_result['error_msg'];
}


}else{
	
  $result['error']='1';
  $result['error_msg']="Something Went Wrong,Try Again";
}
} else {
        $results['error'] = "1";
        $results['error_msg'] = "User Blocked.";

        echo json_encode($result);
        die();
    }
} else {
    $results['error'] = "1";
    $results['error_msg'] = "Something went wrong please try again";
}

echo  json_encode($result);
?>