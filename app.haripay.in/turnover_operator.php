<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

unset($_SESSION['search']);

if (isset($_GET['from'])) {
	$_SESSION['search']['from_date'] = $_GET['from'];
}
if (isset($_GET['to'])) {
	$_SESSION['search']['to_date'] = $_GET['to'];
}

include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/turnover_operator.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";
include "js/turnover_operator.js";

?>