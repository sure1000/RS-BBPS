<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;
unset($_SESSION['recharge_report']);


$dd = format_date_only(todaysDate());

include "templates/".$res_template[0]['template_name']."/includes/header.php";
include "templates/".$res_template[0]['template_name']."/recharge_reports.php";
include "templates/".$res_template[0]['template_name']."/includes/footer.php";
include "js/recharge_report.js";

?>