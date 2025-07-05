<?php
session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

if ($updte == 1) {

    $bank_id = $_POST['bank_id'];

    if ($bank_id > 0) {
        $o4 = $factory->get_object($bank_id, "dezire_bank", "bankID");
        $result['ifsC_Code'] = $o4->ifsC_Code;
        $result['error'] = "0";
    } else {
        $result['error'] = "1";
    }
}

echo json_encode($result);
?>