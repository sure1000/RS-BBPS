<?php

session_start();
include "include.php";
$ajax_logout = 1;
include "session.php";

if ($_POST['updte'] > 0) {
    $o1->wallet_id = $_POST['wallet_id'];
    $status = $_POST['status'];
    $opid = $_POST['opid'];

    $o1 = $factory->get_object($o1->wallet_id, "wallet", "wallet_id");
    $o2 = $factory->get_object($o1->user_id, "users", "user_id");

    if ($o1->status == "Pending") {
        if ($opid != "") {
            $o1->opid = $opid;
        } else {
            if ($o1->opid == "") {
                $o1->opid = "Manual " . $status;
            }
        }
        if ($status == "Success") {
            $o1->status = "Success";
            $o1->wallet_id = $updater->update_object($o1, "wallet");
            $o1->parent_id = $o1->wallet_id;
            set_commission($o1, $o2, $o1->provider_type);
        } else if ($status == "Failed") {
            $o1->status = "Failed";
            $o1->wallet_id = $updater->update_object($o1, "wallet");
            $o1->transaction_type = "Refund";
            $o1->status = "Success";
            $o1->parent_id = $o1->wallet_id;
            $o1 = wallet_insert($o2, $o1);
        }
        $result['error'] = 0;
        $result['error_msg'] = "Status updated Successfully :" . $status;
    } else {
        $result['error'] = 1;
        $result['error_msg'] = "Status Already Update :" . $o1->status;
    }
} else {
    $result['error'] = 1;
    $result['error_msg'] = "Something went wrong. Please try again";
}

echo json_encode($result);
?>