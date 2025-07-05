<?php

include "include.php";
if (isset($_POST)) {
    $o->user_id = $_POST['user_id'];
    $o = $factory->get_object($o->user_id, "users", "user_id");
    if ($o->is_active == "1") {
        $today_dt = date('d');
$flag_date1 = 0;
$flag_date = 0;
        $currnt_month_year = date("F") . "-" . date('Y');
if (isset($_POST['dt_month_report'])) {

    if($_POST['dt_month_report']['status_filter'] == $currnt_month_year){
    if($today_dt > '5'){
        $flag_date1 = 1;
    }else{
        $flag_date = 2;
    }
}

if($_POST['dt_month_report']['status_filter'] != $currnt_month_year){
   
        $flag_date = 1;
    
}
    if (isset($_POST['dt_month_report'])) {
        $trigger_status_filter = "A.month_year = '" . $_POST['dt_month_report'] . "'";
    }
} else {
    $trigger_status_filter = "A.month_year  =  '" . $currnt_month_year . "'";
}


$triggers = $trigger_status_filter;

if($flag_date == 1){
$sql_total = "Select A.dt_user_id,count(A.wallet_id) as total_transactions from wallet_backup as A  where A.md_user_id ='".$o->user_id."' and A.status = 'Success' and (A.transaction_type = 'Recharge' || A.transaction_type = 'Financial') and $triggers group by A.dt_user_id ";

$sql_transactions = "Select A.dt_user_id, sum(A.amount) as amount, A.transaction_type from wallet_backup as A where  A.md_user_id ='".$o->user_id."' and  A.status = 'Success' and (A.transaction_type = 'Recharge' || A.transaction_type = 'Financial') and $triggers group by A.dt_user_id, A.transaction_type  order by A.dt_user_id asc ";
}else{
      if($flag_date1 == 1){
        $sql_total1 = "Select A.dt_user_id,count(A.wallet_id) as total_transactions from wallet_backup as A  where A.md_user_id ='".$o->user_id."' and A.status = 'Success' and (A.transaction_type = 'Recharge' || A.transaction_type = 'Financial') and $triggers group by A.dt_user_id ";

$sql_transactions1 = "Select A.dt_user_id, sum(A.amount) as amount, A.transaction_type from wallet_backup as A where  A.md_user_id ='".$o->user_id."' and  A.status = 'Success' and (A.transaction_type = 'Recharge' || A.transaction_type = 'Financial') and $triggers group by A.dt_user_id, A.transaction_type  order by A.dt_user_id asc ";
$res_total1 = getXbyY($sql_total1);
$row_total1 = count($res_total1);
$res_transactions1 = getXbyY($sql_transactions1);
$row_transactions1 = count($res_transactions1);
      }
      $sql_total = "Select A.dt_user_id,count(A.wallet_id) as total_transactions from wallet as A  where A.md_user_id ='".$o->user_id."' and A.status = 'Success' and (A.transaction_type = 'Recharge' || A.transaction_type = 'Financial') and $triggers group by A.dt_user_id ";

$sql_transactions = "Select A.dt_user_id, sum(A.amount) as amount, A.transaction_type from wallet as A where  A.md_user_id ='".$o->user_id."' and  A.status = 'Success' and (A.transaction_type = 'Recharge' || A.transaction_type = 'Financial') and $triggers group by A.dt_user_id, A.transaction_type  order by A.dt_user_id asc ";
}
$res_total = getXbyY($sql_total);
$row_total = count($res_total);
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);
if($flag_date1 == 1){
    $row_total =$row_total+$row_total1;
   if($row_transactions > 0){
    for($n=0 ;$n< $row_transactions;$n++){
        $res_transactions1[$row_transactions1+$n] = $res_transactions[$n];

    }
    $res_transactions =$res_transactions1;
    $row_transactions = count($res_transactions);
   }
    
}
$j = -1;
if($row_transactions > 0){
for ($i = 0; $i < $row_transactions; $i++) {

    if ($res_transactions[$i]['dt_user_id'] != $res_transactions[$i - 1]['dt_user_id']) {
        $j++;
        $res_transactions[$j]['dt_user_id'] = $res_transactions[$i]['dt_user_id'];
    }
  
  $o7=$factory->get_object($res_transactions[$i]['dt_user_id'],"users","user_id");
    $data[$j]['user_details'] = $o7->user_name."-".$o7->name.",".$o7->company_name;
    if ($res_transactions[$i]['transaction_type'] == "Recharge") {

        $data[$j]['recahrge'] = (string)round($res_transactions[$i]['amount'], 2);
        $data[$j]['recahrge_tt'] = (string)round($res_transactions[$i]['amount'], 2);
    }
    if ($res_transactions[$i]['transaction_type'] == "Financial") {

        $data[$j]['financial'] =  (string)round($res_transactions[$i]['amount'], 2);
        $data[$j]['financial_tt'] = (string)round($res_transactions[$i]['amount'], 2);
    }
    if ($res_transactions[$i]['transaction_type'] == "Utility") {

        $data[$j]['utility'] = (string)round($res_transactions[$i]['amount'], 2);
        $data[$j]['utility_tt'] = (string)round($res_transactions[$i]['amount'], 2);
    }
    if ($res_transactions[$i]['transaction_type'] == "Travel") {

        $data[$j]['travel'] = (string)round($res_transactions[$i]['amount'], 2);
        $data[$j]['travel_tt'] = (string)round($res_transactions[$i]['amount'], 2);
    }
    if ($res_transactions[$i]['transaction_type'] == "Gift Card") {

        $data[$j]['gift_card'] = (string)round($res_transactions[$i]['amount'], 2);
        $data[$j]['gift_card_tt'] = (string)round($res_transactions[$i]['amount'], 2);
    }
    if ($res_transactions[$i]['transaction_type'] == "eGovernance") {

        $data[$j]['egovernance'] = (string)round($res_transactions[$i]['amount'], 2);
        $data[$j]['egovernance_tt'] = (string)round($res_transactions[$i]['amount'], 2);
    }
    if ($res_transactions[$i]['transaction_type'] == "Subscription") {

        $data[$j]['subscription'] = (string)round($res_transactions[$i]['amount'], 2);
        $data[$j]['subscription_tt'] = (string)round($res_transactions[$i]['amount'], 2);
    }
    if ($res_transactions[$i]['transaction_type'] == "Ticket Booking") {

        $data[$j]['ticket_booking'] = (string)round($res_transactions[$i]['amount'], 2);
        $data[$j]['ticket_booking_tt'] = (string)round($res_transactions[$i]['amount'], 2);
    }
    if ($data[$j]['financial'] == "") {
        $data[$j]['financial'] = "0";
        $data[$j]['financial_tt'] = "0";
    }
    if ($data[$j]['recahrge'] == "") {
        $data[$j]['recahrge'] = "0";
        $data[$j]['recahrge_tt'] = "0";
    }
    if ($data[$j]['utility'] == "") {
        $data[$j]['utility'] = "0";
        $data[$j]['utility_tt'] = "0";
    }
    if ($data[$j]['travel'] == "") {
        $data[$j]['travel'] = "0";
        $data[$j]['travel_tt'] = "0";
    }
    if ($data[$j]['gift_card'] == "") {
        $data[$j]['gift_card'] = "0";
        $data[$j]['gift_card_tt'] = "0";
    }
    if ($data[$j]['egovernance'] == "") {
        $data[$j]['egovernance'] = "0";
        $data[$j]['egovernance_tt'] = "0";
    }
    if ($data[$j]['subscription'] == "") {
        $data[$j]['subscription'] = "0";
        $data[$j]['subscription_tt'] = "0";
    }
    if ($data[$j]['ticket_booking'] == "") {
        $data[$j]['ticket_booking'] = "0";
        $data[$j]['ticket_booking_tt'] = "0";
    }
$total =$data[$j]['ticket_booking_tt'] + $data[$j]['subscription_tt'] + $data[$j]['egovernance_tt'] + $data[$j]['recahrge_tt'] + $data[$j]['financial_tt'] + $data[$j]['utility_tt'] + $data[$j]['travel_tt'] + $data[$j]['gift_card_tt'];
    $data[$j]['total'] = (string)round($total, 2);
}
$result['error'] = "0";
$result['error_msg'] = "Data Found";
$result['result_data'] = $data;
}else{
    $result['result_data'] = [];
	$result['error'] = "0";
    $result['error_msg'] = "No Data Found";
}
   } else {
        $result['error'] = "1";
        $result['error_msg'] = "User Blocked";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong. Please try again";
}


echo json_encode($result);
?>
