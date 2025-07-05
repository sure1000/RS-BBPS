<?php 
require_once '../include/db.php';
$operator = array('13'=>'Dishtv','12'=>'Airteldth','16'=>'TataSky','17'=>'Videocon','15'=>'SunDirect');
$data['user_id'] = $_SESSION['user_id'];
$data['operator'] = $operator[$_POST['opertor']];
$data['uname'] =UNAME;
$data['token'] =TOKEN;
$parameters = http_build_query($data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, DOMAIN.'/apis/plans_dth.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
echo $json = curl_exec($ch);
curl_close($curl);
?>