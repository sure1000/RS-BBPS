<?php

include "include.php";
if (isset($_POST)) {
    $o->user_id = $_POST['user_id'];
    $o = $factory->get_object($o->user_id, "users", "user_id");
    if ($o->is_active == "1") {

        $mode = $_POST['mode'];
        if ($mode != "") {

            if ($mode == "IMPS" || $mode == "NEFT" || $mode == "RTGS") {

                $result['account_name'] = "D";
                $result['account_number'] = "PAY" . $o->user_name;
                $result['ifcs_code'] = "ICIC000010";
                $result['error'] = "0";
                $result['error_msg'] = "Fetch Data";
            } else {

                $sql = "Select * from payment_mode where payment_mode = '" . $mode . "' and is_active = 1";
                $res = getXbyY($sql);
                $rows = count($res);

                if ($rows > 0) {

                    $result['account_name'] = (string) $res[0]['account_name'];
                    $result['account_number'] = (string) $res[0]['account_number'];
                    if ($res[0]['ifsc_code'] != "") {
                        $result['ifsc_code'] = (string) $res[0]['ifsc_code'];
                    } else {
                        $result['ifsc_code'] = "";
                    }
                    if ($res[0]['logo'] != "") {
                        $result['logo'] = "" . $_SERVER['HTTP_HOST'] . "/provider_logos/" . $res[0]['logo'];
                    } else {
                        $result['logo'] = "";
                    }
                    $result['error'] = "0";
                    $result['error_msg'] = "Fetch Data";
                } else {
                    $result['error'] = "1";
                    $result['error_msg'] = "Something went wrong. Please try again";
                }
            }
        } else {
            $result['error'] = "1";
            $result['error_msg'] = "Invalid Transfer Mode";
        }
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
