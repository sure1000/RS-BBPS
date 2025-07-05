<?php

session_start();

include "include.php";
include "session.php";

$tables = 1;


$draw = $_POST['draw'];
$row = $_POST['start'];
$length = $_POST['length'];
$dd = explode(" ", todaysDate());

if ($row == "") {
    $row = 0;
}

if ($length == "") {
    $length = 10;
}
$length = $length + 1;
$limit = "limit $row ,$length";

if ($length == '-1') {
    $limit = "";
}

$trigger_operator_filter = "1=1";
$trigger_status_filter = "1=1";

$trigger_search_filter = "1=1";
$trigger_from_date = "1=1";
$trigger_to_date = "1=1";

if (isset($_SESSION['recharge_report'])) {
    if (isset($_SESSION['recharge_report']['operator_filter'])) {
        $trigger_operator_filter = "provider_id = '" . $_SESSION['recharge_report']['operator_filter'] . "'";
    }
    if (isset($_SESSION['recharge_report']['status_filter'])) {
        $trigger_status_filter = "status = '" . $_SESSION['recharge_report']['status_filter'] . "'";
    }

    if (isset($_SESSION['recharge_report']['search_filter'])) {
        $trigger_search_filter = "( mobile_number like '%" . $_SESSION['recharge_report']['search_filter'] . "%' or opid  like '" . $_SESSION['recharge_report']['search_filter'] . "%'  or ref_number like '%" . $_SESSION['recharge_report']['search_filter'] . "%' )";
    }
    if (isset($_SESSION['recharge_report']['from_date'])) {
        $trigger_from_date = "transaction_date >= '" . format_date_search($_SESSION['recharge_report']['from_date']) . " 00:00:00'";
    }
    if (isset($_SESSION['recharge_report']['to_date'])) {
        $trigger_to_date = "transaction_date <= '" . format_date_search($_SESSION['recharge_report']['to_date']) . " 59:59:59'";
    }
} else {
    $trigger_from_date = "transaction_date >= '" . $dd[0] . " 00:00:00'";
    $trigger_to_date = "transaction_date <= '" . $dd[0] . " 59:59:59'";
}


$triggers = $trigger_search_filter . " and  " . $trigger_status_filter . " and " . $trigger_operator_filter . " and " . $trigger_from_date . " and " . $trigger_to_date;

$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
 $sql_distt ="Select * from users where user_type ='Retailer'  and parent_id = '".$o->user_id."' and is_active ='1'";
 $res_distt =getXbyY($sql_distt);
 $row_distt = count($res_distt);
for($k = 0 ;$k < $row_distt ;$k++){
    
}
$sql_total = "Select count(wallet_id) as total_transactions from wallet where   parent_id = 0 and transaction_type = 'Recharge' and $triggers";
$res_total = getXbyY($sql_total);

$sql_amount = "Select sum(total_amount) as amount ,status from wallet where  parent_id = 0 and transaction_type = 'Recharge' and $triggers group by status";
$res_amount = getXbyY($sql_amount);

$result_pending_amt = 0;
$result_success_amt = 0;
$result_failed_amt = 0;

for ($a = 0; $a < count($res_amount); $a++) {
    if ($res_amount[$a]['status'] == "Success") {
        $result_success_amt = $res_amount[$a]['amount'];
    }
    if ($res_amount[$a]['status'] == "Pending") {
        $result_pending_amt = $res_amount[$a]['amount'];
    }
    if ($res_amount[$a]['status'] == "Failed") {
        $result_failed_amt = $res_amount[$a]['amount'];
    }
}


$sql_count = "Select count(wallet_id) as wallet_id ,status from wallet where  parent_id = 0 and transaction_type = 'Recharge' and $triggers group by status";
$res_count = getXbyY($sql_count);

$result_success_count = 0;
$result_pending_count = 0;
$result_failed_count = 0;

for ($c = 0; $c < count($res_count); $c++) {
    if ($res_count[$c]['status'] == "Success") {
        $result_success_count = $res_count[$c]['wallet_id'];
    }
    if ($res_count[$c]['status'] == "Pending") {
        $result_pending_count = $res_count[$c]['wallet_id'];
    }
    if ($res_count[$c]['status'] == "Failed") {
        $result_failed_count = $res_count[$c]['wallet_id'];
    }
}

  $sql_transactions = "Select *  from wallet   where   parent_id = 0 and transaction_type = 'Recharge'  and  $triggers order by wallet_id DESC $limit";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);
