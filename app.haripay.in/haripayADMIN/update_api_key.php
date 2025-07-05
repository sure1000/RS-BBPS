<?php

session_start();
include "include.php";
$ajax_logout = 1;
include "session.php";

if ($_POST['id'] > 0) {
    $api_id = $_POST['id'];

    $response = login_jri($api_id);


    if ($response['AuthenticationKey'] != "") {
        $o1 = $factory->get_object($api_id, "api", "api_id");

        $o1->api_key = $response['AuthenticationKey'];
        $o1->api_id = $updater->update_object($o1, "api");
        $result['error'] = 0;
        $result['error_msg'] = "Authentication Key Updated Successfully.";
    } else {
        $result['error'] = 1;
        $result['error_msg'] = $response['Status'];
    }
} else {
    $result['error'] = 1;
    $result['error_msg'] = "Something went wrong. Please try again";
}

echo json_encode($result);
?>