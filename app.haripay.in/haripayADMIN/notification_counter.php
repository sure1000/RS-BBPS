<?php

session_start();

include "include.php";
include "session.php";

$ajax_logout = 1;

if($updte == 1){
    
    $sql = "select COUNT(dispute_id) AS disputes FROM disputes WHERE is_active = 2 ";
    $res = getXbyY($sql);
    $row= count($res);
    $result['disputes'] = $res[0]['disputes'];
    
    $sql = "Select count(notification_id) as notification from notifications where user_id = ".$o->user_id;
    $res = getXbyY($sql);
    $row= count($res);
    $result['notification'] = $res[0]['notification'];
}

echo json_encode($result);
?>

