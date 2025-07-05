<?php
session_start();

include "include.php";
include "session.php";

if ( $o->user_type == "Distributor" || $o->user_type == "DSE") {

	$tables = 1;

	$sql = "Select * from users where user_type='DSE' and user_id !='".$o->user_id."' and ( parent_id = '".$o->user_id."' ) and is_active = 1";
        $res = getXbyY($sql);
	$rows = count($res);
         $mtype = "DSE";

	include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
	include "templates/" . $res_template[0]['template_name'] . "/team.php";
	include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";
} else {
	header("location:index.php?msgid=11");
}
?>