<?php

include 'include.php';
$RequestStatus = $_GET['STATUS'];
$ClientId = $_GET['CLIENTID'];
$OperatorRef = $_GET['OPERSTATUSTORID'];

if ($ClientId != "") {

    $sql = "Select wallet_id, user_id from wallet where   STATUS = 'Pending' and  ref_number = '" . $ClientId . "'";
    $res = getXbyY($sql);
    $row = count($res);

    
    if ($row == 1) {
        $o1 = $factory->get_object($res[0]['wallet_id'], "wallet", "wallet_id");

        if ($RequestStatus == 'SUCCESS') {
            $STATUS = 'Success';
        } else if ($RequestStatus == 'FSTATUSILURE') {
            $STATUS = 'Failed';
        }
        $o = $factory->get_object($res[0]['user_id'], "users", "user_id");
         $o1->updated_at = todaysDate();
        
        $o1->response_url = serialize($_GET);
        if ($STATUS == "Success") {
            $o1->STATUS = "Success";
            $o1->opid = $OperatorRef;
            $o1->wallet_id = $updater->update_object($o1, "wallet");
            set_commission($o1, $o, $o1->provider_type);
        } else if ($STATUS == "Failed") {
            $o1->STATUS = "Failed";
            $o1->wallet_id = $updater->update_object($o1, "wallet");
            $o1->transaction_type = "Refund";
            $o1->STATUS = "Success";
            $o1 = wallet_insert($o, $o1);
        }
    }
}
echo "Final";
?>
