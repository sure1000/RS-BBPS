<?php

include "include.php";

if ($_POST['ipay_bank'] == "1") {
    $o1->ipay_user_id = $_POST['ipay_user_id'];
    $o2->bankID = $_POST['bank_id'];
    if ($o1->ipay_user_id > 0) {

        if ($o2->bankID > 0) {
            $o4 = $factory->get_object($o2->bankID, "ipay_bank", "bankID");
            $result['ifsC_Code'] = $o4->ifsC_Code;
            $result['error'] = "0";
            $result['error_msg'] = "Fetch Ifsc";
        } else {
            $result['error'] = "1";
            $result['error_msg'] = "Invalid Bank ID";
        }
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