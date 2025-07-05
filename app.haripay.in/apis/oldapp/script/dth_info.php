<?php 
require_once '../include/db.php';
$data['user_id'] = $_SESSION['user_id'];
$data['mobile'] = $_POST['mobile'];
$data['provider'] = $_POST['provider'];
$data['roffer_updte'] = 1;
//$data['service'] = '4';
$data['uname'] =UNAME;
$data['token'] =TOKEN;
$parameters = http_build_query($data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, DOMAIN.'/apis/dth_info.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
echo $json2 = curl_exec($ch);
curl_close($curl);
?>