<?php
session_start();

include "include.php";
unset($_SESSION['paytm_user_id']);

header("location:recharge.php#dmr");
?>