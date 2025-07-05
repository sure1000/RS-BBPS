<?php

include "include.php";

$service_id = 4;

if ($service_id > 0) {

    $sql = "Select app_id, app_name from upi_option_app where status='1'";
    $res = getXbyY($sql);
    $rows = count($res);

    for ($i = 0; $i < $rows; $i++) {

        $results[$i]['app_id'] = $res[$i]['app_id'];
        $results[$i]['app_name'] = $res[$i]['app_name'];
    }
    $result['upi'] = $results;
    $result['error'] = "0";
    $result['error_msg'] = "Fetch upi options";
}else {
    $result['error'] = "1";
    $result['error_msg'] = "No Data found.";
}


echo json_encode($result);
?>