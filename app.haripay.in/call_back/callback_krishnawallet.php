<?php

include 'include.php';


if ($_GET['order_id'] != "") {
    $mytxid = $_GET['order_id'];
}
if ($_GET['status'] != "") {
    $status = $_GET['status'];
    if ($status == "SUCESSS") {
        $status = "Success";
    } else {
        $status = "Failed";
    }
}
sendmail($email_from, $email_to, $email_subject, $email_message);
if ($mytxid != "") {

//    $sql = "Select * from wallet where   status = 'Pending' and  ref_number = '" . $mytxid . "'";
//    $res = getXbyY($sql);
//    $row = count($res);
//
//    if ($row == 1) {
//
//        $o3 = $factory->get_object($res[0]['recharge_id'], "recharge", "recharge_id");
//        $o4 = $factory->get_object($res[0]['user_id'], "users", "user_id");
//
//
//        if ($status == "Success") {
//            $query = "Update wallet set status = 'Success' , opid='" . $opid . "' where wallet_id ='" . $res[0]['wallet_id'] . "'";
//            $set = setXbyY($query);
//
//
//            $sql_BACK = "select wallet_id from wallet_backup where wallet_id ='" . $res[0]['wallet_id'] . "'";
//            $res_BACK = getXbyY($sql_BACK);
//            $row_BACK = count($res_BACK);
//            if ($row_BACK > 0) {
//                $query = "Update wallet_backup set status = 'Success' , opid='" . $opid . "'  where wallet_id = " . $res_BACK[0]['wallet_id'];
//                $set = setXbyY($query);
//            }
//
//            $o2->transaction_type = "commission";
//            $o2->comments = "Commission for Recharge";
//            if ($o3->recharge_type == 'Wallet' || $o3->recharge_type == 'Electricity') {
//                $rech_type = "utility";
//            } else {
//                $rech_type = strtolower(($o3->recharge_type));
//            }
//            if ($o3->recharge_type == 'Electricity') {
//                $sql_update = "Update utilities set  is_active='2'  ,transaction_number ='" . $opid . "' where wallet_id ='" . $res[0]['wallet_id'] . "' and is_active = '1'  ";
//                $set_update = setXbyY($sql_update);
//
//                $sql_update1 = "Update recharge set  status = 'Success' where recharge_id ='" . $res[0]['recharge_id'] . "' and is_active = '1'  ";
//                $set_update1 = setXbyY($sql_update1);
//            }
//
//            set_commission($res[0]['user_id'], $res[0]['wallet_id'], $rech_type);
//            $n_msg = "Recharge Success for Number: " . $o3->mobile;
//            sendnotification($o4->user_id, $n_msg);
//        } else {
//
//            $query = "Update wallet set status = 'Failed' , comments='" . $opid . "' where ref_number = '" . $mytxid . "'";
//            $set = setXbyY($query);
//            if ($o3->recharge_type == 'Electricity') {
//                $sql_update = "Update utilities set  is_active='3'  where wallet_id ='" . $res[0]['wallet_id'] . "' and is_active = '1'  ";
//                $set_update = setXbyY($sql_update);
//
//                $sql_update1 = "Update recharge set  status = 'Failure'  where recharge_id ='" . $res[0]['recharge_id'] . "' and is_active = '1'  ";
//                $set_update1 = setXbyY($sql_update1);
//            }
//            $sql_BACK = "select wallet_id from wallet_backup where wallet_id ='" . $res[0]['wallet_id'] . "'";
//            $res_BACK = getXbyY($sql_BACK);
//            $row_BACK = count($res_BACK);
//            if ($row_BACK > 0) {
//                $query = "Update wallet_backup set status = 'Failed'  , comments=" . $opid . "  where wallet_id = " . $res_BACK[0]['wallet_id'];
//                $set = setXbyY($query);
//            }
//
//            $o2->user_id = $res[0]['user_id'];
//            $o2->parent_id = $res[0]['wallet_id'];
//            $o2->api_id = $res[0]['api_id'];
//            $o2->api_name = $res[0]['api_name'];
//            $o2->api_transaction_id = $res[0]['api_transaction_id'];
//            $o2->dmr_id = 0;
//            $o2->recharge_id = $res[0]['recharge_id'];
//            $o2->flight_id = 0;
//            $o2->hotel_id = 0;
//            $o2->amount = $res[0]['amount'];
//            $o2->transaction_date = $res[0]['recharge_date'];
//            $o2->ip_address = $res[0]['ip_address'];
//            $o2->status = "Refunded";
//            $o2->ref_number = reference_number();
//            $o2->is_active = 1;
//            $o2->transaction_type = "refunded";
//            $o2->comments = "Recharge Failed";
//            $o2->transaction_date = todaysDate();
//            $o2->previous_balance = $o4->amount_balance;
//            $o2->new_balance = $o4->amount_balance + $res[0]['amount'];
//
//            $rid = $insertor->insert_object($o2, "wallet");
//
//            $o4->amount_balance = $o2->new_balance;
//            $o4->user_id = $updater->update_object($o4, "users");
//            $n_msg = "Recharge Failed for Number: " . $o3->mobile;
//            sendnotification_cron($o4->user_id, $n_msg);
//        }
//    }
}
?>
