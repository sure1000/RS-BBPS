<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

unset($_SESSION['search']);

$sql="Select * from users where user_type='Retailer' and parent_id = '".$o->user_id."' and is_active = 1";
$res=getXbyY($sql);
$row=count($res);


include "templates/".$res_template[0]['template_name']."/includes/header.php";
include "templates/".$res_template[0]['template_name']."/wallet_history.php";
include "templates/".$res_template[0]['template_name']."/includes/footer.php";
include "js/wallet_history.js";

?>