<?php

session_start();

include "include.php";
include "session.php";

if (isset($_GET['aid'])) {
    $o1->route_detail_id = $_GET['aid'];
    $type = $_GET['type'];
    if ($o1->route_detail_id > 0) {
        $o1 = $factory->get_object($o1->route_detail_id, "route_details", "route_detail_id");
        $sql_delete = "delete from route_details where route_detail_id ='" . $o1->route_detail_id . "'";
        $set_delete = setXbyY($sql_delete);
        if($type == "amount"){
        header("location:route_per_amount.php");
        }else{
        header("location:route_member_details.php?aid=" . $o1->user_id);
        }
    }
}
?>