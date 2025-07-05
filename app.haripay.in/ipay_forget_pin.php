<?php

session_start();

include "include.php";
include "session.php";
if ($_POST['updte'] == '1') {

    $o1->ipay_user_id = $_POST['ipay_user_id'];
    if ($o1->ipay_user_id > 0) {
        $o1 = $factory->get_object($o1->ipay_user_id, "ipay_user", "ipay_user_id");
        $o2 = $factory->get_object($o1->ipay_user_id, "ipay_user", "ipay_user_id");
        $api_response = ipay_forget_pin($o1);
        pt($api_response);
        if ($api_response['error'] == "0") {
            $result['error'] = "0";
            $result['error_msg'] = $api_response['message'];
        } else {
            $result['error'] = "1";
            $result['error_msg'] = $api_response['error_msg'];
        }
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "Something went wrong please try again";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>


