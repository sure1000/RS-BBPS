<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

unset($_SESSION['search']);

include "templates/".$res_template[0]['template_name']."/includes/header.php";
include "templates/".$res_template[0]['template_name']."/turnover.php";
include "templates/".$res_template[0]['template_name']."/includes/footer.php";
include "js/turnover.js";

?>