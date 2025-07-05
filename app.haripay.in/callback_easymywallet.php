<?php

include 'include.php';
//0||33309|35073000343|BR00034R1PWK|0|Success

//http://www.yourdomain.com/pagename?Message=<message>
$message = explode("|", $_REQUEST['Message']);
$RequestStatus = $message[0];
$TransactionId = $message[1];
$ClientId = $message[2];
$OperatorRef = $message[3];
$EasymywalletId = $message[4];
$ErrorCode = $message[5];
$ResponseMessage = $message[6];

if ($ClientId != "") {

	$sql = "Select wallet_id , user_id from wallet where   status = 'Pending' and  ref_number = '" . $ClientId . "'";
	$res = getXbyY($sql);
	$row = count($res);

	if ($row == 1) {

		$o1 = $factory->get_object($res[0]['wallet_id'], "wallet", "wallet_id");
		$o1->update_at = todaysDate();
		$o1->comment = $o1->comment . " -" . $ResponseMessage;

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
