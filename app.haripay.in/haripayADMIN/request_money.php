<?php
session_start();

include "include.php";
include "session.php";

$updte = $_POST['updte_request'];

if ($updte == 1) {
	$o1->request_money_id = $_POST['request_money_id'];
	$o1 = $factory->get_object($o1->request_money_id, "request_money", "request_money_id");
	$o2 = $factory->get_object($o1->user_id, "users", "user_id");

	$o1->decision_by = $o->user_id;
	$o1->decision = $_POST['decision'];
	$o1->decision_date = todaysDate();

	$old_amount = $o2->amount_balance;

	if (isset($_POST['process_it'])) {
		if ($o1->status == "Pending" || $o1->status == "Rejected") {
			$o1->status = "Transferred";

			if ($o1->decision == "") {
				$o1->decision = "Approved";
			}

			$o1->request_money_id = $updater->update_object($o1, "request_money");
			$msg_id = 6;

			$decision = "Approved";

			$o3 = new wallet;

			$o3->user_1_id = $o->user_id;
			$o3->user_1_name = $o->user_name;
			$o3->transaction_type = "Recieve Money";
			$o3->cash_credit = "Cash";
			$o3->amount = $o1->amount;
			$o3->status = "Success";
			$o3->opid = $o1->request_money_id;

			$o3->wallet_id = wallet_insert($o2, $o3);
		}

	}

	if (isset($_POST['reject_it'])) {
		if ($o1->decision == "") {
			$o1->decision = "Rejected";
		}
		$decision = "Rejected";
		if ($o1->status == "Pending") {
			$o1->status = "Rejected";
			$o1->request_money_id = $updater->update_object($o1, "request_money");

		} else if ($o1->status == "Transferred") {
			$o1->status = "Rejected";
			$o1->request_money_id = $updater->update_object($o1, "request_money");

			$o3 = new wallet;

			$o3->user_1_id = $o->user_id;
			$o3->user_1_name = $o->user_name;
			$o3->transaction_type = "Reverse";
			$o3->cash_credit = "Cash";
			$o3->amount = $o1->amount;
			$o3->status = "Success";
			$o3->opid = $o1->request_money_id;

			$o3->wallet_id = wallet_insert($o2, $o3);

		}
		$msg_id = 7;

	}

	$notification = "Admin has " . $decision . " your Rs. " . $o1->amount . " update wallet Request";
	insert_notifications($o2->user_id, $notification);

	$email_subject = $res_site[0]['site_name'] . " has " . $decision . " your Rs. " . $o1->amount . " update wallet Request";
	include "mails/request_money.php";

	sendmail($res_site[0]['email'], $o2->email, $email_subject, $email_message);

} else {
	$msg_id = 4;
}
header("location:money_requests.php?msgid=$msg_id");
?>