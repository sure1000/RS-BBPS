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
    $old_active = $o1->is_active;
    $old_kyc=$o1->kyc_id;
} else {
    $o1->is_active = 1;
}

if ($updte == 1) {


    $sql_check = "Select * from users where (email= '" . $_POST['email'] . "' or mobile ='" . $_POST['mobile'] . "') and user_id != '".$o1->user_id."'";
    $res_check = getXbyY($sql_check);
    $row_check = count($res_check);

    if ($row_check > 0) {
         header("location:team_details.php?aid=".$o1->user_id."&msgid=4");
    } else {
        $o1->user_type = $_POST['user_type'];
        if ($o1->user_id == 0) {
            $password = $_POST['password'];
            $o1->password = cpassword($_POST['password']);
        }
        $o1->name = $_POST['name'];
        if ($_POST['parent_id'] > 0) {
            $o1->parent_id = $_POST['parent_id'];
        } else {
            $o1->parent_id = 0;
        }
        $o2 = $factory->get_object($o1->parent_id, "users", "user_id");
        if ($o2->user_type != "Admin" && ( $o1->user_type == 'Retailer' || $o1->user_type == 'DSE')) {

            $o1->plan_id = $o2->plan_id;
        } else {
            $o1->plan_id = $_POST['plan_id'];
        }
        $o1->email = $_POST['email'];
        $o1->mobile = $_POST['mobile'];
        $o1->user_address = $_POST['user_address'];
        $o1->district = $_POST['district'];
        $o1->state = $_POST['state'];
        $o1->commission = $_POST['commission'];
        $o1->company_name = $_POST['company_name'];
        $o1->company_type = $_POST['company_type'];
        $o1->gst_no = $_POST['gst_no'];
        $o1->pancard = $_POST['pancard'];
        $o1->adhaar_card = $_POST['adhaar_card'];
        $o1->mobile_verified = 'Yes';
        $o1->email_verified = 'Yes';
        $o1->route = $_POST['route'];
        $o1->uuid = $_POST['uuid'];
        $o1->is_active = $_POST['is_active'];
        $o1->approve_it = $_POST['approve_it'];
        $o1->credit_limit = "";
        $o1->gender = 'Male';
        if ($o1->credit_limit == "") {
            $o1->credit_limit = 0;
        }
        if ($o1->approve_it == "Yes") {
            $o1->approved_by = $o->user_id;
        }

        if ($o1->parent_id == "") {
            $o1->parent_id = 0;
        }

        if ($o1->otp == "") {
            $o1->otp = rand(1000, 9999);
        }
        if ($o1->last_login == "") {
            $o1->last_login = todaysDate();
        }
        // if ($o1->kyc_id == "") {
            $o1->kyc_id=$_POST['kyc_id'];
        // }
        if ($o1->force_logout == "") {
            $o1->force_logout = 0;
        }
  
        if ($o1->user_id > 0) {
            
          
            if($old_active == "2" && $o1->is_active == '1'){
                  $password = substr(md5(rand(1000, 10000)), 0, 8);
        $o1->password = cpassword($password);
        if($o1->user_type =='Retailer'){
$message = "Congratulations! Your Account on  is active now. Username: " . $o1->mobile . " or " . $o1->email . " and password is: " . $password."and user pin is:".$o1->kyc_id;
        }else{
$message = "Congratulations! Your Account on  is active now. Username: " . $o1->mobile . " or " . $o1->email . " and password is: " . $password;   

        }
                 
        sendsms_payzoom($o1->mobile, $message);
            }
            if($old_kyc != $o1->kyc_id && $o1->user_type =='Retailer'){
                 $message = "Your New user pin is:".$o1->kyc_id;
        sendsms_payzoom($o1->mobile, $message);

            }
            $o1->user_id = $updater->update_object($o1, "users");
        } else {

            $o1->amount_balance = '0';
            $o1->credit_amount = '0';
            $o1->created_at = todaysDate();
            $o1->user_name = create_username($o1->user_type);
            $time = strtotime(todaysDate());
            $final = date("Y-m-d", strtotime("+1 month", $time));
            $o1->kyc_date = $final;
            $o1->user_id = $insertor->insert_object($o1, "users");
            $email_subject = $res_site[0]['site_name'] . " Account is active now.";
            include "../mails/new_user.php";
            sendmail($email_from, $o1->email, $email_subject, $email_message);

           if($o1->user_type =='Retailer'){
$message = "Congratulations! Your Account on  is active now. Username: " . $o1->mobile . " or " . $o1->email . " and password is: " . $password."and user pin is:".$o1->kyc_id;
        }else{
$message = "Congratulations! Your Account on is active now. Username: " . $o1->mobile . " or " . $o1->email . " and password is: " . $password;   

        }
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
            $destination = $o1->user_id . "_profile_pic" . "." . end($file_extension);
            $thumbnail = 1;
            $newsize = "100";
            $watermark = "";

            uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark);

            $o1->profile_pic = $destination;
            $o1->user_id = $updater->update_object($o1, "users");
        }
        header("location:team.php?msgid=3");
    }
}

include "html/includes/header.php";
include "html/team_details.php";
include "html/includes/footer.php";
include "js/team_details.js";
?>