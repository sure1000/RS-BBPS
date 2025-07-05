<?php
session_start();
include "include.php";
include "session.php";

$tables = 1;


$sql_wallet = "Select * from wallet where  user_1_id = '".$o->user_id."' and (transaction_type = 'Recieve Money' or transaction_type = 'Reverse' ) and is_active = 1 order by wallet_id Desc";
$res_wallet = getXbyY($sql_wallet);
$row_wallet = count($res_wallet);



include "html/includes/header.php";
include "html/admin_fund.php";
include "html/includes/footer.php";

?>

