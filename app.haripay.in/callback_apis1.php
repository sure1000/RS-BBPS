<?php

include 'include.php';
$RequestStatus = $_GET['status'];
$ClientId = $_GET['AGENTID'];
$OperatorRef = $_GET['LIVEID'];

if ($ClientId != "") {

    $sql = "Select wallet_id, user_id from wallet where   status = 'Pending' and  ref_number = '" . $ClientId . "'";
    $res = getXbyY($sql);
    $row = count($res);

    
    if ($row == 1) {
        $o1 = $factory->get_object($res[0]['wallet_id'], "wallet", "wallet_id");

        if ($RequestStatus == '2') {
            $status = 'Success';
        } else if ($RequestStatus == '3') {
            $status = 'Failed';
        }
        $o = $factory->get_object($res[0]['user_id'], "users", "user_id");
         $o1->updated_at = todaysDate();
        
        $o1->response_url = serialize($_GET);
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
echo "FINAL";
?>
