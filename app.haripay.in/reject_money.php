<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

$sql = "Select A.*,B.user_type,B.name,B.email from request_money as A left join users as B on (A.user_id=B.user_id) where A.status='Rejected' order by A.request_date Desc ";
$res = getXbyY($sql);
$rows = count($res);

include "templates/" . $res_template[0]['template_name'] . "/includes/header.php";
include "templates/" . $res_template[0]['template_name'] . "/reject_money.php";
include "templates/" . $res_template[0]['template_name'] . "/includes/footer.php";
//include "js/payment_request.js";

?>
