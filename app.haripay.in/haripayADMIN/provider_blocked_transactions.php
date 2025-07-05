<?php
session_start();

include "include.php";
include "session.php";


if(isset($_GET['aid'])){
    $o1->provider_id = $_GET['aid'];
}else if(isset($_POST['provider_id'])){
    $o1->provider_id = $_POST['provider_id'];
}else{
    $o1->provider_id = 0;
}

if($o1->provider_id > 0){
    $o1 = $factory->get_object($o1->provider_id,"providers", "provider_id");
    $provider_name = $o1->provider;
    $trigger_provider = "provider_id = '".$o1->provider_id."'";
}else{
    $provider_name = "All Providers";
    $trigger_provider = "1=1";
}



$tables = 1;

$sql = "Select * from blocked_transactions where $trigger_provider order by amount";
$res = getXbyY($sql);
$rows = count($res);

include "html/includes/header.php";
include "html/provider_blocked_transactions.php";
include "html/includes/footer.php";
?>