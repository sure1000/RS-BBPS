<?php

include "include.php";



if ($_POST['dmt_pin_updte'] == "1") {

    $o1->otp = $_POST['dmt_pin'];
    $o1->user_mobile = $_POST['dmt_verifymobile'];

    $results = ep_verify_user($o1);

    if ($results['data']['error'] == '0') {
        $sql = "Select paytm_user_id from paytm_user where mobileNo='" . $o1->user_mobile . "' and is_active ='2'";
        $res = getXbyY($sql);
        $row = count($res);
        if ($row == 1) {
            $o1 = $factory->get_object($res[0]['paytm_user_id'], "paytm_user", "paytm_user_id");
            $o1->updated_at = todaysDate();
            $o1->is_active = '1';
            $o1->status = 'Verified';
            $o1->paytm_user_id = $updater->update_object($o1, "paytm_user");
            $_SESSION['paytm_user_id'] = $o1->paytm_user_id;
            $result['error'] = '0';
            $result['error_msg'] = $results['data']['error_msg'];
        } else {

            $result['error'] = '1';
            $result['error_msg'] = "Something Went Wrong";
        }
    } else if ($results['data']['error'] == '2') {
        $result['error'] = '2';
        $result['user_mobile'] = $results['data']['mobile'];
        $result['error_msg'] = $results['data']['error_msg'];
    } else {
        $result['error'] = '1';
        $result['user_mobile'] = $results['data']['mobile'];
        $result['error_msg'] = $results['data']['error_msg'];
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>