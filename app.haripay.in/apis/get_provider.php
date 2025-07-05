<?php

include "include.php";



$service_id = $_POST['recharge_service'];
$circle_id = $_POST['service_circle'];

if ($service_id > 0) {

    $sql = "Select provider_id, provider from providers where service_id = " . $service_id . " and is_active=1 order by provider";
    $res = getXbyY($sql);
    $rows = count($res);

    for ($i = 0; $i < $rows; $i++) {

        $results[$i]['provider_id'] = ucwords(strtolower($res[$i]['provider_id']));
        $results[$i]['name'] = ucwords(strtolower($res[$i]['provider']));
    }
    $result['providers'] = $results;
    $result['error'] = "0";
    $result['error_msg'] = "Fetch Provider";
} else if($circle_id !=""){
    $sql = "Select provider_id, provider from providers where state = '" . $circle_id . "' order by provider";
    $res = getXbyY($sql);
    $rows = count($res);
if($rows > 0){
    for ($i = 0; $i < $rows; $i++) {

        $results[$i]['provider_id'] = ucwords(strtolower($res[$i]['provider_id']));
        $results[$i]['name'] = ucwords(strtolower($res[$i]['provider']));
    }
    $result['providers'] = $results;
}else{
     $result['providers'] = [];
}
    
    $result['error'] = "0";
    $result['error_msg'] = "Fetch Provider";

}else {
    $result['error'] = "1";
    $result['error_msg'] = "No Data found.";
}


echo json_encode($result);
?>