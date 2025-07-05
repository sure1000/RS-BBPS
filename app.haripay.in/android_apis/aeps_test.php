<?php
 $postData = $_POST['data'];
    $xml = simplexml_load_string($postData);
//$json = json_encode($xml);
//$array = json_decode($json,TRUE);

/*$Data = $xml->Data;
$data_type = $xml->Data['type'][0];
$Hmac = $xml->Hmac;
$Skey_data = $xml->Skey;
$Skey_ci = $xml->Skey['ci'][0];
$errCode = $xml->Resp['errCode'][0];
$errInfo = $xml->Resp['errInfo'][0];
$fCount = $xml->Resp['fCount'][0];
$fType = $xml->Resp['fType'][0];
$nmPoints = $xml->Resp['nmPoints'][0];
$qScore = $xml->Resp['qScore'][0];
//device info data
$dc = $xml->DeviceInfo['dc'][0];
$dpId = $xml->DeviceInfo['dpId'][0];
$mc = $xml->DeviceInfo['mc'][0];
$mi = $xml->DeviceInfo['mi'][0];
$rdsId = $xml->DeviceInfo['rdsId'][0];
$rdsVer = $xml->DeviceInfo['rdsVer'][0];
$srno = $xml->DeviceInfo->additional_info->Param[0]['value'];
$sysid = $xml->DeviceInfo->additional_info->Param[1]['value'];
$ts = $xml->DeviceInfo->additional_info->Param[2]['value'];
*/
$_POST['Data'] = (String) $xml->Data;
$_POST['data_type'] = (String) $xml->Data['type'][0];
$_POST['Hmac'] = (String) $xml->Hmac;
$_POST['Skey_data'] = (String) $xml->Skey;
$_POST['Skey_ci'] = (String) $xml->Skey['ci'][0];
$_POST['errCode'] = (String) $xml->Resp['errCode'][0];
$_POST['errInfo'] = (String) $xml->Resp['errInfo'][0];
$_POST['fCount'] = (String) $xml->Resp['fCount'][0];
$_POST['fType'] = (String) $xml->Resp['fType'][0];
$_POST['nmPoints'] = (String) $xml->Resp['nmPoints'][0];
$_POST['qScore'] = (String) $xml->Resp['qScore'][0];
//device info data
$_POST['dc'] = (String) $xml->DeviceInfo['dc'][0];
$_POST['dpId'] = (String) $xml->DeviceInfo['dpId'][0];
$_POST['mc'] = (String) $xml->DeviceInfo['mc'][0];
$_POST['mi'] = (String) $xml->DeviceInfo['mi'][0];
$_POST['rdsId'] = (String) $xml->DeviceInfo['rdsId'][0];
$_POST['rdsVer'] = (String) $xml->DeviceInfo['rdsVer'][0];
$_POST['srno'] = (String) $xml->DeviceInfo->additional_info->Param[0]['value'];
$_POST['sysid'] = (String) $xml->DeviceInfo->additional_info->Param[1]['value'];
$_POST['ts'] = (String) $xml->DeviceInfo->additional_info->Param[2]['value'];
writeMsg($_POST); // call the function
//echo $ts;
//echo print_r($additional_info);
function writeMsg($ts) {
  echo "<pre>";print_r($ts);die;
}
?>