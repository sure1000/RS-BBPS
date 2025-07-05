<?php

session_start();
include "include.php";

if ($_POST['updte6'] == 1) {

    $o->email_otp = $_POST['email_otp'];
    $o->mobile_otp = $_POST['mobile_otp'];
    $o->user_id = $_POST['verify_user_id'];

    $sql = "Select user_id from users where email_otp = '" . $o->email_otp . "' and mobile_otp = '" . $o->mobile_otp . "' and user_id ='" . $o->user_id . "'";
    $res = getXbyY($sql);
    $rows = count($res);

    if ($rows == 1) {
        $o = $factory->get_factory($res[0]['user_id'], "users", "user_id");
        $o->mobile_verified = "Yes";
        $user_type = $o->user_type;
        $o->email_verified = "Yes";
        $password = substr(md5(rand(1000, 10000)), 0, 8);
        $o->password = cpassword($password);
        $o->otp_email = rand(5000, 9999);
        $o->otp_mobile = rand(5000, 9999);
        $o->is_active = 1;
        $o->last_login = todaysDate();
        $_SESSION['user_id'] = $o->user_id;
        $_SESSION['user_name'] = $o->user_name;
        $_SESSION['last_login'] = $o->last_login;
        if ($o->user_type == "Whitelabel User" ){
          $_SESSION['w_id'] = $o->user_id;
        }
        else{
          $_SESSION['user_id'] = $o->user_id;
        }
        $_SESSION['user_name'] = $o->user_name;
        $_SESSION['last_login'] = $o->last_login;
        $email_subject = $res_site[0]['site_name'] . " Account is active now.";

        include "mails/verify_otp.php";
        sendmail($email_from, $o->email, $email_subject, $email_message);
        sendmail($email_from, $res_site[0]['email'], "New user Register From WEB", "Details : " . $email_message);
        $o = $updater->update_object($o, "users");

        $message = "Congratulations! Your Account on is active now. Username: " . $o->mobile . " or " . $o->email . " and password is: " . $password."User Pin is:".$o->kyc_id;

        sendsms_payzoom($o->mobile, $message);

        $result['user_type'] = $user_type;
        $result['error'] = 0;
        $result['error_msg'] = "Account Verified.";
    } else {
        $result['error'] = 1;
        $result['error_msg'] = "Email & Mobile OTP mismatch";
    }
}

echo json_encode($result);
?>
