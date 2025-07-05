<?php

session_start();
include "include.php";
include "session.php";

if(isset($_GET['aid'])){
    $o1->user_id = $_GET['aid'];
}else{
    header("location:team.php?msgid=4");
}

if($o1->user_id > 0){
    $o1 = $factory->get_object($o1->user_id,"users", "user_id");
}

if($o1->user_id == "" || $o1->user_id == 0){
    header("location:team.php?msgid=4");
}

if($updte == 1){
    $o2->user_id = $o1->user_id;
    $o2->document_type = $_POST['document_type'];
    $o2->upload_date = todaysDate();
    $o2->is_active = $_POST['is_active'];
    
    $o2->kyc_id = $insertor->insert_object($o2, "kyc");
    
    if($o1->kyc_id == 0 && $o2->is_active == 1){
        $o1->kyc_id = $o2->kyc_id;
        $o->user_id = $updater->update_object($o1,"users");
    }
    
    if ($_FILES['document_name']['name'] != "") {
        if ($o2->document_name != "") {
            $img_link = "../user_documents/" . $o2->document_name;
            unlink($img_link);
        }

        $tmpfile = $_FILES['document_name']['tmp_name'];
        $source = "../user_documents/";
        $file_extension = explode(".", $_FILES['document_name']['name']);
        $destination = $o1->user_id."_".$o2->document_type."." . end($file_extension);
        $thumbnail = 0;
        $newsize = "100";
        $watermark = "";
        
        uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark);
        
        $o2->document_name = $destination;
        $o2->kyc_id = $updater->update_object($o2, "kyc");
    }
    
    header("location:user_kyc.php?msgid=3&aid=$o1->user_id");
}

include "html/includes/header.php";
include "html/kyc_document.php";
include "html/includes/footer.php";
?>