<?php
session_start();

include "include.php";
include "session.php";

$ajax_logout = 1;

$sql_notifications = "select * from notifications WHERE user_id = 1";
$res_notifications = getXbyY($sql_notifications);
$row_notifications = count($res_notifications);



// pt($res_notifications);
// $sql_clear_notifications = "Update disputes set is_read = 'Yes' where user_id = ".$o->user_id;
// $set_clear_notifications = setXbyY($sql_clear_notifications);

include "html/my_admin_notifications.php";
//".$res_template[0]['template_name']."
?>
