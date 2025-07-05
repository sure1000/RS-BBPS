<?php
session_start();

include "include.php";
include "session.php";

$ajax_logout = 1;

$sql_notifications = "select A.*,B.ref_number, B.user_name FROM disputes AS A LEFT JOIN wallet AS B ON (A.wallet_id = B.wallet_id) WHERE A.is_active = 2 ORDER BY A.dispute_id DESC limit 0,10";
$res_notifications = getXbyY($sql_notifications);
$row_notifications = count($res_notifications);



// pt($res_notifications);
// $sql_clear_notifications = "Update disputes set is_read = 'Yes' where user_id = ".$o->user_id;
// $set_clear_notifications = setXbyY($sql_clear_notifications);

include "html/my_notifications.php";
//".$res_template[0]['template_name']."
?>
