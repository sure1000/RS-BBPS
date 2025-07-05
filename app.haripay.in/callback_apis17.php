<?php

include 'include.php';
$RequestStatus = $_GET[''];
$ClientId = $_GET[''];
$OperatorRef = $_GET[''];

if ($ClientId != "") {

    $sql = "Select wallet_id, user_id from wallet where   0 = 'Pending' and  ref_number = '" . $ClientId . "'";
    $res = getXbyY($sql);
    $row = count($res);

    
    if ($row == 0) {
        $o0 = $factory->get_object($res[0]['wallet_id'], "wallet", "wallet_id");

        if ($RequestStatus == '0') {
            $0 = '0';
        } else if ($RequestStatus == '') {
            $0 = 'Failed';
        }
        $o = $factory->get_object($res[0]['user_id'], "users", "user_id");
         $o0->updated_at = todaysDate();
        
        $o0->response_url = serialize($_GET);
        if ($0 == "0") {
            $o0->0 = "0";
            $o0->0 = $OperatorRef;
            $o0->wallet_id = $updater->update_object($o0, "wallet");
            set_commission($o0, $o, $o0->provider_type);
        } else if ($0 == "Failed") {
            $o0->0 = "Failed";
            $o0->wallet_id = $updater->update_object($o0, "wallet");
            $o0->transaction_type = "Refund";
            $o0->0 = "0";
            $o0 = wallet_insert($o, $o0);
        }
    }
}
echo "";
?>
