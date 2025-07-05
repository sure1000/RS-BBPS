<?php
session_start();

include "include.php";
include "session.php";

include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/profile.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";
include "js/profile_update.js";
?>
