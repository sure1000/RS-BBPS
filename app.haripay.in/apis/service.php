<?php

include "include.php";



$sql = "Select service_id, service_name from services where is_active = 1 order by service_name";
$res = getXbyY($sql);
$rows = count($res);

for ($i = 0; $i < $rows; $i++) {

    $results[$i]['service_id'] = ucwords(strtolower($res[$i]['service_id']));
    $results[$i]['name'] = ucwords(strtolower($res[$i]['service_name']));
}
$result['services'] = $results;
$result['error'] = "0";
$result['error_msg'] = "Fetch Services";



echo json_encode($result);
?>