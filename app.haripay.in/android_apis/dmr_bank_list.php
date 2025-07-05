<?php

include "include.php";


if ($o->user_id > 0) {

    $sql_bank = "Select * from ipay_bank";
    $res_bank = getXbyY($sql_bank);
    $row_bank = count($res_bank);

    if ($row_bank > 0) {
        for ($i = 0; $i < $row_bank; $i++) {
            $results[$i]['bank_name'] = (string) $res_bank[$i]['bank_name'];
            $results[$i]['ifsC_Code'] = (string) $res_bank[$i]['ifsC_Code'];
        }
        $result['Bank_name'] = $results;
        $result['error'] = "0";
        $result['error_msg'] = "Fetch bank";
    } else {
        $result['Bank_name'] = [];
        $result['error'] = "1";
        $result['error_msg'] = "No Data found.";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "No Data found.";
}




echo json_encode($result);
?>