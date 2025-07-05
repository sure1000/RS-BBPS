<?php 
require_once '../include/db.php';
$data['user_id'] = $_SESSION['user_id'];
$data['number'] = $_POST['number'];
$data['uname'] =UNAME;
$data['token'] =TOKEN;
$parameters = http_build_query($data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, DOMAIN.'/apis/dth_operator.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
echo $json2 = curl_exec($ch);
curl_close($curl);
?>