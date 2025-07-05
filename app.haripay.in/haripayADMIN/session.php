<?php

if (isset($_SESSION['recharge_admin_id'])) {
    $o->user_id = $_SESSION['recharge_admin_id'];
    $o = $factory->get_object($o->user_id, "users", "user_id");
    
    if($o->profile_pic == ""){
        $o->profile_pic = "../img/avatar.svg";
    }else{
        $o->profile_pic = "../profile_picture/thumbs/".$o->profile_pic;
    }
} else {
    if ($ajax_logout == 1) {
        $result['ajax_logout'] = 1;
    } else {
        header("location:login.php?msgid=2");
    }
}
?>