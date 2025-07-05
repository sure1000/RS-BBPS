<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

$sql = "Select * from api order by api_name";
$res = getXbyY($sql);
$rows = count($res);

$total = 0;

include "html/includes/header.php";
include "html/apis.php";
include "html/includes/footer.php";
include "js/apis.js";
?>