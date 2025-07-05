<?php

include "include.php";

if ($_POST['otp'] > 0) {

    $o->otp = $_POST['otp'];
    $o->mobile = $_POST['mobile'];
    $o1->user_history_id = $_POST['user_history_id'];
    if ($o1->user_history_id > 0) {
        $o1 = $factory->get_factory($o1->user_history_id, "user_history", "user_history_id");
    }
    $sql_user = "Select user_id from users where otp = '" . $o->otp . "' and mobile ='" . $o->mobile . "'";
    $res_user = getXbyY($sql_user);
    $rows_user = count($res_user);

    if ($rows_user == 1) {
        $o = $factory->get_factory($res_user[0]['user_id'], "users", "user_id");

        $o->last_login = todaysDate();
        if ($o->profile_pic == "") {
            $my_profile_pic = "./img/avatar.svg";
        } else {
            $my_profile_pic = "./profile_picture/thumbs/" . $o->profile_pic;
        }
        $result['user_id'] = $o->user_id;
        $result['dealer_code'] = $o->user_name;
        $result['user_name'] = $o->name;
        $result['email'] = $o->email;
        $result['amount_balance'] = $o->amount_balance;
        $result['user_type'] = $o->user_type;
        $result['last_login'] = $o->last_login;
        $result['my_profile_pic'] = $my_profile_pic;
        $o1->login_status = "Success";
        $o1->login_password = $o->otp;
        $o = $updater->update_object($o, "users");
        $o1 = $updater->update_object($o1, "user_history");
        $result['user_history_id'] = "0";

        $result['error'] = "0";
        $result['error_msg'] = "Perfect Match. Taking you to Dashboard";
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "Username &  OTP mismatch";
        if ($o1->login_status == "Success") {
            $o1->login_status = "Failed";
            $o1->user_history_id = $updater->update_object($o1, "user_history");
            $result['user_history_id'] = (string) $o1->user_history_id;
        } else {
            $o1->login_status = "Success";
            $o1->user_id = $o->mobile;
            $o1->login_password = $o->otp;
            $o1->ip_address = '0';
            $o1->imei_no = $o1->imei_no;
            $o1->model_no = $o1->model_no;
            $o1->latitude = $o1->latitude;
            $o1->longitude = $o1->longitude;
            $sql_login = "SELECT * FROM user_history WHERE user_id='" . $o1->user_id . "' ORDER BY current_login DESC limit 0,1";
            $res_login = getXbyY($sql_login);
            $row_login = count($res_login);

            if ($row_login > 0) {
                $o1->last_login = $res_login[0]['current_login'];
            } else {
                $o1->last_login = todaysDate();
            }
            $o1->login_type = "App";
            $o1->current_login = todaysDate();
            $o1->user_history_id = $insertor->insert_object($o1, "user_history");
            $result['user_history_id'] = (string) $o1->user_history_id;
        }
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong. Please try again.";
}


echo json_encode($result);
?>