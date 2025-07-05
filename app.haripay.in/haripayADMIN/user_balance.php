<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

$sql = "Select * from users where is_active = 1 and user_type != 'Admin' order by user_name";
$res = getXbyY($sql);
$rows = count($res);

$total = 0;
$total_credit = 0;

include "html/includes/header.php";
include "html/user_balance.php";
include "html/includes/footer.php";
?>