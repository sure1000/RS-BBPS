<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

unset($_SESSION['search']);

if (isset($_GET['from'])) {
	$from_date = $_GET['from'];
} else {
	$from_date = "";
}
if (isset($_GET['to'])) {
	$to_date = $_GET['to'];
} else {
	$to_date = "";
}

if ($from_date != "") {
	$_SESSION['search']['from_date'] = $from_date;
}
if ($to_date != "") {
	$_SESSION['search']['to_date'] = $to_date;
}

include "html/includes/header.php";
include "html/profit_loss.php";
include "html/includes/footer.php";
include "js/profit_loss.js";

?>