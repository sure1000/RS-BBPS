<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

if (isset($_GET['aid'])) {
	$o1->user_id = $_GET['aid'];
} else {
	$o1->user_id = 0;
}

if ($o1->user_id > 0) {
	$o1 = $factory->get_object($o1->user_id, "users", "user_id");
	$phone_email = $o1->mobile;
} else {
	$o1->user_id = 0;
	$phone_email = "";
}

if ($updte == 1) {
	//pt($_POST);die();
	$o1->user_id = $_POST['user_id'];
	$o1 = $factory->get_object($o1->user_id, "users", "user_id");

	if ($o1->user_id == "" || $o1->user_id == "0") {
		header("location:team.php?msgid=4");
	}

	$o2->amount = $_POST['amount'];
	$o2->total_amount =$_POST['amount'];
	$o2->credit_wallet = $_POST['credit_wallet'];
	$o2->update_credit = $_POST['update_credit'];
	$o2->parent_id = 0;
	$o2->api_id = 0;
	$o2->api_name = "";
	$o2->user_id = $o1->user_id;
	$o2->user_name = $o1->user_name . " " . $o1->name;
	$o2->user_1_id = $o->user_id;
	$o2->user_1_name = $o->user_name . " " . $o->name;
	$o2->transaction_type = "Reverse";
	$o2->ref_number = reference_number();
	$o2->cash_credit = "Cash";
	$o2->status = "Success";
	$o2->disputed ='No';
	$o2->api_old_balance = "0";
	$o2->api_amount = "0";
	$o2->api_new_balance = "0";
	$o2->user_old_balance = $o1->amount_balance;
	if ($o2->credit_wallet == "Wallet") {
		$o2->user_new_balance = $o1->amount_balance - $o2->amount;
		$o2->transaction_details = "Rs. " . $o2->amount . " Money Deducted from Your Account By " . $o->user_name . " " . $o->name;
		if ($o2->update_credit == "Yes") {
			$o2->comment = "Credit Update";
		} else {
			$o2->comment = "Cash Deducted from wallet";
		}
	} else {
		$o2->user_new_balance = $o1->amount_balance;
		$o2->transaction_details = "Rs. " . $o2->amount . " Money Recieved By Admin against Standing Credit";
		$o2->comment = "Credit Update";
	}

	$o2->transaction_date = todaysDate();
	$o2->month_year = date("F") . "-" . date("Y");
	$o2->recharge_path = "Web";
	$o2->ip_address = $_SERVER['REMOTE_ADDR'];
	$o2->is_active = 1;

	$o2->wallet_id = $insertor->insert_object($o2, "wallet");

	$o1->amount_balance = $o2->user_new_balance;
	if ($o2->credit_wallet == "Credit") {
		$o1->credit_amount = $o1->credit_amount - $o2->amount;
	} else {
		if ($o2->update_credit == "Yes") {
			$o1->credit_amount = $o1->credit_amount - $o2->amount;
		}
	}
	$o1->user_id = $updater->update_object($o1, "users");

	insert_notifications($o1->user_id, $o2->transaction_details);

	$email_from = $res_site[0]['email'];
	$email_to = $o1->email;
	$email_subject = $res_site[0]['site_name'] . " " . $o2->transaction_details;
	//$email_message = "Verification Code : ".$o->new_password;
	$email_message = "<html><head><title>Wallet update for " . $res_site[0]['site_name'] . "</title></head><body style='font-family: Arial, Helvetica, sans-serif;'>
    <table style='border:1px solid #ccc;border-radius:8px;' cellpadding='8'>
    <tr><td><img src='" . $res_site[0]['site_url'] . "/img/" . $res_site[0]['logo'] . "' width='256' /></td></tr>
    <tr><td style>Greetings " . $o1->name . "</td></tr>
    <tr><td>Your " . $res[0]['site_name'] . " wallet has been updated. The details for the same are as following:</td></tr>
    <tr><td><b>Old Amount: INR. " . $o2->user_old_balance . "</td></tr>
    <tr><td><b>Amount Sent: INR. " . $o2->amount . "</td></tr>
    <tr><td><b>New Amount: INR. " . $o2->user_new_balance . "</td></tr>
    
    <tr><td>The same will reflect in your wallet on " . $res[$i]['site_name'] . ". Incase, it is not showing, please logout and login again</td></tr>
    <tr><td>Thanking you</td></tr>
    <tr><td>Admin - " . $res_site[0]['site_name'] . "</td></tr>
    <tr><td>Email: " . $res_site[0]['email'] . "</td></tr>
    <tr><td>Phone: " . $res_site[0]['mobile'] . "</td></tr></table></body></html>";

	sendmail($email_from, $email_to, $email_subject, $email_message);

	header("location:team.php?msgid=5");
}

include "html/includes/header.php";
include "html/recieve_money.php";
include "html/includes/footer.php";
include "js/recieve_money.js";
?>
