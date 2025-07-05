<?php
session_start();
include "include.php";
include "session.php";

if(isset($_GET['aid'])){
    $o1->kyc_id = $_GET['aid'];
}else{
    $o1->kyc_id = 0;
}

if($o1->kyc_id > 0){
    $o1 = $factory->get_object($o1->kyc_id,"kyc", "kyc_id");
    $o2 = $factory->get_object($o1->user_id, "users", "user_id");
    
    unlink("../user_documents/$o1->document_name");
    
    $sql = "Delete from kyc where kyc_id = ".$o1->kyc_id;
    $res = setXbyY($sql);
    
    if($o2->kyc_id == $o1->kyc_id){
        $o2->kyc_id = 0;
        
        $o2->user_id = $updater->update_object($o2,"users");
    }
    
    header("location:user_kyc.php?msgid=3&aid=$o1->user_id");
}else{
    header("location:team.php?msgid=4");
}
?>