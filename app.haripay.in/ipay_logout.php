<?php
session_start();

include "include.php";
unset($_SESSION['ipay_customer_id']);

header("location:recharge.php#dmr_pay");
?>