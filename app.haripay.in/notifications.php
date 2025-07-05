<?php

session_start();

include "include.php";
include "session.php";

$ajax_logout = 1;

if($updte == 1){
    $sql = "Select count(notification_id) as notifications from notifications where user_id = ".$o->user_id." and is_active = 1 and is_read = 'No'";
    $res = getXbyY($sql);
    
    $result['notifications'] = $res[0]['notifications'];
    $result['amount_balance'] = $o->amount_balance;
}

echo json_encode($result);
?>

