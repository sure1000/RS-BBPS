<?php 
require_once '../include/db.php';
$username = trim($_POST['username']);
$password = trim($_POST['password']);
 $rem_me = trim($_POST['rem_me']);
 
	$data['uname'] = UNAME;
	$data['token'] = TOKEN;
	$data['imei_no'] = trim('1225252');
	$data['model_no'] = trim('fgghfgfg');
	$data['latitude'] = trim('0.00');
	$data['longitude'] = trim('0.00');
	$data['ip_address'] = $_SERVER['REMOTE_ADDR'];
	$data['password'] = $password;
    $data['mobile'] =$username;
    $parameters = http_build_query($data);
	
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, DOMAIN.'/apis/login_app.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        $json = curl_exec($ch);
		curl_close($curl);
		$data2 = json_decode($json,TRUE);
		if($data2['error']==0){
			$_SESSION['user_id'] = $data2['user_id'];
			$_SESSION['user_type'] = $data2['user_type'];
			$_SESSION['parent_id'] = $data2['parent_id'];
			if($rem_me){
				setcookie('username',$username,0,'/');
				setcookie('password',$password,0,'/');
				setcookie('rem_me',1,0,'/');
			} else {
				setcookie('username',0,-1,'/');
				setcookie('password',0,-1,'/');
				setcookie('rem_me',0,-1,'/');
			}
		}
		echo $json;
?>