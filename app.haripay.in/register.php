<?php

session_start();
include "include.php";

if ($_POST['updte5'] == 1) {

    $o->company_name = $_POST['reg_shop_name'];
    $o->pancard = $_POST['reg_pan_no'];
    $o->email = $_POST['reg_email'];
    $o->mobile = $_POST['reg_mobile'];
    $o->mobile_1 = $_POST['reg_mobile'];
    $o->user_type = $_POST['user_type'];
    $o->parent_id = '0';
    $o->plan_id = '2';
    $o->user_name = create_username($o->user_type);
    $o->name = $_POST['reg_shop_name'];
    $o->gender = 'Male';
    $o->dob = "0000-00-00";
    $password = substr(md5(rand(1000, 10000)), 0, 8);
    $o->password = cpassword($password);
    $o->otp = rand(5000, 9999);
    $o->email_otp = rand(5000, 9999);
    $o->mobile_otp = rand(5000, 9999);
    $o->login_ip = $_SERVER['REMOTE_ADDR'];
    $o->last_login = todaysDate();
    $o->created_at = todaysDate();
    $o->pincode = '0';
    $o->district = '0';
    $o->state = '0';
    $o->user_address = '0';
    $o->amount_balance = '0';
    $o->credit_amount = '0';
    $o->credit_limit = '0';
    $o->profile_pic = '0';
    $o->kyc_id=rand(5000, 9999);
    $o->gst_no = '0';
    $o->adhaar_card = '0';
    $o->company_type = '0';
    $o->approved_by = '0';
    $o->mobile_verified = 'No';
    $o->email_verified = 'No';
    $o->route = '0';
    $o->commission = '0';
    $o->uuid = '0';
    $o->is_active = '0';
    $o->force_logout = '0';
    $o->kyc_date = date("Y-m-d", mktime(0, 0, 0, date("m") + 1, date("d"), date("y")));

    $sql_check = "Select user_id , mobile_verified , email_verified  from users where email = '" . $o->email . "' or mobile = '" . $o->mobile . "' ";
    $res_check = getXbyY($sql_check);
    $row_check = count($res_check);
    // pt($res_check);

    if ($row_check == 0) {
        $mobile_message = "OTP To Verify your Account on " . $res_site[0]['site_name'] . " is " . $o->mobile_otp . ". If this was not from you, there someone is trying to register your Email / Mobile No on " . $res_site[0]['site_name'];
        sendsms_payzoom($o->mobile, $mobile_message);

        $email_subject = "OTP to Verify Your Account on " . $res_site[0]['site_name'];

        include "mails/register.php";
        sendmail($email_from, $o->email, $email_subject, $email_message);

        $o->user_id = $insertor->insert_object($o, "users");

        $result['verify_user_id'] = $o->user_id;

        $result['error'] = 0;
        $result['error_msg'] = "Congratulations! Your Account has been created Successfully. Please Verify your email and Mobile for using it";
    } else {
        if ($row_check == 2) {
            $result['error'] = 1;
            $result['error_msg'] = "Email / Mobile is  Associated to another Account. Please Try another";
        } elseif ($row_check == 1) {

            if ($res_check[0]['mobile_verified'] == 'Yes' || $res_check[0]['email_verified'] == 'Yes') {

                $result['error'] = 1;
                $result['error_msg'] = "Email / Mobile already Taken. Please try another";
            } else {

                $sql = "Select * from users where email='" . $o->email . "' OR mobile='" . $o->mobile . "' AND user_id !='" . $res_check[0]['user_id'] . "' and is_active='1' ";
                $res = getXbyY($sql);
                $row = count($res);
                if ($row == 1) {
                    $result['error'] = 1;
                    $result['error_msg'] = "Email / Mobile is  Associated to another Account. Please Try another";
                } else {
                    $o = $factory->get_factory($res_check[0]['user_id'], "users", "user_id");

                    $o->email_otp = rand(5000, 9999);
                    $o->mobile_otp = rand(5000, 9999);
                    $mobile_message = "OTP To Mobile Verify your Account on " . $res_site[0]['site_name'] . " is " . $o->mobile_otp . ". If this was not from you, there someone is trying to register your Email / Mobile No on " . $res_site[0]['site_name'];
                    sendsms_payzoom($o->mobile, $mobile_message);
                    //mobile_otp($o->mobile, " Mobile: " . $o->mobile_otp);
                    $e_message = "OTP To Email Verify your Account on " . $res_site[0]['site_name'] . " is " . $o->email_otp . ". If this was not from you, there someone is trying to register your Email / Mobile No on " . $res_site[0]['site_name'];

                    sendmail($email_from, $o->email, "OTP Email for ShibaTechnology", $e_message);

                    $o = $updater->update_object($o, "users");
                    $result['verify_user_id'] = $res_check[0]['user_id'];
                    $result['error'] = 0;
                    $result['error_msg'] = "Congratulations! Your Account has been created Successfully. Please Verify your email and Mobile for using it";
                }
            }
        }
    }
}

echo json_encode($result);
?>