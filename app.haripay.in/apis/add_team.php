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

    $o->user_id = $_POST['user_id'];

    $o = $factory->get_object($o->user_id, "users", "user_id");

    if ($_POST['add_user_id'] == "1") {
        if ($o->user_type == "Distributor" || $o->user_type == "Master Distributor") {
            $o1->email = $_POST['email'];
            $o1->mobile = $_POST['mobile'];
            if ($_POST['is_active'] == "Active") {
                $o1->is_active = "1";
            } else {
                $o1->is_active = "0";
            }

            $sql_chk_user = "Select user_id from users where (email = '" . $o1->email . "' or  mobile = '" . $o1->mobile . "') and user_id != '" . $o1->user_id . "'";
            $res_chk_user = getXbyY($sql_chk_user);
            $row_chk_user = count($res_chk_user);

            if ($row_chk_user > 0) {
                $result['error'] = "1";
                $result['error_msg'] = "Mobile/Email Already Exists";
            } else {
                
                if ($o->user_type == "Master Distributor") {
                    $o1->user_type = "Distributor";
                    $o1->parent_id = $_POST['user_id'];
                } else {
                    $o1->user_type = "Retailer";
                    $o1->parent_id = $_POST['user_id'];
                }
                $user_type = $o1->user_type;
                $o1->plan_id = $o->plan_id;

                if ($o1->user_id == 0) {
                    $password = rand(10000000, 99999999);
                    $o1->password = cpassword($password);
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
                $o1->is_active = '1';
                $o1->gender = 'Male';
                if ($o1->user_id > 0) {
                    $o1->user_id = $updater->update_object($o1, "users");
                    $result['error'] = "0";
                    $result['error_msg'] = "User Updated Successfully";
                } else {

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
                    $o1->is_active = '1';
                    $o1->approved_by = $o->user_id;
                    $o1->user_name = create_username($o1->user_type);
                    $o1->created_at = todaysDate();

                    $o1->user_id = $insertor->insert_object($o1, "users");
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
                         
                    }
                    $email_subject = $res_site[0]['site_name'] . " Account is active now.";
                    include "../mails/new_user.php";
                    sendmail($email_from, $o1->email, $email_subject, $email_message);

                    $message = "Congratulations! Your Account on  is active now. Username: " . $o1->mobile . " or " . $o1->email . " and password is: " . $password." and User Pin is:".$o1->kyc_id;
                    sendsms_payzoom($o1->mobile, $message);
                    $result['error'] = "0";
                    $result['error_msg'] = "User Added Successfully";
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
            }
        } else {
            $result['error'] = "1";
            $result['error_msg'] = "Something Went Wrong";
        }
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "Something Went Wrong";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something Went Wrong";
}

echo json_encode($result);
?>