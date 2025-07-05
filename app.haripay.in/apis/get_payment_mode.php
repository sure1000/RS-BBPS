<?php

include "include.php";
$user_id = $_POST['user_id'];

if ($user_id > 0) {



    $sql = "Select * from payment_mode where is_active = 1 order by payment_mode";
    $res = getXbyY($sql);
    $rows = count($res);

    $sstring = "";
    for ($i = 0; $i < $rows; $i++) {
        $results[$i]['name'] = (string)$res[$i]['payment_mode'];
    }

    $result['payment_mode'] = $results;
    $result['error'] = "0";
    $result['error_msg'] = "Fetch Payment Mode";
} else {
    $result['error'] = "1";
    $result['error_msg'] = "No Data found.";
}


echo json_encode($result);
?>