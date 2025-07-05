<?php

include "include.php";


$dd = explode(" ", todaysDate());



$trigger_from_date = "1=1";
$trigger_to_date = "1=1";


if (isset($_POST['from_date']) && $_POST['from_date'] != "") {
    $trigger_from_date = "A.request_date >= '" . ($_POST['from_date']) . " 00:00:00'";
} else {
    // $trigger_from_date = "A.request_date >= '" . $dd[0] . " 00:00:00'";
}
if (isset($_POST['to_date']) && $_POST['to_date'] != "") {
    $trigger_to_date = "A.request_date <= '" . ($_POST['from_date']) . " 23:59:59'";
} else {
    // $trigger_to_date = "A.request_date <= '" . $dd[0] . " 23:59:59'"; 
}






$triggers = $trigger_from_date . " and " . $trigger_to_date;



$sql_total = "Select count(A.request_money_id) as total_transactions from request_money as A where   A.requested_user_id = " . $o->user_id . " and   $triggers";
$res_total = getXbyY($sql_total);

$sql_transactions = "Select A.*,B.company_name ,B.mobile,B.user_type,B.user_name,B.name from request_money as A left join users as B on (A.user_id = B.user_id) where  A. requested_user_id = " . $o->user_id . " and   $triggers order by A.request_money_id DESC ";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);

if ($row_transactions > 0) {

    for ($i = 0; $i < $row_transactions; $i++) {


        $data[$i]['status'] = $res_transactions[$i]['status'];
        $data[$i]['transaction_number'] = $res_transactions[$i]['transaction_number'];
        $data[$i]['file_money'] = $res_transactions[$i]['file_money'];
        $data[$i]['request_money_id'] = $res_transactions[$i]['request_money_id'];
        $data[$i]['order_id'] = "ORD0" . $res_transactions[$i]['request_money_id'];
        $data[$i]['user_name'] = $res_transactions[$i]['user_name'];
        $data[$i]['name'] = $res_transactions[$i]['name'];
        $data[$i]['mobile'] = $res_transactions[$i]['mobile'];
        $data[$i]['company_name'] = $res_transactions[$i]['company_name'];
        $data[$i]['remark'] = $res_transactions[$i]['remark'];
        $data[$i]['transfer_mode'] = $res_transactions[$i]['transfer_mode'];
        $data[$i]['amount'] = $res_transactions[$i]['amount'];
        $data[$i]['request_date'] = $res_transactions[$i]['request_date'];
        $data[$i]['wallet_type'] = $res_transactions[$i]['wallet_type'];
    }
} else {
    $data = array();
}
$response['data'] = $data;
$response['error'] = '0';
$response['error_msg'] = 'Data Fetch';


echo json_encode($response);
?>
