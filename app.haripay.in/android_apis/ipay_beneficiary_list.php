<?php

include "include.php";

if ($_POST['ipay_ben_list'] == "1") {
    $o1->ipay_user_id = $_POST['ipay_user_id'];
    if ($o1->ipay_user_id > 0) {
        $o1 = $factory->get_object($o1->ipay_user_id, "ipay_user", "ipay_user_id");

        $result['user_name'] = (string) $o1->first_Name . " " . $o1->last_name;
        $result['mobile_number'] = (string) $o1->mobileNo;
        $result['ipay_user_id'] = (string) $o1->ipay_user_id;
        $result['remaining'] = (String) $o1->balance;
        $result['total_limit'] = (String) $o1->balance_limit;

        $sql = "Select * from ipay_beneficiary where user_id = '" . $o->user_id . "' and ipay_user_id=" . $o1->ipay_user_id . " and is_active= 1";
        $res = getXbyY($sql);
        $row = count($res);
        if ($row > 0) {
            for ($i = 0; $i < $row; $i++) {
                $results[$i]['ben_id'] = ucwords(strtolower($res[$i]['ipay_beneficiary_id']));
                $results[$i]['beneficiaryName'] = ucwords(strtolower($res[$i]['beneficiaryName']));
                $results[$i]['accountNo'] = ucwords(strtolower($res[$i]['accountNo']));
                $results[$i]['bank_name'] = ucwords(strtolower($res[$i]['bank_name']));
                $results[$i]['ifscCode'] = ucwords(strtolower($res[$i]['ifscCode']));
            }
            $result['ben_list'] = $results;
        } else {
            $result['ben_list'] = "[]";
        }
        $result['error'] = "0";
        $result['error_msg'] = "Fetch Data";
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "Invalid Customer Number";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>

