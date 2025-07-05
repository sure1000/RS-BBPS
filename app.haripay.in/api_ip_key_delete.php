<?php

session_start();
include "include.php";
include "session.php";

if (isset($_GET['aid'])) {
	$o1->api_ip_key_id = $_GET['aid'];
}

if ($o1->api_ip_key_id > 0) {
	$o1 = $factory->get_object($o1->api_ip_key_id, "api_ip_key", "api_ip_key_id");
} else {
	$o1->api_ip_key_id = 0;
}

if ($o1->api_ip_key_id > 0) {
	if ($o1->user_id == $o->user_id) {
		$sql_delete = "Delete from api_ip_key where api_ip_key_id = " . $o1->api_ip_key_id;
		$res_delete = setXbyY($sql_delete);

		$msgid = 10;
	} else {
		$msgid = 5;
	}

} else {
	$msgid = 5;
}

header("location: api_ip_key.php?msgid=$msgid");
?>