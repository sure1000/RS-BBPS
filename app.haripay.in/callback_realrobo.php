 <?php

include 'include.php';

$RequestStatus = $_GET['status'];
$ClientId = $_GET['reqid'];
$OperatorRef = $_GET['opid'];
$balance = $_GET['balance'];
$message = $_GET['message'];

if ($ClientId != "") {

	$sql = "Select wallet_id, user_id from wallet where   status = 'Pending' and  ref_number = '" . $ClientId . "'";
	$res = getXbyY($sql);
	$row = count($res);

	////http://yourdomain.com/responsepage?reqid=@reqid&status=@status&opid=@opid&balance=@balance&message=@message

	if ($row == 1) {
		$o1 = $factory->get_object($res[0]['wallet_id'], "wallet", "wallet_id");

		if ($RequestStatus == 'Success') {
			$status = 'Success';
		} else if ($RequestStatus == 'PENDING') {
			$status = 'Pending';
		} else if ($RequestStatus == 'Failed') {
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
