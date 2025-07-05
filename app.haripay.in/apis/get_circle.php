<?php

include "include.php";

$sql = "Select * from service_circles where is_active = 1";
$res = getXbyY($sql);
$rows = count($res);
 
for ($i = 0; $i < $rows; $i++) {
    $results[$i]['circle_name'] = ucwords(strtolower($res[$i]['circle_name']));
}
 $result['circle_name'] = $results;
$result['error'] = "0";
$result['error_msg'] = "Fetch Circle";



echo json_encode($result);
?>