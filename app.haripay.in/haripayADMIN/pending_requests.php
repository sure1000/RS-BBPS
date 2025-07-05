<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

$sql = "Select A.*,B.user_type,B.name,B.email ,B.mobile from request_money as A left join users as B on (A.user_id=B.user_id) where A.status='Pending' order by A.request_date Desc ";
$res = getXbyY($sql);
$rows = count($res);

include "html/includes/header.php";
include "html/pending_requests.php";
include "html/includes/footer.php";
include "js/pending_request.js";
?>