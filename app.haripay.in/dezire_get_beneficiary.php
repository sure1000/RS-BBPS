<?php

session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

if($_POST['updte'] == 1){
    $ipay_user_id = $_SESSION['ipay_customer_id'];
    $result['error'] = "0";
    $result['beneficiary_id']='<select name="beneficiary_id" id="beneficiary_id" class="form-control">'
            . '<option value="0">Select Beneficiary</option>'.ipay_beneficiary($ipay_user_id).'</select>';
   echo json_encode($result);
}
?>

