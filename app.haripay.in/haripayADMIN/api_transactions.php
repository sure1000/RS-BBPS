<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

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






include "html/includes/header.php";
include "html/api_transactions.php";
include "html/includes/footer.php";
include "js/api_transactions.js";
?>