<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

unset($_SESSION['wallet_search']);

include "html/includes/header.php";
include "html/wallet_history.php";
include "html/includes/footer.php";
include "js/wallet_history.js";

?>