<?php
include "include.php";
$result['error'] = 1;
$result['error_msg'] = "Invalid Parameters";
$result['ip'] = $_SERVER['REMOTE_ADDR'];
if(empty($_POST)){
	$result['error_msg'] = "GET Request is not supported further.";
	echo json_encode($result);
	die();
} 
//pt($_POST);
setXbyY("INSERT into api_logs (data,order_id) VALUES ('".serialize($_POST)."','".$_POST['order_id']."')");
if (isset($_POST['uname']) && isset($_POST['api_token']) && isset($_POST['BiometricData']) && isset($_POST['order_id']) && isset($_POST['latitude'])
	&& isset($_POST['longitude']) && isset($_POST['type']) && isset($_POST['amount']) && isset($_POST['deviceIMEI']) && isset($_POST['aadhar']) && isset($_POST['bank_code'])) {
	$uname = $_POST['uname'];
	$api_token = $_POST['api_token'];
	$BiometricData = $_POST['BiometricData'];
	$order_id = $_POST['order_id'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	$type = $_POST['type'];
	$amount = $_POST['amount'];
	$deviceIMEI = $_POST['deviceIMEI'];
	$aadhar = $_POST['aadhar'];
	$bank_code = $_POST['bank_code'];
} else {
	echo json_encode($result);
	die();
}

if ($uname == "" || $api_token == "" || $BiometricData == "" || $order_id == "" || $latitude == "" || $longitude == "" || $type == "" || $amount == "" || $deviceIMEI == "" || $aadhar == "" || $bank_code == "") {
	echo json_encode($result);
	die();
}
$ip_address = $_SERVER['REMOTE_ADDR'];
 $sql_user = "Select user_id from users where user_name = '" . $uname . "' and is_active = 1";
$res_user = getXbyY($sql_user);
$row_users = count($res_user);
if ($row_users == 1) {
	 $o = $factory->get_object($res_user[0]['user_id'], "users", "user_id");
	$sql_auth = "Select * from api_ip_key where user_id = " . $o->user_id . " and ip_address = '" . $ip_address . "' and authorization_key = '" . $api_token . "' and is_active = 1";
	$res_auth = getXbyY($sql_auth);
	$row_auth = count($res_auth);
	//pt($sql_auth);
	if ($row_auth == 1) {
		$result = apes_balance($_POST,$o->user_id);
       
} else {
	echo json_encode($result);
	die();
}
}


echo json_encode($result);
?>