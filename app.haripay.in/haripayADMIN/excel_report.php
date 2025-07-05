<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

unset($_SESSION['report_search']);

include "html/includes/header.php";
include "html/excel_report.php";
include "html/includes/footer.php";
include "js/excel_report.js";

?>