<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

unset($_SESSION['search']);

$_SESSION['search']['status'] = "Pending";

include "html/includes/header.php";
include "html/money_requests.php";
include "html/includes/footer.php";
include "js/money_requests.js";
?>