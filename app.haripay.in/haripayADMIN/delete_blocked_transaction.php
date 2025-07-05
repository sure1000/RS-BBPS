<?php

session_start();

include "include.php";
include "session.php";

if (isset($_GET['aid'])) {
    $o1->blocked_transaction_id = $_GET['aid'];
} else {
    $o1->blocked_transaction_id = 0;
}

if($o1->blocked_transaction_id > 0){
    $sql_delete = "Delete from blocked_transactions where blocked_transaction_id = ".$o1->blocked_transaction_id;
    $set_delete = setXbyY($sql_delete);
    
    header("location:provider_blocked_transactions.php?msgid=");
}else{
    header("location:provider_blocked_transactions.php?msgid=4");
}

?>