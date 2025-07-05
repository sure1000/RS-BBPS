<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

unset($_SESSION['search']);

include "html/includes/header.php";
include "html/all_history.php";
include "html/includes/footer.php";
include "js/all_transaction_history.js";

?>