<?php

include "include.php";



$o->company_name = $_POST['company'];
$o->pancard = $_POST['pan_card'];
$o->email = $_POST['email'];
$o->mobile = $_POST['mobile'];
$o->mobile_1 = $_POST['mobile'];
$o->user_type = 'Retailer';
//pt($_POST['company']);die;
$sql_chk = "Select user_id from users where is_active ='1' and user_type ='Distributor' and sign_up='Yes' order by user_id ASC limit 0,1";
$res_chk = getXbyY($sql_chk);
$row_chk = count($res_chk);

if ($row_chk > 0) {
    $did = $res_chk[0]['user_id'];
} else {
    $sql_chk = "Select user_id from users where is_active ='1' and user_type ='Distributor' order by user_id ASC  limit 0,1 ";
    $res_chk = getXbyY($sql_chk);
    $row_chk = count($res_chk);
    if ($row_chk > 0) {
        $did = $res_chk[0]['user_id'];
    }
}
$o->parent_id = $did;
$o->plan_id = '0';
$o->user_name = create_username($o->user_type);
$o->name = $_POST['company'];
$o->gender = 'Male';
$o->dob = todaysDate();
$password = substr(md5(rand(1000, 10000)), 0, 8);
$o->password = cpassword($password);
$o->otp = rand(5000, 9999);
$o->email_otp = rand(5000, 9999);
$o->mobile_otp = rand(5000, 9999);
$o->login_ip = $_SERVER['REMOTE_ADDR'];
$o->last_login = todaysDate();
$o->creation_date = todaysDate();
$o->pincode = '0';
$o->district = '0';
$o->state = '0';
$o->user_address = '0';
$o->amount_balance = '0';
$o->credit_amount = '0';
$o->credit_limit = '0';
$o->profile_pic = '0';
$o->kyc_id = '0';
$o->gst_no = '0';
$o->adhaar_card = '0';
$o->company_type = '0';
$o->approved_by = '0';
$o->mobile_verified = 'No';
$o->email_verified = 'No';
$o->route = '8';
$o->commission = '0';
$o->uuid = '0';
$o->is_active = '0';
$o->force_logout = '0';
$o->sign_up = 'No';
$o->kyc_date = todaysDate();
$o->kyc_modal = 'No';
$o->multi_api = 'No';
$o->otp_enabled = 'Yes';
$o->balance_low_time = 0;

$sql_check = "Select user_id , mobile_verified , email_verified  from users where email = '" . $o->email . "' or mobile = '" . $o->mobile . "' ";
$res_check = getXbyY($sql_check);
$row_check = count($res_check);
// pt($res_check);

if ($row_check == 0) {

    $user_type = strtolower($o->user_type);
    $user_type = explode(" ", $user_type);
    $count_user_type=count($user_type);
    if ($count_user_type =="1") {
        $sms_type=$user_type[0];
    }else{
        $sms_type = $user_type[0]."_".$user_type[1];
    }
    $sql_sms="Select * from sms_settings where is_active='1' and category='OTP' and ".$sms_type." ='Yes' ";
    $res_sms=getXbyY($sql_sms);
    $row_sms = count($res_sms);
    if ($row_sms >0) {
        $otp =  $o->mobile_otp;
        $mobile =$o->mobile;
        $name=$o->name;
        $find_array = ["{MobileNo}","{Name}" ,"{Password}", "{Pin}"," {FromUserId}", "{ToUserId}", "{Amount}", "{CurrentBalance}", "{Reason}","{TransactionId}","{OperatorName}","{OperatorId}","{OTP}","{Date}","{Time}", "{company_name}" , "&nbsp;" ];
        $replace_array = [$mobile ,$name,$password  ,$pin, $from_user_id , $to_user_id , $amount , $current_balance , $reason , $transaction_id , $operator_name , $operator_id , $otp , $date , $time , $company_name ," " ];
        $mobile_message =strip_tags(str_ireplace($find_array ,$replace_array, $res_sms[0]['content']));
        sendsms_3gsolutions($o->mobile,$mobile_message);    
    }
    // sendsms_3gsolutions($o->mobile, " Your OTP verification code: " . $o->mobile_otp);
   // sendmail($email_from, $o->email, "OTP Email for Neope", "Email: " . $o->email_otp);

    $o->user_id = $insertor->insert_object($o, "users");
    $result['user_id'] = $o->user_id;
    $result['error'] = "0";
    $result['error_msg'] = "Congratulations! Your Account has been created Successfully. Please Verify your email and Mobile for using it";
} else {
    if ($row_check == 2) {
        $result['error'] = "1";
        $result['error_msg'] = "Email / Mobile is  Associated to another Account. Please Try another";
    } elseif ($row_check == 1) {

        if ($res_check[0]['mobile_verified'] == 'Yes' || $res_check[0]['email_verified'] == 'Yes') {

            $result['error'] = "1";
            $result['error_msg'] = "Email / Mobile already Taken. Please try another";
        } else {
            $sql = "Select * from users where (email='" . $o->email . "' OR mobile='" . $o->mobile . "') AND user_id !='" . $res_check[0]['user_id'] . "' and is_active='1' ";
            $res = getXbyY($sql);
            $row = count($res);
            if ($row == 1) {
                $result['error'] = "1";
                $result['error_msg'] = "Email / Mobile is  Associated to another Account. Please Try another";
            } else {
                $o = $factory->get_factory($res_check[0]['user_id'], "users", "user_id");

                $o->email_otp = rand(5000, 9999);
                $o->mobile_otp = rand(5000, 9999);
                $user_type = strtolower($o->user_type);
                $user_type = explode(" ", $user_type);
                $count_user_type=count($user_type);
                if ($count_user_type =="1") {
                    $sms_type=$user_type[0];
                }else{
                    $sms_type = $user_type[0]."_".$user_type[1];
                }
                $sql_sms="Select * from sms_settings where is_active='1' and category='OTP' and ".$sms_type." ='Yes' ";
                $res_sms=getXbyY($sql_sms);
                $row_sms = count($res_sms);
                if ($row_sms >0) {
                    $otp =  $o->mobile_otp;
                    $mobile =$o->mobile;
                     $name=$o->name;
                    $find_array = ["{MobileNo}","{Name}"  ,"{Password}", "{Pin}"," {FromUserId}", "{ToUserId}", "{Amount}", "{CurrentBalance}", "{Reason}","{TransactionId}","{OperatorName}","{OperatorId}","{OTP}","{Date}","{Time}", "{company_name}" , "&nbsp;" ];
                    $replace_array = [$mobile , $name,$password  ,$pin, $from_user_id , $to_user_id , $amount , $current_balance , $reason , $transaction_id , $operator_name , $operator_id , $otp , $date , $time , $company_name ," " ];
                    $mobile_message =strip_tags(str_ireplace($find_array ,$replace_array, $res_sms[0]['content']));
                    sendsms_3gsolutions($o->mobile,$mobile_message);    
                }
                // sendsms_3gsolutions($o->mobile, " Your Mobile OTP verification code: " . $o->mobile_otp);
                sendmail($email_from, $o->email, "OTP Email for Neope", "Your Email OTP verification code:: " . $o->email_otp);


                $o = $updater->update_object($o, "users");

                $result['user_id'] = $res_check[0]['user_id'];
                $result['error'] = "0";
                $result['error_msg'] = "Congratulations! Your Account has been created Successfully. Please Verify your email and Mobile for using it";
            }
        }
    }
}



echo json_encode($result);
?>