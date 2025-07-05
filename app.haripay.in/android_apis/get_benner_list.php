<?php

include "include.php";

$service_id = 4;

if ($service_id > 0) {

    $sql = "Select banner_pic from benner_set where is_active='1' ORDER BY `benner_set_id` DESC LIMIT 3";
    $res = getXbyY($sql);
    $rows = count($res);

    for ($i = 0; $i < $rows; $i++) {

        $results[$i]['banner_pic'] = 'https://'.$_SERVER['HTTP_HOST']."/banner_pic/".$res[$i]['banner_pic'];
    }
    $result['banner_pic'] = $results;
    $result['error'] = "0";
    $result['error_msg'] = "Fetch banner_pic";
}else {
    $result['error'] = "1";
    $result['error_msg'] = "No Data found.";
}


echo json_encode($result);
?>