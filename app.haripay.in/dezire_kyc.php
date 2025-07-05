<?php

session_start();

include "include.php";
include "session.php";

if ($_POST['imps_join_updte'] == '1') {


    $o2->api_id = '16';
    if ($o2->api_id > 0) {
        $o2 = $factory->get_object($o2->api_id, "api", "api_id");
    }
    $o1->user_id = $o->user_id;
    $o1->merchantUserID = $o2->api_username;
    $o1->first_Name = $_POST['imps_first_Name'];
    $name = explode(" ", $o1->first_Name);
    $sql = "Select dezire_user_id from dezire_user order by dezire_user_id Desc Limit 0 , 1";
    $res = getXbyY($sql);
    $row = count($res);
    if ($row > 0) {
        $new_id = $res[0]['dezire_user_id'] + 1;
       $o1->senderCode = "S" . $name[0] . "" . $new_id;
    } else {
        $o1->senderCode = "S" . $name[0] . "1";
    }
    $o1->last_Name = $_POST['imps_last_Name'];
    $o1->kyc_Flag = 'false';
    $o1->mobileNo = $_POST['dezire_mobile'];
    $o1->pincode = $_POST['imps_pincode'];
    $o1->kyc_status = "No";
   $o1->address = "";
        $o1->cityName = "";
         $o1->addressProofNo = "";
        $o1->addressProof = "";
        $o1->stateID = "";
        $o1->idProof = "";
        $o1->idProofNo = "";
         $o1->state_name = "0";
      $o1->addressProofUrl = $destination;
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
    
    if ($o1->kyc_Flag == "true") {

       
    
      
        if ($_FILES['imps_addressProofUrl']['name'] != "") {
            $tmpfile = $_FILES['imps_addressProofUrl']['tmp_name'];
            $source = "../profile_picture";
            $file_extension = explode(".", $_FILES['imps_addressProofUrl']['name']);
            $destination = $o1->merchantUserID . "." . end($file_extension);
            $thumbnail = 1;
            $newsize = "100";
            $watermark = "";

            uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark);

           
        }
        if ($_FILES['imps_idProofUrl']['name'] != "") {
            $tmpfile = $_FILES['imps_idProofUrl']['tmp_name'];
            $source = "../profile_picture";
            $file_extension = explode(".", $_FILES['imps_idProofUrl']['name']);
            $destination = $o1->merchantUserID . "." . end($file_extension);
            $thumbnail = 1;
            $newsize = "100";
            $watermark = "";

            uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark);

            $o1->idProofUrl = $destination;
        }
        $o1->idProofimageUrl = "http://192.168.0.2:8050/profile_picture/" . $o1->idProofUrl;
        $o1->addressProofimageUrl = "http://192.168.0.2:8050/profile_picture/" . $o1->addressProofUrl;

        $o1->data = "";
    } else {
        $o1->kyc_status = "No";
        $o1->address = "0";
        $o1->cityName = "0";
        $o1->stateID = "0";
        $o1->state_name = "0";
        $o1->pincode = "0";
        $o1->addressProofNo = "0";
        $o1->addressProof = "0";
        $o1->addressProofUrl = "0";
        $o1->idProofimageUrl = "0";
        $o1->idProof = "0";
        $o1->idProofNo = "0";
        $o1->idProofUrl = "0";
        $o1->data = "";
    }
    $o1->status = "Pending";
    $o1->PIN_user = "0";
    $o1->created_at = todaysDate();
    $o1->updated_at = todaysDate();
    $o1->balance = "0";
    $o1->balance_limit = "0";
    $o1->other = "0";
    $o1->is_active = "1";
    //$o1->dezire_user_id = $insertor->insert_object($o1, "dezire_user");

    $o2->api_id = '16';
    if ($o2->api_id > 0) {
        $o2 = $factory->get_object($o2->api_id, "api", "api_id");

        if ($o2->is_active == "1") {
            $plaintext = '{"merchantUserID":"' . $o1->merchantUserID . '","senderCode":"' . $o1->senderCode . '","first_Name":"' . $o1->first_Name . '","last_Name":"' . $o1->last_Name . '","kyc_Flag":"' . $o1->kyc_Flag . '","mobileNo":"' . $o1->mobileNo . '","address":"' . $o1->address . '","cityName":"' . $o1->cityName . '","stateID":"' . $o1->stateID . '","pincode":"' . $o1->pincode . '","addressProofNo":"' . $o1->addressProofNo . '","addressProof":"' . $o1->addressProof . '","addressProofUrl":"' . $o1->addressProofimageUrl . '","idProofNo":"' . $o1->idProofNo . '","idProof":"' . $o1->idProof . '","idProofUrl":"' . $o1->idProofimageUrl . '"}';
            $cipher = "AES256";
            $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
            $encData = base64_encode(openssl_encrypt($plaintext, $cipher, $o2->md_key, $options = OPENSSL_RAW_DATA, $iv));
            $decData = openssl_decrypt(base64_decode($encData), $cipher, $o2->md_key, OPENSSL_RAW_DATA, $iv);
            $api_response = dezire_money_join($encData);

            if ($api_response['error'] == "0") {
                if ($api_response['status'] == "1") {
                    $result['status'] = "Success";
                    $o1->status = "Success";
                    $o1->sender_id = $api_response['senderID'];
                    $o1->dezire_user_id = $insertor->insert_object($o1, "dezire_user");
                } else {
                    if ($api_response['message'] == "Mobile number already Existed against this merchantUserID.") {
                        $result['status'] = "Success";
                        $sql = "select mobileNo from dezire_user where  mobileNo = '" . $o1->mobileNo . "'";
                        $res = getXbyY($sql);
                        $row = count($res);
                        if ($row == 0) {
                            $result['status'] = "Success";
                            $o1->status = "Success";
                            $o1->sender_id = $api_response['senderID'];
                            $o1->dezire_user_id = $insertor->insert_object($o1, "dezire_user");
                        } else {
                            $result['status'] = "Failed";
                        }
                    } else {
                        $result['status'] = "Failed";
                    }
                }

                $result['error'] = "0";
                $result['error_msg'] = $api_response['message'];
            } else {
                $result['error'] = "1";
                $result['error_msg'] = $api_response['error_msg'];
            }
        } else {
            $result['error'] = "1";
            $result['error_msg'] = "Operator down. Please wait";
        }
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>


