<?php

session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

if($updte == 1){
    $service_id = $_POST['service_id'];
    
    $sstring='<select name="provider_id" id="provider_id" class="form-control">'
            . '<option value="0">Select Provider</option>'.get_provider_list_by_service("0", $service_id).'</select>';
    echo $sstring;
}
?>