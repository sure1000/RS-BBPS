<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

$sql = "Select * from notice_board order by notice_date desc";
$res = getXbyY($sql);
$rows = count($res);

include "html/includes/header.php";
include "html/notice_board.php";
include "html/includes/footer.php";
?>