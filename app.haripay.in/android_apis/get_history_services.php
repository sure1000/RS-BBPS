<?php
include "include.php";
$sql = "Select service_id, service_name from services where is_active = 1 order by service_name";
$res = getXbyY($sql);
$rows = count($res);

for ($i = 0; $i < $rows; $i++) {
if($res[$i]['service_name'] =='Prepaid' || $res[$i]['service_name'] == 'Postpaid' || $res[$i]['service_name'] == 'Electricity' || $res[$i]['service_name'] == 'Gas'  || $res[$i]['service_name'] == 'Landline' || $res[$i]['service_name'] == 'DTH' || $res[$i]['service_name'] == 'Water'){
    $results['service_id'] = ucwords(strtolower($res[$i]['service_id']));
    $results['name'] = ucwords(strtolower($res[$i]['service_name']));
    $service[] = $results;
}

}

$result['services'] = $service;
$result['error'] = "0";
$result['error_msg'] = "Fetch Services";



echo json_encode($result);
?>