<?php

session_start();

include "include.php";
include "session.php";
//pt($_GET['aid']);
if($_GET['aid'] > 0){
	$o1->dmr_commission_id=$_GET['aid'];
	$o1=$factory->get_object($o1->dmr_commission_id,'dmr_commission','dmr_commission_id');
	//pt($o1);
}


include "html/includes/header.php";
include "html/dmr_commission_details.php";
include "html/includes/footer.php";
include "js/dmr_commission_details.js";
?>