<?php

include "include.php";


if ($o->user_id > 0) {
    if ($_POST['paytm_user_id'] > 0) {
        $sql_ben = "Select * from paytm_beneficiary where user_id = '" . $o->user_id . "' and  paytm_user_id = '" . $_POST['paytm_user_id'] . "'";
        $res_ben = getXbyY($sql_ben);
        $row_ben = count($res_ben);

        if ($row_ben > 0) {
            for ($i = 0; $i < $row_ben; $i++) {


                $results[$i]['paytm_beneficiary_id'] = (string) $res_ben[$i]['paytm_beneficiary_id'];
                $results[$i]['beneficiaryName'] = (string) $res_ben[$i]['beneficiaryName'];
                $results[$i]['mobileNo'] = (string) $res_ben[$i]['mobileNo'];
                $results[$i]['accountNo'] = (string) $res_ben[$i]['accountNo'];
                $results[$i]['status'] = (string) $res_ben[$i]['status'];
                $results[$i]['ifscCode'] = (string) $res_ben[$i]['ifscCode'];
                $results[$i]['verify_status'] = (string) $res_ben[$i]['other'];
            }
            $result['ben_list'] = $results;
            $result['error'] = "0";
            $result['error_msg'] = "Fetch Users";
        } else {
            $result['ben_list'] = [];
            $result['error'] = "1";
            $result['error_msg'] = "No Data found.";
        }
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "User id Not found";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "No Data found.";
}




echo json_encode($result);
?>