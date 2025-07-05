<?php
session_start();
include "include.php";
include "session.php";

if (isset($_GET['aid'])) {
	$o1->route_id = $_GET['aid'];
} else {
	$o1->route_id = 0;
	$o1->is_active = 1;
}

if ($o1->route_id > 0) {
	$o1 = $factory->get_object($o1->route_id, "routes", "route_id");
}

include "html/includes/header.php";
include "html/route_details.php";
include "html/includes/footer.php";
include "js/route_details.js";
?>