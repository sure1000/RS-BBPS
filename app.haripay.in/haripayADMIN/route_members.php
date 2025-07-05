<?php
session_start();

include "include.php";
include "session.php";

$tables = 1;

$sql = "Select A.*, B.api_name from users as A left join api as B on (A.route = B.api_id) where A.is_active = 1 and A.user_type != 'Admin'";
$res = getXbyY($sql);
$rows = count($res);

include "html/includes/header.php";
include "html/route_members.php";
include "html/includes/footer.php";
?>