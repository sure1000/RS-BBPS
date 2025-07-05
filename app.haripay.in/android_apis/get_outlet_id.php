<?php
include "include.php";
if (isset($_POST)) {
    $o->user_id = $_POST['user_id'];
    $o = $factory->get_object($o->user_id, "users", "user_id");
    if ($o->is_active == "1") {

if ($o->route == '8') {
    $o1 = $factory->get_object($o->route, "api", "api_id");
    $mobile = $o->mobile;
    $otp = $_POST['otp'];
    $name = $_POST['name'];
    $company_name = $_POST['company_name'];
    $outlet_type = $_POST['outlet_type'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $pancard = $_POST['pan_number'];
    $adhar_number = $_POST['adhar_number'];
    $api_result = create_outlet_id($o1, $mobile, $otp, $name, $company_name, $outlet_type, $address, $pincode, $pancard, $adhar_number);

    if ($api_result['error'] == "0") {

        if ($api_result['status_code'] == "RCS") {

            $o->outlet_id = $api_result['OutletID'];
            $o->outlet_status = "Pending";
            $o->pancard = $_POST['pan_number'];
            $o->adhaar_card = $_POST['adhar_number'];
            $o2 = $updater->update_object($o, "users");
            $result['error'] = '0';
            $result['error_msg'] = $api_result['error_msg'];
        } else {

            $result['error'] = '1';
            $result['error_msg'] = $api_result['error_msg'];
        }
    } else {
        $result['error'] = '1';
        $result['error_msg'] = $api_result['error_msg'];
    }
} else {
    $result['error'] = '0';
    $result['error_msg'] = "Something Went Wrong,Try Again";
}
} else {
        $results['error'] = "1";
        $results['error_msg'] = "User Blocked.";

        echo json_encode($result);
        die();
    }
} else {
    $results['error'] = "1";
    $results['error_msg'] = "Something went wrong please try again";
}
echo json_encode($result);
?>