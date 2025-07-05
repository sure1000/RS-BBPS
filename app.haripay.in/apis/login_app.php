<?php

include "include.php";


if ($_POST['mobile'] != "") {

    $o->mobile = $_POST['mobile'];
    $o->password = cpassword($_POST['password']);
    $sql_check = "Select user_id from users where (mobile = '" . $o->mobile . "' or mobile = '" . $o->mobile . "') and password = '" . $o->password . "' AND mobile_verified = 'Yes' AND
	email_verified = 'Yes' AND user_id!=1 AND is_active = 1";
    $res_check = getXbyY($sql_check);
	//$_POST); die;
    $row_check = count($res_check);
    if ($row_check == 1) {
        $o = $factory->get_object($res_check[0]['user_id'], "users", "user_id");
//        $o->otp = rand(5000, 9999);
//        $user_name = $o->name;
//        $user_type = strtolower($o->user_type);
//        $user_type = explode(" ", $user_type);
//        $count_user_type = count($user_type);
//        if ($count_user_type == "1") {
//            $sms_type = $user_type[0];
//        } else {
//            $sms_type = $user_type[0] . "_" . $user_type[1];
//        }
//        $sql_sms = "Select * from sms_settings where is_active='1' and category='OTP' and " . $sms_type . " ='Yes' ";
//        $res_sms = getXbyY($sql_sms);
//        $row_sms = count($res_sms);
//        if ($row_sms > 0) {
//            $otp = $o->otp;
//            $mobile = $o->mobile;
//            $find_array = ["{MobileNo}", "{name}", "{Password}", "{Pin}", " {FromUserId}", "{ToUserId}", "{Amount}", "{CurrentBalance}", "{Reason}", "{TransactionId}", "{OperatorName}", "{OperatorId}", "{OTP}", "{Date}", "{Time}", "{company_name}", "&nbsp;"];
//            $replace_array = [$mobile, $user_name, $password, $pin, $from_user_id, $to_user_id, $amount, $current_balance, $reason, $transaction_id, $operator_name, $operator_id, $otp, $date, $time, $company_name, " "];
//            $mobile_message = str_ireplace($find_array, $replace_array, $res_sms[0]['content']);
//            sendsms_3gsolutions($o->mobile, $mobile_message);
//        }
        // sendsms_3gsolutions($o->mobile, " Your OTP verification code for Neope is  " . $o->otp);

     //   sendmail($email_from, $o->email, "OTP Email for Neope", "Your OTP verification code for Neope is  " . $o->otp);
        $result['error'] = "0";
       // $result['error_msg'] = "Please enter your verification OTP. ";
       $result['error_msg'] = "Perfect Match. Taking you to Dashboard ";

        $o->user_id = $updater->update_object($o, "users");
        $o1->login_status = "Success";
        $result['user_id'] = $o->user_id;
        $result['parent_id'] = $o->parent_id;
        $result['user_type'] = $o->user_type;
    } else {

        $o1->login_status = "Failed";
        $result['error'] = "1";
        $result['error_msg'] = "Mobile Number does not match. Please try again";
    }

    $o1->user_id = $o->mobile;
    $o1->login_password = $_POST['password'];
    $o1->ip_address = $_POST['ip_address'];
    $o1->imei_no = $_POST['imei_no'];
    $o1->model_no = $_POST['model_no'];
    $o1->latitude = $_POST['latitude'];
    $o1->longitude = $_POST['longitude'];
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


echo json_encode($result);
?>