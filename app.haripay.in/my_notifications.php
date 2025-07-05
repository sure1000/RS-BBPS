<?php
session_start();

include "include.php";
include "session.php";

$ajax_logout = 1;

$sql_notifications = "Select * from notifications where user_id = ".$o->user_id." and is_active = 1 order by notification_id DESC limit 0,20";
$res_notifications = getXbyY($sql_notifications);
$row_notifications = count($res_notifications);

$sql_clear_notifications = "Update notifications set is_read = 'Yes' where user_id = ".$o->user_id;
$set_clear_notifications = setXbyY($sql_clear_notifications);

include "templates/".$res_template[0]['template_name']."/my_notifications.php";

?>

