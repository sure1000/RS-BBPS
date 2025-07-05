<?php

session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

if($updte == 1){
    $rech_customer_id = $_SESSION['rech_customer_id'];
    $result['error'] = "0";
    $result['beneficiary_id']='<select name="beneficiary_id" id="beneficiary_id" class="form-control">'
            . '<option value="0">Select Beneficiary</option>'.rech_beneficiary($rech_customer_id).'</select>';
   echo json_encode($result);
}
?>

