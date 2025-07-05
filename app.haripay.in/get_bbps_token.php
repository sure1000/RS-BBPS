<?php

session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

$result = get_bbps_token($o);
pt($result);

?>