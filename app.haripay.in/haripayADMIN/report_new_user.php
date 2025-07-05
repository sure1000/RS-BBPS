<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;


unset($_SESSION['search_user_new']);
include "html/includes/header.php";
include "html/report_new_user.php";
include "html/includes/footer.php";
include "js/new_user_list.js";
?>