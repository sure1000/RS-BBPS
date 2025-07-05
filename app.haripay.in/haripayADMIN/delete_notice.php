<?php
session_start();

include "include.php";
include "session.php";

if (isset($_GET['aid'])) {
    $o1->user_id = $_GET['aid'];
    if($o1->user_id > 0){
    $sql_delete = "delete from notifications where user_id ='".$o1->user_id."'";
    $set_delete = setXbyY($sql_delete);

    
	}else {
//     $o1->notification_id = 0;
	$sql_delete_all = "delete from notifications";
    $set_delete_all = setXbyY($sql_delete_all);
	}

    header("location:notification.php?msgid=");
}
else{
    header("location:notification.php?msgid=");
	}


?>