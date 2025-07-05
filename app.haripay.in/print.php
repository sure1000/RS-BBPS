<?php
session_start();
include "include.php";
include "session.php";

if (isset($_GET['ref_number'])) {
	$ref_number = $_GET['ref_number'];
} else {
	header("location:index.php?msgid=3");
}

$sql = "Select * from wallet where ref_number = '" . $ref_number . "' and user_id = " . $o->user_id . " and transaction_type = 'Recharge'";
$res = getXbyY($sql);
$rows = count($res);

if ($rows == 1) {
	include $path . "print.php";
} else {
	header("location:index.php?msgid=3");
}
?>