<?php
session_start();

include "include.php";
include "session.php";

if ($o->user_type == "Distributor"  || $o->user_type == "Master Distributor") {
	
	
		$tables = 1;
        $mtype = "Retailer";
        if($o->user_type == "Distributor"){
	    $sql = "Select * from users where user_type='Retailer' and (parent_id = '".$o->user_id."') and user_id !='".$o->user_id."'  and is_active = 1";
        }
       else if($o->user_type == "Master Distributor"){
			$mtype = "Distributor";
            $sql = "Select * from users where user_type='Distributor'  and user_id !='".$o->user_id."' and (parent_id = '".$o->user_id."') and is_active = 1";
        }
    $res = getXbyY($sql);
	$rows = count($res);


	include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
	include "templates/" . $res_template[0]['template_name'] . "/team.php";
	include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";
} else {
	header("location:index.php?msgid=11");
}

?>