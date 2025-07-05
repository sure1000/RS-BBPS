<?php 
require_once '../include/db.php';
//echo '<pre>'; print_r($_POST);

foreach($_POST as $k=>$v) $data[$k] = $v;
$data['user_id'] =$_SESSION['user_id'];
/*if ($_SESSION['user_type'] == "Master Distributor" ) {
	$data['user_type'] = 'Distributor';
}
if ($_SESSION['user_type'] == "Distributor" ) {
	$data['user_type'] = 'Retailer';
}*/
if($_SESSION['user_type']=='Distributor'){
  $data['user_type'] = 'Retailer';
 }
if($_SESSION['user_type']=='Master Distributor'){
  $data['user_type'] = 'Distributor';
 } else {
 $data['user_type'] = 'Retailer';
 }
$data['add_user_id'] =1;
$data['uname'] =UNAME;
$data['token'] =TOKEN;
$data['is_active'] ="Active";
//echo '<pre>'; print_r($data);die;
$parameters = http_build_query($data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, DOMAIN.'/apis/add_team.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
echo $json2 = curl_exec($ch);
curl_close($curl);
//echo '<pre>'; print_r($json2);die;
?>