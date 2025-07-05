<?php

session_start();

include "include.php";
include "session.php";

if (isset($_GET['aid'])) {
    $o1->blocked_transaction_id = $_GET['aid'];
} else {
    $o1->blocked_transaction_id = 0;
}


if($updte == 1){
    $o1->provider_id = $_POST['provider_id'];
    
    if($o1->provider_id > 0){
        $o1->provider = get_provider_name($o1->provider_id);
    }else{
        $o1->provider = "All";
    }
    $o1->amount = $_POST['amount'];
    $o1->is_active = 1;
    
    if($o1->blocked_transaction_id > 0){
        $o1->blocked_transaction_id = $updater->update_object($o1,"blocked_transactions");
    }else{
        $o1->blocked_transaction_id = $insertor->insert_object($o1,"blocked_transactions");
    }
    
    header("location: provider_blocked_transactions.php?msgid=3");
}

if($o1->blocked_transaction_id > 0){
    $o1 = $factory->get_object($o1->blocked_transaction_id, "blocked_transactions", "blocked_transaction_id");
}

include "html/includes/header.php";
include "html/blocked_transaction.php";
include "html/includes/footer.php";
?>