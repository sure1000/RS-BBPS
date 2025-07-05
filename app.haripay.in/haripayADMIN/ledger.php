<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

unset($_SESSION['search_ledger']);

include "html/includes/header.php";
include "html/ledger.php";
include "html/includes/footer.php";
include "js/ledger.js";

?>