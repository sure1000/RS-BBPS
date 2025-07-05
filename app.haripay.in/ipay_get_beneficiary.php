<?php

session_start();

include "include.php";
include "session.php";
$ajax_logout = 1;

if($_POST['updte'] == 1){
    $ipay_user_id = $_SESSION['ipay_customer_id'];
    $ben_id = $_POST['ben_id'];
    $result['error'] = "0";
    $result['beneficiary_id']='<select name="beneficiary_id_ipay" id="beneficiary_id_ipay" class="form-control">'
            . '<option value="0">Select Beneficiary</option>'.ipay_beneficiary($ipay_user_id , $ben_id).'</select>';
  
    if($ben_id > 0){
         $result['action_mode']='<select name="action_mode" id="action_mode" class="form-control" required  onclick="ipay_service(this.value)"  >
            <option value="ADD BENEFICIARY">ADD BENEFICIARY</option>
            <option value="FUND TRANSFER" selected>FUND TRANSFER</option>
        </select>';
    }
    
    
    echo json_encode($result);
}
?>

