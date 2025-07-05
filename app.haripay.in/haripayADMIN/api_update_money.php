<?php
session_start();

include "include.php";
include "session.php";
$page_name = "api_update_money";

if (isset($_GET['aid'])) {
	$o1->api_id = $_GET['aid'];
} else {
	$o1->api_id = 0;
}

if ($o1->api_id > 0) {
	$o1 = $factory->get_object($o1->api_id, "api", "api_id");
}

if ($o1->api_id == "" || $o1->apid_id == "0") {
	header("location:apis.php?msgid=4");
}

if ($updte == 1) {
	
	$o2->api_id = $_POST['api_id'];
        
	$o2->payment_mode = $_POST['payment_mode'];
	$o2->cash_credit = $_POST['cash_credit'];
	$o2->amount = $_POST['amount'];
	$o2->transaction_date = todaysDate();
	$o2->update_wallet = $_POST['update_wallet'];
	$o2->transaction_details = $_POST['transaction_details'];
	$o2->is_active = 1;
	
	$o2->api_wallet_id = $insertor->insert_object($o2,"api_wallet");


	if($o2->update_wallet == "Yes"){            
            //wallet_insert($o, "0", "", $o2->api_id, "API Top up", $o2->cash_credit, $o2->amount, "0", "0", "", "Success", "Web", "0", " ", "0");            
            $o3 = new wallet;
            
            $o3->api_id = $o2->api_id;
            $o3->transaction_type = "API Top up";
            $o3->cash_credit = $o2->cash_credit;
            $o3->api_amount = $o2->amount;
            $o3->status = "Success";
            $o3->recharge_path = "web";
            $o3 = wallet_insert($o, $o3);
	}
	header("location:apis.php?msgid=3");
}

include "html/includes/header.php";
include "html/api_update_money.php";
include "html/includes/footer.php";

?>