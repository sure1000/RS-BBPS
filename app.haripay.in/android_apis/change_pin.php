<?php

include "include.php";
if (isset($o)) {
    $o = $factory->get_object($o->user_id, "users", "user_id");
//pt($o);

    $old_pin = $_POST['old_pin'];
    $new_pin = $_POST['new_pin'];


    $sql = "Select user_id from users where user_id = '" . $o->user_id . "'  and  kyc_id='" . $old_pin . "' and is_active = 1";
    $res = getXbyY($sql);
    $row = count($res);

    if ($row == 1) {
        $o1 = $factory->get_object($res[0]['user_id'], "users", 'user_id');
        $o1->kyc_id = $new_pin;
        $o1->user_id = $updater->update_object($o1, "users");
        $results['error_msg'] = "PIN Changed Successfully";
        $results['error'] = "0";
    } else {
        $results['error_msg'] = "Invalid Old PIN";
        $results['error'] = "1";
    }
} else {
    $results['error_msg'] = "Something went wrong please try again";
    $results['error'] = "1";
}



echo json_encode($results);
?>