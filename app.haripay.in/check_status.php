<?php

session_start();
include "include.php";
include "session.php";

if ($updte == 1) {
    $o1->wallet_id = $_POST['wallet_id'];
    $o1 = $factory->get_object($o1->wallet_id, "wallet", "wallet_id");

    if ($o1->api_id > 0) {
        if ($o1->api_id == "13") {
            $result = recharge_status_roundpay($o1);
        } else if ($o1->api_id == "4") {
            $result = recharge_status_ezulix($o1);
            //  pt($result);
        } else if ($o1->api_id == "5") {
            $result = recharge_status_cyrus($o1);
            //  pt($result);
        }else if ($o1->api_id == "6") {
            $result = status_rechapi($o1);
            
        }
        $o1->updated_at = todaysDate();
        $o1->opid = $result['opid_id'];
        $o1->response_url = $result['url'] . "" . $result['response'];
        if ($result['status'] == "Failed") {
            $o1->status = "Failed";

            $o1->wallet_id = $updater->update_object($o1, "wallet");
            $result['error_msg'] = "Recharge Failed";
            $o1->transaction_type = "Refund";
            $o1->status = "Success";
            $o1 = wallet_insert($o, $o1);
        } else if ($result['status'] == "Success") {
            $o1->status = "Success";
            $o1->wallet_id = $updater->update_object($o1, "wallet");
            $result['error_msg'] = "Recharge Success";

            set_commission($o1, $o, "Prepaid");
        } else {
            $result['status'] = "Pending";
            $result['error_msg'] = "Recharge " . $o1->status;
        }
    }
}

echo json_encode($result);
?>