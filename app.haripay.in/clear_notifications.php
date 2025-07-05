<?php
session_start();

include "include.php";
include "session.php";

$ajax_logout = 1;

$sql_notifications = "Delete from notifications where user_id = " . $o->user_id;
$res_notifications = setXbyY($sql_notifications);

$row_notifications = 0;

include "templates/" . $res_template[0]['template_name'] . "/my_notifications.php";

?>
