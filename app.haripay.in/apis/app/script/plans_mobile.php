<?php 
require_once '../include/db.php';
$data['user_id'] = $_SESSION['user_id'];
$data['operator'] = $_POST['opertor'];
$data['circle'] = $_POST['circle'];
$data['uname'] =UNAME;
$data['token'] =TOKEN;
$parameters = http_build_query($data);
	
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, DOMAIN.'/apis/plans_mobile.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
echo $json = curl_exec($ch);
curl_close($curl);
?>