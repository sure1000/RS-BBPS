<?php

include 'include.php';

$RequestStatus = $_GET['Status'];
$ClientId = $_GET['TransID'];
$OperatorRef = $_GET['OperatorRef'];
$api_number = $_GET['APITransID'];
$Amount=$GET['Amount'];
$ErrorCode=$_GET['ErrorCode'];

if ($ClientId != "") {

    $sql = "Select wallet_id, user_id from wallet where   status = 'Pending' and  ref_number = '" . $ClientId . "'";
    $res = getXbyY($sql);
    $row = count($res);


    if ($row == 1) {
        $o1 = $factory->get_object($res[0]['wallet_id'], "wallet", "wallet_id");

        if ($RequestStatus == 'success' || $RequestStatus == 'Success' || $RequestStatus == 'SUCCESS') {
            $status = 'Success';
        } else if ($RequestStatus == 'Pending' || $RequestStatus =='Queued') {
            $status = 'Pending';
        } else if ($RequestStatus == 'Failed' || $RequestStatus == 'failed' || $RequestStatus == 'FAILED' || $RequestStatus == 'Failure' || $RequestStatus == 'FAILURE') {
            $status = 'Failed';
        }
        $o = $factory->get_object($res[0]['user_id'], "users", "user_id");
        $o1->api_number = $api_number;
        $o1->updated_at = todaysDate();
     
        if ($status == "Success") {
            $o1->status = "Success";
            $o1->opid = $OperatorRef;
            $o1->wallet_id = $updater->update_object($o1, "wallet");
            set_commission($o1, $o, $o1->provider_type);
        } else if ($status == "Failed") {
            $o1->status = "Failed";
            $o1->wallet_id = $updater->update_object($o1, "wallet");

            $o1->transaction_type = "Refund";
            $o1->status = "Success";
            $o1 = wallet_insert($o, $o1);
        }
    }
}
?>
