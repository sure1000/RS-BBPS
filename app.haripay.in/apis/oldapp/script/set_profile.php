<?php 
require_once '../include/db.php';
$ar = $_POST;
$data['user_id'] =$_SESSION['user_id'];
$data['name'] =$ar['name'];
$data['email'] =$ar['email'];
$data['mobile'] =$ar['mobile'];
$data['user_address'] =$ar['user_address'];
$data['company_name'] =$ar['company_name'];
$data['gst_no'] =$ar['gst_no'];
$data['pancard'] =$ar['pancard'];
$data['adhaar_card'] =$ar['adhaar_card'];
$data['uname'] =UNAME;
$data['token'] =TOKEN;
$parameters = http_build_query($data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, DOMAIN.'/apis/update_profile.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
echo $json2 = curl_exec($ch);
curl_close($curl);
?>