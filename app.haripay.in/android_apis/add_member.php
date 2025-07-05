<?php

include "include.php";


if (isset($_POST['edit_user_id'])) {
    $o1->user_id = $_POST['edit_user_id'];
} else {
    $o1->user_id = 0;
}

if ($o1->user_id > 0) {
    $o1 = $factory->get_object($o1->user_id, "users", "user_id");
} else {
    $o1->is_active = 1;
}
if (isset($_POST)) {

    $o->user_id = $o->user_id;

    $o = $factory->get_object($o->user_id, "users", "user_id");

    
if ($o1->user_id > 0) {
	$o1 = $factory->get_object($o1->user_id, "users", "user_id");
    $o3 =$factory->get_object($o1->parent_id,"users","user_id");
} else {
    $o3 =$factory->get_object($o->user_id,"users","user_id");
    $o1->is_active = 1;
}

if ($_POST['updte'] == 1) {

    $sql_check = "Select * from users where (email='".$_POST['email']."' || mobile='".$_POST['mobile']."') and user_id !='".$o1->user_id."' and is_active = 1 ";
    $res_check = getXbyY($sql_check);
    $rows_check = count($res_check);
    if($rows_check>0){

        $result['error']=0;
        $result['error_msg']="Username and Mobile number already exists.";
    } else {

        $o1->name = $_POST['name'];
        

       
        if($o->user_type=='Master Distributor'){
            $o1->user_type = 'Distributor';
        } else {
            $o1->user_type = 'Retailer';
        }

        $o1->parent_id = $o->user_id;
        $o1->plan_id = $o3->plan_id;
        $o1->email = $_POST['email'];
        $o1->mobile = $_POST['mobile'];
        $o1->mobile_1 = $_POST['mobile_1'];
        $o1->dob = $_POST['dob'];
        $o1->otp = rand(1000, 9999);
        $o1->mobile_otp = rand(1000, 9999);
        $o1->email_otp = rand(1000, 9999);
        $o1->user_address = $_POST['user_address'];
        $o1->district = $_POST['district'];
        $o1->state = $_POST['state'];
        $o1->pincode=$_POST['pincode'];
        $o1->commission = $_POST['commission'];
        $o1->company_name = $_POST['company_name'];
        $o1->company_type = $_POST['company_type'];
        $o1->gst_no = $_POST['gst_no'];
        $o1->pancard = $_POST['pancard'];
        $o1->adhaar_card = $_POST['adhaar_card'];
        $o1->mobile_verified = 'Yes';
        $o1->email_verified = 'Yes';
        $o1->route = '0';
        $o1->outlet_status ='New';
        $o1->uuid = rand(10000000, 99999999);
        $o1->is_active = '1';//$_POST['is_active'];
        $o1->approve_it = $o->user_id;
        $o1->credit_limit = $_POST['credit_limit'];
        $o1->gender = 'Male';
        $o1->capping_amount = '0';
        $o1->otp_enabled = $_POST['otp_enabled'];
        $o1->login_ip=$_SERVER['REMOTE_ADDR'];
        $o1->sign_up=$_POST['sign_up'];
        $o1->balance_low_alert=$_POST['balance_low_alert'];
        $o1->multi_api ='Yes';
        $o1->last_login = todaysDate();

        if($o1->sign_up == ""){
            $o1->sign_up = 'No';
        }
        if($o1->gst_no == ""){
            $o1->gst_no = 0;
        }
        if($o1->pancard == ""){
            $o1->pancard = 0;
        }
        if($o1->adhaar_card == ""){
            $o1->adhaar_card = 0;
        }
        if($o1->credit_limit == ""){
            $o1->credit_limit = 0;
        }
        if($o1->district == ""){
            $o1->district = 'None';
        }
        if($o1->mobile_1  == ""){
            $o1->mobile_1 = $o1->mobile;
        } 
        if($o1->dob =='0000-00-00' || $o1->dob ==''){
            $o1->dob=todaysDate();
        }
        if($o1->approve_it == "Yes"){
            $o1->approved_by = $o->user_id;
        }
        if($o1->uuid == ""){
            $o1->uuid = 0;
        }

        if($o1->parent_id == ""){
            $o1->parent_id = 0;
        }

        if($o1->kyc_id == ""){
            $o1->kyc_id = 0;
        }
        if($o1->force_logout == ""){
            $o1->force_logout = 0;
        }

        $o1->kyc_date = todaysDate();

        $o1->kyc_modal = 'No';
        
        if($o1->user_id > 0){

            $o1->user_id = $updater->update_object($o1,"users");
        }else{
            $password=rand(10000000, 99999999);
            $o1->password = cpassword($password);
            $o1->user_pin = rand(1000, 9999);
            $o1->amount_balance = '0';
            $o1->credit_amount = '0';
            $o1->user_name = create_username($o1->user_type);
            if($o1->user_name == ""){
                $o1->multi_api = NULL;
            }
            $o1->creation_date = todaysDate();
            $o1->user_id = $insertor->insert_object($o1,"users");
            if ($o1->user_type == 'Retailer') {
                $o2->user_id = $o1->user_id;
                $o3->user_id = $o1->user_id;
                $sql_services = "Select service_id,service_name from services";
                $res_services = getXbyY($sql_services);
                $rows_services = count($res_services);
                if ($rows_services > 0) {
                    for ($i = 0; $i < $rows_services; $i++) {
                        $o2->service_id = $res_services[$i]['service_id'];
                        $o2->service_name = $res_services[$i]['service_name'];

                        if($res_services[$i]['service_name']=="Prepaid" || $res_services[$i]['service_name']=="Postpaid" || $res_services[$i]['service_name'] =="DTH" || $res_services[$i]['service_name'] =="Landline" || $res_services[$i]['service_name'] =="Electricity" || $res_services[$i]['service_name'] =="Insurance" || $res_services[$i]['service_name'] =="Water" || $res_services[$i]['service_name']=="Stv" ){
                            $o2->status = 'Yes';
                        }else{
                         $o2->status = 'No';
                     }
                     $o2->is_active = '1';
                     $o2->created_at = todaysDate();
                     $o2->updated_at = todaysDate();
                     $o2->user_service_id = $insertor->insert_object($o2, "user_services");
                 }
             }
             $sql_p = "Select provider_id,provider from providers";
             $res_p = getXbyY($sql_p);
             $rows_p = count($res_p);
             if ($rows_p > 0) {
                for ($p = 0; $p < $rows_p; $p++) {
                    $o3->provider_id = $res_p[$p]['provider_id'];
                    $o3->provider_name = $res_p[$p]['provider'];
                    $o3->amount_limit = '0';
                    $o3->block_status = 'No';
                    $o3->is_active = '1';
                    $o3->created_date = todaysDate();
                    $o3->updated_at = todaysDate();
                    $o3->user_operator_block_id = $insertor->insert_object($o3, "user_operator_amount_block");
                }
            }
        }
        sendmail($o1->email, "Welcome to the " . $res_site[0]['site_name'] . " !", "Dear " . $o1->name . ",<br/> Thank you for registering at . Your account is created as " . $o1->user_type . ".<br/><b>Login Details :</b> <br/> <b> User name :</b>" . $o1->email . " <br/> <b>Password :</b>" . $password . "<br/><b>User_pin :</b>" . $o1->user_pin . "<br/> Click <a href='#'>Here</a> to login.<br/>Download App:<a href='#'>click here</a> <br/> Thank you,<br/> " . $res_site[0]['site_name'] . " Team.");


        $user_type = strtolower($o1->user_type);
        $user_type = explode(" ", $user_type);
        $count_user_type=count($user_type);
        if ($count_user_type =="1") {
            $sms_type=$user_type[0];
        }else{
            $sms_type = $user_type[0]."_".$user_type[1];
        }
        $sql_sms="Select * from sms_settings where is_active='1' and category='Create New Account' and ".$sms_type." ='Yes' ";
        $res_sms=getXbyY($sql_sms);
        $row_sms = count($res_sms);
        if ($row_sms >0) {
            $name = $o1->name;
            $eamil = $o1->email;
            $pin = $o1->user_pin;
            $user_type = $o1->user_type;

            $find_array = ["{MobileNo}" ,"{Name}","{Password}", "{Pin}","{Name}","{Email}" ,"{User Type}" , " {FromUserId}", "{ToUserId}", "{Amount}", "{CurrentBalance}", "{Reason}","{TransactionId}","{OperatorName}","{OperatorId}","{OTP}","{Date}","{Time}", "{company_name}" , "&nbsp;" ];
            $replace_array = [$o1->mobile ,$name,$password  ,$pin, $name , $eamil , $user_type ,$from_user_id , $to_user_id , $amount , $current_balance , $reason , $transaction_id , $operator_name , $operator_id ,$o1->otp , $date , $time , $res_site[0]['site_name'] , " "];
            $mobile_message =str_ireplace($find_array ,$replace_array, $res_sms[0]['content']);
            sendsms_3gsolutions($o1->mobile,$mobile_message);   
        }

        

    }

    if ($_FILES['profile_pic']['name'] != "") {

        if ($o1->profile_pic != "") {
            $img_link = "profile_picture/" . $o1->profile_pic;
            $img_thumb_link = "profile_picture/thumbs/" . $o1->profile_pic;
            unlink($img_link);
            unlink($img_thumb_link);
        }

        $tmpfile = $_FILES['profile_pic']['tmp_name'];
        $source = "profile_picture";
        $file_extension = explode(".", $_FILES['profile_pic']['name']);
        $destination = $o1->user_id."." . end($file_extension);
        $thumbnail = 1;
        $newsize = "100";
        $watermark = "";

        uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark);

        $o1->profile_pic = $destination;
        $o1->user_id = $updater->update_object($o1, "users");
    }

    $result['error']='1';
    $result['error_msg']="Member added successfully.";
}



} else {
   $result['error']="1";
   $result['error_msg']="Something went wrong. Please try again.";  
}

} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something Went Wrong";
}

echo json_encode($result);

?>
