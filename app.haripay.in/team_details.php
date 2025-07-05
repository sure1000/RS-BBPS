<?php

session_start();

include "include.php";
include "session.php";

if (isset($_GET['aid'])) {
    $o1->user_id = $_GET['aid'];
} else {
    $o1->user_id = 0;
}

if ($o1->user_id > 0) {
    $o1 = $factory->get_object($o1->user_id, "users", "user_id");
} else {
    $o1->is_active = 1;
}

if ($updte == 1) {
    if ($o->user_type == "Distributor" || $o->user_type == "Master Distributor") {
        $o1->email = $_POST['email'];
        $o1->mobile = $_POST['mobile'];
        $sql_chk_user = "Select user_id from users where (email = '" . $o1->email . "' or  mobile = '" . $o1->mobile . "') and user_id != '" . $o1->user_id . "'";
        $res_chk_user = getXbyY($sql_chk_user);
        $row_chk_user = count($res_chk_user);
        if ($row_chk_user > 0) {
            header("location:team_details.php?aid=" . $o1->user_id . "&msgid=12");
        } else {
            if ($o->user_type == "Distributor") {
                $o1->user_type = $_POST['user_type'];
                $o1->parent_id = $o->user_id;
            }else if ($o->user_type == "Master Distributor") {
                    $o1->user_type = $_POST['user_type'];
                    $o1->parent_id = $o->user_id;
            }else {
                $o1->user_type = "Retailer";
                $o1->parent_id = $o->user_id;
            }

            $user_type = $o1->user_type;
            $o1->plan_id = $o->plan_id;

            if ($o1->user_id == 0) {
                $password = ($_POST['password']);
                $o1->password = cpassword($_POST['password']);
                $o1->last_login = todaysDate();
                $o1->pincode = "123456";
            }

            $o1->name = $_POST['name'];
            $o1->mobile_1 = $_POST['mobile_1'];
            $o1->dob = $_POST['dob'];
            $o1->otp = rand(1000, 9999);
            $o1->mobile_otp = rand(1000, 9999);
            $o1->email_otp = rand(1000, 9999);
            $o1->login_ip = $_SERVER['REMOTE_ADDR'];
            $o1->district = $_POST['district'];
            $o1->state = $_POST['state'];
            $o1->user_address = $_POST['user_address'];
            $o1->gst_no = $_POST['gst_no'];
            $o1->pancard = $_POST['pancard'];
            $o1->adhaar_card = $_POST['adhaar_card'];
            $o1->company_name = $_POST['company_name'];
            $o1->company_type = $_POST['company_type'];
            $o1->is_active = $_POST['is_active'];
            $o1->gender = 'Male';
            if ($o1->user_id > 0) {
                $o1->user_id = $updater->update_object($o1, "users");
            }
            if($o->white_label_id > 0) {
                $o1->white_label_id = $o->white_label_id;
                $user_type1=$o1->user_type;
                $sql_sms = "Select * from sms_settings where is_active='1' and category='Create New Account' and user_id = '".$o1->white_label_id."'  and ".$user_type1." ='Yes'";

                $res_sms = getXbyY($sql_sms);
                $row_sms = count($res_sms);
                if ($row_sms > 0) {
                    $name = $o->name;
                    $eamil = $o1->email;
                    $pin = $o->kyc_id;
                    $user_type = $o1->user_type;
                    $password = $_POST['password'];
                    $find_array = ["{MobileNo}", "{Password}", "{Pin}", "{Name}", "{Email}", "{User Type}", " {FromUserId}", "{ToUserId}", "{Amount}", "{CurrentBalance}", "{Reason}", "{TransactionId}", "{OperatorName}", "{OperatorId}", "{OTP}", "{Date}", "{Time}", "{Company Name}", "&nbsp;"];
                    $replace_array = [$o1->mobile, $password, $pin,  $name, $eamil, $user_type, $from_user_id, $to_user_id, $amount, $current_balance, $reason, $transaction_id, $operator_name, $operator_id, $o1->otp, $date, $time, $res_site[0]['site_name'], " "];

                    $message = str_ireplace($find_array, $replace_array, $res_sms[0]['content']);
                    sendsms_payzoom($o1->mobile, $message);
                }

            }
             else {

                $o1->amount_balance = '0';
                $o1->credit_amount = '0';
                $o1->credit_limit = '0';
                $o1->kyc_id=rand(5000, 9999);
                $o1->uuid = '0';
                $time = strtotime(todaysDate());
                $final = date("Y-m-d", strtotime("+1 month", $time));
                $o1->kyc_date = $final;
                $o1->commission = '0';
                $o1->route = $o->route;

                $o1->force_logout = '0';
                $o1->mobile_verified = 'Yes';
                $o1->email_verified = 'Yes';
                $o1->kyc_modal = 'No';
                $o1->multi_api = 'No';
                $o1->tds = $o->tds;
                $o1->gst = $o->gst;
                $o1->approved_by = $o->user_id;
                $o1->user_name = create_username($o1->user_type);
                $o1->created_at = todaysDate();

                $o1->user_id = $insertor->insert_object($o1, "users");

                $email_subject = $res_site[0]['site_name'] . " Account is active now.";
                include "mails/new_user.php";
                sendmail($email_from, $o1->email, $email_subject, $email_message);

               $message = "Congratulations! Your Account on is active now. Username: " . $o1->mobile . " or " . $o1->email . " and password is: " . $password."and User Pin is:".$o1->kyc_id;
               sendsms_payzoom($o1->mobile, $message);
            }

            if ($_FILES['profile_pic']['name'] != "") {

                if ($o1->profile_pic != "") {
                    $img_link = "../profile_picture/" . $o1->profile_pic;
                    $img_thumb_link = "../profile_picture/thumbs/" . $o1->profile_pic;
                    unlink($img_link);
                    unlink($img_thumb_link);
                }

                $tmpfile = $_FILES['profile_pic']['tmp_name'];
                $source = "../profile_picture";
                $file_extension = explode(".", $_FILES['profile_pic']['name']);
                $destination = $o1->user_id . "." . end($file_extension);
                $thumbnail = 1;
                $newsize = "100";
                $watermark = "";

                uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark);

                $o1->profile_pic = $destination;
                $o1->user_id = $updater->update_object($o1, "users");
            }
            if ($user_type == "DSE") {
                header("location:team.php?msgid=3");
            } elseif ($user_type == "Distributor") {
            header("location:team.php?msgid=3");
        }
            else {
                header("location:team.php?msgid=3");
            }
        }
    } else {
        header("location:index.php");
    }
}
include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/team_details.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";
?>
