<?php 
require_once '../include/db.php';
array_walk($_POST,'trim');
$data['user_id'] =$_SESSION['user_id'];
$data['ref_number'] = $_POST['remark'];
//$data['bank_id'] = 1;
$data['request_money'] = $_POST['request_money'];
$data['account'] = $_POST['bank_list'];
$data['payment_mode'] = $_POST['payment_mode'];
$data['uname'] =UNAME;
$data['token'] =TOKEN;

$parameters = http_build_query($data);
	//echo print_r($_POST);die();
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, DOMAIN.'/apis/request_money.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
echo $json = curl_exec($ch);
curl_close($curl);
?>