<?php

include 'include.php';


//client end
//URL?TransactionReference=MRC0010282205&MobileNo=9999999999&Provider=BSNL&Amount=12.00&ServiceType=M&IsPostpaid=N&SystemReference=MCC105&Status=2+%7c+Recharge+Unsuccessful+%7c+Reason%3a+Reversed+Transaction

$RequestStatus = substr($_REQUEST['Status'], 0, 1);
$TransactionId = $_REQUEST['TransactionReference'];
$ClientId = '';
$OperatorRef = $_REQUEST['SystemReference'];


if ($TransactionId != "") {

    $sql = "Select wallet_id from wallet where   status = 'Pending' and  api_number = '" . $TransactionId . "'";
    $res = getXbyY($sql);
    $row = count($res);

    if ($row == 1) {

        $o1 = $factory->get_object($res[0]['wallet_id'], "wallet", "wallet_id");


        if ($RequestStatus == '0') {
            $status = 'Success';
        } else if ($RequestStatus == '1') {
            $status = 'Pending';
        } else if ($RequestStatus == '2') {
            $status = 'Failed';
        }
        $o = $factory->get_object($res[0]['user_id'], "users", "user_id");
        if ($status == "Success") {
            $o1->status = "Success";
            $o1->opid = $OperatorRef;
            $o1->wallet_id = $updater->update_object($o1, "wallet");
            set_commission($o1, $o, $o1->provider_type);
        } else if ($status == "Failed") {
            $o1->status = "Failed";
            $o1->wallet_id = $updater->update_object($o1, "wallet");
            //$o1 = wallet_insert($o, "0", "", $o1->api_id, "Refund", "Cash", $o1->amount, $o1->amount, $o1->provider_id, $o1->mobile_number, "Success", "Web", $o1->circle_id, $o1->circle, $o1->wallet_id);
            
            $o1->transaction_type = "Refund";
            $o1->status = "Success";
            $o1 = wallet_insert($o, $o1);
        }
    }
}
?>
