<?php

include "include.php";
if ($o->user_id > 0) {


$trigger_cash_credit = "1=1";
$trigger_team_member = "1=1";
$trigger_transaction_type = "(transaction_type = 'Send Money' or transaction_type = 'Recieve Money' or transaction_type = 'Reverse')";
$trigger_status = "1=1";
$trigger_from_date = "1=1";
$trigger_to_date = "1=1";
$trigger_search_val = "1=1";


    

 
    if($_POST['cash_credit'] !=""){
        $trigger_cash_credit = "cash_credit = '".$_POST['cash_credit']."'";
    }
    if(($_POST['team_member'] != "")){
        $trigger_team_member = "user_1_id = '".$_POST['team_member']."'";
    }
    if(($_POST['transaction_type'] != "")){
        $trigger_transaction_type = "transaction_type = '".$_POST['transaction_type']."'";
    }
    if(($_POST['status'] !="")){
        $trigger_status = "status = '".$_POST['status']."'";
    }
    if(($_POST['from_date'] !="")){
        $trigger_from_date = "transaction_date >= '".$_POST['from_date']."'";
    }
    if(($_POST['to_date'] !="")){
        $trigger_to_date = "transaction_date <= '".$_POST['to_date']."'";
    }
    if(($_POST['search_val'] !="")){
        $trigger_search_val = "ref_number = '".$_POST['search_val']."'";
    }


$triggers = $trigger_cash_credit." and ".$trigger_team_member." and ".$trigger_transaction_type." and ".$trigger_status." and ".$trigger_from_date." and ".$trigger_to_date." and ".$trigger_search_val;

$sql_transactions = "Select * from wallet where user_id = " . $o->user_id . " and $triggers order by wallet_id DESC ";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);
    for ($i = 0; $i < $row_transactions; $i++) {

        $results[$i]['wallet_id'] = (string) $res_transactions[$i]['wallet_id'];
        $results[$i]['transaction_type'] = (string) $res_transactions[$i]['transaction_type'];
        $results[$i]['ref_number'] = (string) $res_transactions[$i]['ref_number'];
        $results[$i]['transaction_details'] = (string) $res_transactions[$i]['transaction_details'];
        $results[$i]['transaction_date'] = (string) $res_transactions[$i]['transaction_date'];
        $results[$i]['user_name'] = (string) $res_transactions[$i]['user_name'];
        $results[$i]['amount'] = (string) $res_transactions[$i]['amount'];
        $results[$i]['user_new_balance'] = (string) $res_transactions[$i]['user_new_balance'];
   
        
    }
    $result['wallet_history'] = $results;
    $result['error'] = "0";
    $result['error_msg'] = "Fetch Data";
} else {
    $result['error'] = "1";
    $result['error_msg'] = "No Data found.";
}


echo json_encode($result);
?>