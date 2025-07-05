<?php
session_start();

unset($_SESSION['rech_customer_id']);


header("location:recharge.php#dmr");
?>