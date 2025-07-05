<?php 
require_once '../include/db.php';
$data['recharge_service'] = $_POST['recharge_service'];
//$data['service_circle'] =$_SESSION['user_id'];
$data['uname'] =UNAME;
$data['token'] =TOKEN;
$parameters = http_build_query($data);
	
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, DOMAIN.'/apis/get_provider.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
echo $json = curl_exec($ch);
curl_close($curl);

?>