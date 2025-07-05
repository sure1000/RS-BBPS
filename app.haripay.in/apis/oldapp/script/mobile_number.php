<?php 
require_once '../include/db.php';
 $mobile = trim($_POST['mobile']);	
	$data['uname'] = UNAME;
	$data['token'] = TOKEN;
	$data['service'] = "Prepaid";
	$data['mobile'] = $mobile;
	$data['user_id'] = $_SESSION['user_id'];
    $parameters = http_build_query($data);
	
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, DOMAIN.'/apis/mobile_number.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        $json = curl_exec($ch);
		curl_close($curl);
		echo $json;
?>