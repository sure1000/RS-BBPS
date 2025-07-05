<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;
$page_name="send_sms";




include "html/includes/header.php";
include "html/send_sms.php";
include "html/includes/footer.php";
include "js/send_sms.js";
?>
