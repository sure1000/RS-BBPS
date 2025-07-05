<?php

include "include.php";
if (isset($_POST)) {
    $o->user_id = $_POST['user_id'];
    $o = $factory->get_object($o->user_id, "users", "user_id");
    if ($o->is_active == "1") {


        $mobile = $_POST['mobile'];
        $service = $_POST['service'];


        $sql = "Select * from user_mobiles where mobile_number = '" . $mobile . "'";
        $res = getXbyY($sql);
        $rows = count($res);

        if ($rows == 1) {
            $result['provider'] = $res[0]['provider'];
            $result['provider_id'] = get_provider_name_by_service($result['provider'], $service);
            $result['circle'] = $res[0]['circle'];
        } else {
            $result = planapi_mobile_info($mobile);
            $result['provider_id'] = get_provider_name_by_service($result['provider'], $service);
        }

        $result['error'] = "0";
        $result['error_msg'] = "Fetch Provider & circle";
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "User Blocked";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong. Please try again";
}


echo json_encode($result);
?>
