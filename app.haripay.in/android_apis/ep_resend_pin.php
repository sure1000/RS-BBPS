<?php


include "include.php";



if ($_POST['dmt_pinmobile'] > 0) {

    $o1->mobile = $_POST['dmt_pinmobile'];
    $results = ep_resend_pin($o1);

    if ($results['error'] == '0') {

        $result['error'] = "0";
        $result['error_msg'] = $results['data']['error_msg'];
    } else {
        $result['dmt_mobile'] = $results['data']['mobile'];
        $result['error'] = "1";
        $result['error_msg'] = $results['data']['error_msg'];
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>