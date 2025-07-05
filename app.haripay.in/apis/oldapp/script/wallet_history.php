<?php 
require_once '../include/db.php';
$mobile = trim($_POST['mobile']);
$transaction_type = trim($_POST['transaction_type']);
if(isset($_POST['date_from']) && $_POST['date_from'])
	$date_from = date('Y-m-d', strtotime(trim($_POST['date_from'])));
if(isset($_POST['date_to']) && $_POST['date_to']) 
	$date_to = date('Y-m-d', strtotime(trim($_POST['date_to'])));
if(!$date_from) $date_from = date('Y-m-d');;
if(!$date_to) $date_to = date('Y-m-d');;
		
	
		
	$data['uname'] = UNAME;
	$data['token'] = TOKEN;
	$data['ref_number'] = $mobile;
	$data['transaction_type'] = $transaction_type;
	$data['from_date'] = $date_from;
	$data['to_date'] = $date_to;
	$data['user_id'] = $_SESSION['user_id'];
    $parameters = http_build_query($data);
	
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, DOMAIN.'/apis/fund_received.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
        $json = curl_exec($ch);
		curl_close($curl);
		echo $json;
?>