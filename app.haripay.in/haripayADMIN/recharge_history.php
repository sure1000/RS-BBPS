<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

unset($_SESSION['recharge_search']);

include "html/includes/header.php";
include "html/recharge_history.php";
include "html/includes/footer.php";
include "js/recharge_history.js";

?>