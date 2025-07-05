<?php 
require_once '../include/db.php';
$mobile = trim($_POST['mobile']);
	$data['uname'] = UNAME;
	$data['token'] = TOKEN;
    $data['updte1'] =1;
    $data['forgot_email'] =$mobile;
$parameters = http_build_query($data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, DOMAIN.'/apis/forget_password.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
echo $json = curl_exec($ch);
curl_close($curl);
?>