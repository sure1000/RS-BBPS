<?php

include "include.php";


if ($_POST['dmt_login_updte'] == "1") {
    $o1->customer_mobile = $_POST['dmt_mobile'];
    $results = ep_pay_login($o1->customer_mobile);
    if ($results['data']['error'] == "0") {
        $result['dmt_mobile'] = $results['data']['mobile'];
        $result['error'] = "0";
        $result['error_msg'] = $results['data']['error_msg'];
    } else if ($results['data']['error'] == "3") {
        $result['dmt_mobile'] = $results['data']['mobile'];
        $result['error'] = "3";
        $result['error_msg'] = $results['data']['error_msg'];
    } else if ($results['data']['error'] == "2") {
        $result['dmt_mobile'] = $results['data']['mobile'];
        $result['error'] = "2";
        $result['error_msg'] = $results['data']['error_msg'];
    } else {
        $result['error'] = "1";
        $result['error_msg'] = $results['data']['error_msg'];
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>