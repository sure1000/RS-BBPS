<?php

session_start();
include "include.php";
include "session.php";

$id = $_POST['id'];

if ($id > 0) {
    $sql = "select * from users where user_id='" . $id . "' and is_active = 1";
    $res = getXbyY($sql);
    $row = count($res);

    if ($row > 0) {
        $result['name'] = $res[0]['name'];
        $result['username'] = $res[0]['user_name'];
        $result['mobile'] = $res[0]['mobile'];
        $result['email'] = $res[0]['email'];
        $result['balanceamount'] = $res[0]['amount_balance'];

        $result['error'] = '1';
    } else {
        $result['error'] = '0';
        $result['error_msg'] = "Data Not Found";
    }
} else {
    $result['error'] = '0';
    $result['error_msg'] = "something went wrong";
}

echo json_encode($result);
?>