<?php

include "include.php";

if ($_POST['ipay_bank_list'] == "1") {
    $o1->ipay_user_id = $_POST['ipay_user_id'];
    if ($o1->ipay_user_id > 0) {
     
        $sql = "Select * from ipay_bank where is_active= 1";
        $res = getXbyY($sql);
        $row = count($res);
        if ($row > 0) {
            for ($i = 0; $i < $row; $i++) {
                $results[$i]['bank_id'] = ucwords(strtolower($res[$i]['bankID']));
                $results[$i]['bank_name'] = ucwords(strtolower($res[$i]['bank_name']));
             }
            $result['bank_list'] = $results;
        } else {
            $result['bank_list'] = "[]";
        }
        $result['error'] = "0";
        $result['error_msg'] = "Fetch Bank";
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

