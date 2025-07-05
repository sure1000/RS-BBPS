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
		$o1->authorization_key = md5(reference_number());

		$o1->api_ip_key_id = $updater->update_object($o1, "api_ip_key");
		$msgid = 9;
	} else {
		$msgid = 5;
	}

} else {
	$msgid = 5;
}

header("location: api_ip_key.php?msgid=$msgid");
?>