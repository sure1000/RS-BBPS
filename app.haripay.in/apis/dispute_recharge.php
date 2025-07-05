<?php

include "include.php";


if ($_POST['dispute_updte'] == 1) {


    $o1->wallet_id = $_POST['ref_number'];


    $o1 = $factory->get_object($o1->wallet_id, "wallet", "wallet_id");
    $status = $o1->status;

    $table_name = 'wallet';
    if ($o1->wallet_id == "" || $o1->wallet_id == "0") {
        $o1 = $factory->get_object($_POST['wallet_id'], "wallet_backup", "wallet_id");
        $table_name = "wallet_backup";
    }

    if ($o1->disputed == "No") {
        $o1->disputed = "Yes";
        $o1->wallet_id = $updater->update_object($o1, $table_name);
        $sql_BACK = "select wallet_id from wallet_backup where wallet_id ='" . $o1->wallet_id . "'";
        $res_BACK = getXbyY($sql_BACK);
        $row_BACK = count($res_BACK);
        if ($row_BACK > 0) {
            $query = "Update wallet_backup set disputed='Yes' where wallet_id = " . $res_BACK[0]['wallet_id'];
            $set = setXbyY($query);
        }
        $o2->wallet_id = $o1->wallet_id;
        $o2->dispute_date = todaysDate();
        $o2->status = 'Under Review';
        $o2->update_date = '0000-00-00';
        $o2->remark = '';
        $o2->is_active = '1';
        $o2->dispute_recharge_id = $insertor->insert_object($o2, "dispute_recharge");

        insert_notifications($o->user_id, "Dispute Raised  Mobile number : " . $o1->mobile_number . " & order id :" . $o1->wallet_id, "Dispute");
        $result['error'] = 0;
        $result['error_msg'] = "Information Updated Successfully For Txn id:" . $o1->wallet_id;
    } else {
        $result['error'] = 1;
        $result['error_msg'] = "Already in Dispute";
    }
} else {
    $result['error'] = 1;
    $result['error_msg'] = "Something went wrong. Please try again";
}

echo json_encode($result);
?>