$success_count = 0;
$pending_count = 0;
$failed_count = 0;
$success_amt = 0;
$pending_amt = 0;
$failed_amt = 0;
if ($row_transactions > 0) {

   
  $success_count = round($result_success_count, 2);
    $pending_count = round($result_pending_count, 2);
    $failed_count = round($result_failed_count, 2);
    $success_amt = round($result_success_amt, 2);
    $pending_amt = round($result_pending_amt, 2);
    $failed_amt = round($result_failed_amt, 2);
  
    for ($i = 0; $i < $row_transactions; $i++) {
   $action_txn = "";
if ($res_transactions[$i]['status'] == "Success" && $res_transactions[$i]['disputed'] == "No" ) {
            $action_txn = "<i class='fas fa-gavel fa_pending ' onclick=\"change_dispute('" . $res_transactions[$i]['wallet_id'] . "','Yes')\" title='Dispute'></i>";
        }else if ($res_transactions[$i]['disputed'] == "Yes") {
            $action_txn .= "<span style='    font-size: 12px;color: #197ce1;'>Under Review </span>";
        } else if ($res_transactions[$i]['disputed'] == "Rejected") {
            $action_txn .= "<span style='    font-size: 12px;color: #f44336;'>Rejected </span>";
        } else if ($res_transactions[$i]['disputed'] == "Resolved") {
            $action_txn .= "<span style='    font-size: 12px;color: #4caf50;'>Resolved </span>";
        }

        $action = "<a href='print.php?wallet_id=" . $res_transactions[$i]['wallet_id'] . "' target='_blank'><i class='fas fa-print fa_waiting ' title='Print'></i></a>";
       


        $data[$i]['tnx_id'] = $res_transactions[$i]['wallet_id'];
         
        $data[$i]['Retailer'] = $res_transactions[$i]['user_name'];
        $data[$i]['request_date'] = format_date($res_transactions[$i]['transaction_date']) . " <br/>" . format_date($res_transactions[$i]['updated_at']);
        $data[$i]['number'] = $res_transactions[$i]['mobile_number'] . "<br/>" . $res_transactions[$i]['provider_name'];
        $data[$i]['amount'] = "<b><i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['total_amount'] . "</b>";
        if($o->user_type == "Master Distributor"){
             $data[$i]['my_inc'] = "<table class='table  table-bordered'><tr><th>My INC</th><th>Dt INC</th><th>Rt INC</th></tr><tr><td>".get_commission($res_transactions[$i]['wallet_id'], $res_transactions[$i]['md_user_id'])."</td><td>".get_commission($res_transactions[$i]['wallet_id'], $res_transactions[$i]['md_user_id'])."</td><td><i class='fa fa-rupee-sign'></i>" .round($res_transactions[$i]['total_amount'] - $res_transactions[$i]['amount'],2)."</td></tr></table>";
       
         } else if($o->user_type == "Distributor") {
              $data[$i]['my_inc'] = "<table class='table  table-bordered'><tr><th>My INC</th><th>Rt INC</th></tr><tr><td>".get_commission($res_transactions[$i]['wallet_id'], $res_transactions[$i]['md_user_id'])."</td><td><i class='fa fa-rupee-sign'></i>" .round($res_transactions[$i]['total_amount'] - $res_transactions[$i]['amount'],2)."</td></tr></table>";
      
        } else {
              $data[$i]['my_inc'] = "<i class='fa fa-rupee-sign'></i>" .round($res_transactions[$i]['total_amount'] - $res_transactions[$i]['amount'],2)."";
      
        }
          $data[$i]['debited'] = "<i class='fa fa-rupee-sign'></i>" .$res_transactions[$i]['amount'];
          $data[$i]['user_amount'] = "<i class='fa fa-rupee-sign'></i>" .$res_transactions[$i]['user_new_balance'];
        $data[$i]['status'] = $res_transactions[$i]['status'];
        $data[$i]['opid'] =  $res_transactions[$i]['opid'];
        $data[$i]['print'] = $action .$action_txn;
    }
} else {
    $data = array();
}
## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $res_total[0]['total_transactions'],
    "iTotalDisplayRecords" => $res_total[0]['total_transactions'],
    "aaData" => $data,
    "success_count" => $success_count,
    "pending_count" => $pending_count,
    "failed_count" => $failed_count,
    "success_amt" => $success_amt,
    "pending_amt" => $pending_amt,
    "failed_amt" => $failed_amt,
);

echo json_encode($response);
?>
