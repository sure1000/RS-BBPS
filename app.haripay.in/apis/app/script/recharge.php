<?php 
require_once '../include/db.php';
$amount = trim($_POST['amount']);
$opertor = trim($_POST['opertor']);
 $circle = trim($_POST['circle']);
 $number = trim($_POST['number']);
 $service = trim($_POST['service']);
 $pin = trim($_POST['pin']);

		
	$data['uname'] = UNAME;
	$data['token'] = TOKEN;
	$data['service_type'] = $service;
	$data['amount'] = $amount;
	$data['provider'] = $opertor;
	$data['circle'] = $circle;
	$data['pin'] = $pin;
	$data['number'] = $number;
	$data['user_id'] = $_SESSION['user_id'];
    $parameters = http_build_query($data);
	
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, DOMAIN.'/apis/recharge.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        $json = curl_exec($ch);
		curl_close($curl);
		echo $json;
?>