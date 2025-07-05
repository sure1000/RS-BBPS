<?php
include "include.php";

if (isset($_POST['dispute_updte'])) {
	$dispute_updte = $_POST['dispute_updte'];
} else {
	$dispute_updte = 0;
}
if ($dispute_updte == 1) {
	$o1->ref_number = $_POST['ref_no_dispute'];

	$sql = "Select * from wallet where wallet_id = '" . $o1->ref_number . "' and transaction_type = 'Recharge' and user_id = " . $o->user_id;
	$res = getXbyY($sql);
	$rows = count($res);

	if ($rows == 1) {

		$disputed = "Yes";
		$sql_update = "Update wallet set disputed = 'Yes' where wallet_id = " . $res[0]['wallet_id'];
		$set_update = setXbyY($sql_update);

		$result['error'] = "0";
		$result['error_msg'] = "Dispute Raised and Admin has been updated accordingly";

		$o2->wallet_id = $res[0]['wallet_id'];
		$o2->user_id = $o->user_id;
		$o2->resolved_by = 0;
		$o2->dispute = $_POST['dispute_issue'];
		$o2->dispute_date = todaysDate();
		$o2->dispute_resolution = "";
		$o2->resolution_date = todaysDate();
		$o2->is_active = 2;

		$o2->dispute_id = $insertor->insert_object($o2, "disputes");

		$email_to = $res_site[0]['email'];
		$email_from = $o->email;
		$email_subject = "Dispute Raised by " . $o->name;

		include "../mails/dispute_recharge.php";

		sendmail($email_from, $email_to, $email_subject, $email_message);

		
	} else {
		$result['error'] = "1";
		$result['error_msg'] = "Recharge Information Mismatch. Please try again";
	}
} else {
	$result['error'] = "1";
	$result['error_msg'] = "Something went wrong. Please try again";
}

echo json_encode($result);
?>