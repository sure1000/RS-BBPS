<?php
session_start();
include "include.php";
include "session.php";


if (isset($_GET['api_id'])) {
	$o1->api_id = $_GET['api_id'];
} else {
	$o1->api_id = 0;
}

if ($o1->api_id > 0) {
	$o1 = $factory->get_object($o1->api_id, "api", "api_id");
}

if ($o1->api_id == "" || $o1->apid_id == "0") {
	header("location:apis.php?msgid=4");
}

$sql = "Select * from wallet where api_id = ".$o1->api_id." order by transaction_date DESC limit 0,50";
$res = getXbyY($sql);
$rows = count($res);

$sql_total = "Select count(wallet_id) as total_transactions from wallet where api_id = ".$o1->api_id;
$res_total = getXbyY($sql_total);


include "html/includes/header.php";
include "html/api_wallet.php";
include "html/includes/footer.php";
include "js/api_wallet.js";
?>