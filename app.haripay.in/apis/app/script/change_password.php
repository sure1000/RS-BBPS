<?php 
require_once '../include/db.php';
//echo '<pre>'; $_POST;
$oldp = trim($_POST['oldp']);
$oldn = trim($_POST['oldn']);   
$oldc = trim($_POST['oldc']); 
    $data['uname'] = UNAME;
	$data['token'] = TOKEN;
	$data['old_password'] = $oldp;
	$data['new_password'] = $oldn;
	$data['confirm_password'] = $oldc;
	$data['change_passowrd_updte'] = 1;
	$data['user_id'] = $_SESSION['user_id'];
    $parameters = http_build_query($data);
	
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, DOMAIN.'/apis/change_password.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        $json = curl_exec($ch);
		curl_close($curl);
		echo $json;
?>