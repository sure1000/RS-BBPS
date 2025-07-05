<?php

session_start();

include "include.php";
include "session.php";

if (isset($_GET['aid'])) {
    $o1->provider_id = $_GET['aid'];
} else {
    $o1->provider_id = 0;
}

if ($o1->provider_id > 0) {
    $o1 = $factory->get_object($o1->provider_id, "providers", "provider_id");
} else {
    $o1->is_active = 1;
}

if ($updte == 1) {
    $o1->provider = $_POST['provider'];
    $o1->service_id = $_POST['service_id'];
    $o1->service= get_service_name($o1->service_id);
    $o1->api_id = $_POST['api_id'];
    $o1->api_name = get_api_name($o1->api_id);
    $o1->commission_amount = $_POST['commission_amount'];
    $o1->commission_percentage = $_POST['commission_percentage'];
    $o1->is_active = $_POST['is_active'];
    
    

    if ($o1->provider_id > 0) {
        $o1->provider_id = $updater->update_object($o1, "providers");
    } else {
        $o1->provider_id = $insertor->insert_object($o1, "providers");
    }

    if ($_FILES['logo']['name'] != "") {
        if ($o1->logo != "") {
            $img_link = "../provider_logos/" . $o1->logo;
            $img_thumb_link = "../provider_logos/thumbs/" . $o1->logo;
            unlink($img_link);
            unlink($img_thumb_link);
        }

        $tmpfile = $_FILES['logo']['tmp_name'];
        $source = "../provider_logos/";
        $file_extension = explode(".", $_FILES['logo']['name']);
        $destination = $o1->provider."_".$o1->service."." . end($file_extension);
        $thumbnail = 1;
        $newsize = "100";
        $watermark = "";

        uploadimage($tmpfile, $source, $destination, $thumbnail, $newsize, $watermark);
        
        $o1->logo = $destination;
        $o1->provider_id = $updater->update_object($o1, "providers");
    }

    header("location:providers.php?msgid=3");
}

include "html/includes/header.php";
include "html/provider_modes.php";
include "html/includes/footer.php";
?>