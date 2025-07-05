<?php

session_start();

include "include.php";
include "session.php";
$tables = 1;
if(isset($_GET['aid'])){
     $o1->user_id = $_GET['aid'];
} else {
    $o1->user_id = 0;
}

if($o1->user_id > 0){
 $o1 = $factory->get_object($o1->user_id, "users", "user_id");
 // pt($o1);
// $sql = "Select * from notifications group by user_id left join";
$sql ="Select * from notifications where user_id = '" .$o1->user_id ."' ";
$res = getXbyY($sql);
$rows = count($res);

}
include "html/includes/header.php";
include "html/view_notification.php";
include "html/includes/footer.php";
?>