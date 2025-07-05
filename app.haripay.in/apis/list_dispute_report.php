<?php

include "include.php";

$dd = explode(" ", todaysDate());

$trigger_status_filter = "1=1";
$trigger_from_date = "1=1";
$trigger_to_date = "1=1";
$trigger_to_date1 = '1=1';
$flag_date = 0;

$old_date = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 5, date("y"))) . " " . ' 00:00:01';
if (isset($_POST['from_date']) && $_POST['from_date'] != "") {
    $start_date = $_POST['from_date'] . " 00:00:00";
    $date_diff = (strtotime($old_date) - strtotime($start_date));
    if ($date_diff > 0) {
        $flag_date = 1;
    }
}


if (isset($_POST['status_filter']) && $_POST['status_filter'] != "") {
    $trigger_status_filter = "B.status = '" . $_POST['status_filter'] . "'";
}
if ($flag_date == 0) {
    if (isset($_POST['from_date']) && $_POST['from_date'] != "") {
        $trigger_from_date = "B.dispute_date >= '" . ($_POST['from_date']) . " 00:00:00'";
    } else {
        $trigger_from_date = "B.dispute_date >= '" . $dd[0] . " 00:00:00'";
    }
    if (isset($_POST['to_date']) && $_POST['to_date'] !="") {
        $trigger_to_date = "B.dispute_date <= '" . ($_POST['to_date']) . " 23:59:59'";
    } else {
        $trigger_to_date = "B.dispute_date <= '" . $dd[0] . " 23:59:58' ";
    }
} else {
    $today_dt = strtotime(date('d-m-Y'));
    $to_date = strtotime($_POST['to_date']);
    if ($today_dt == $to_date) {
        $trigger_to_date = 'B.dispute_date <= "' . date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 1, date("y"))) . " " . '23:59:59"';

        $trigger_to_date1 = "B.dispute_date >= '" . date('Y-m-d') . " 00:00:00'";
    } else if ($to_date < $today_dt) {

        if (isset($_POST['to_date']) && $_POST['to_date'] != "") {
            $trigger_to_date = "B.dispute_date <= '" . ($_POST['to_date']) . " 23:59:59'";
        }
    }
}

$triggers = $trigger_status_filter;


if ($flag_date == 0) {
    $sql_total = "Select count(A.wallet_id) as total_transactions from wallet as A left join  dispute_recharge as B on (A.wallet_id = B.wallet_id)  where  A.parent_id = 0 and A.user_id='" . $o->user_id . "' and A.transaction_type = 'Recharge' and A.disputed !='No' and $triggers and $trigger_from_date and $trigger_to_date";

    $sql_transactions = "Select A.provider_name,A.total_amount,A.wallet_id,A.api_name,A.provider_type,A.updated_at,A.user_id,A.transaction_date,A.mobile_number,A.opid,B.*  from wallet as A left join  dispute_recharge as B on (A.wallet_id = B.wallet_id) where  A.parent_id = 0 and A.user_id='" . $o->user_id . "' and  A.transaction_type = 'Recharge' and   A.disputed !='No' and  $triggers and $trigger_from_date and $trigger_to_date order by A.wallet_id DESC ";
} else {
    if ($trigger_to_date1 != '1=1') {
        $sql_total1 = "Select count(A.wallet_id) as total_transactions from wallet as A left join  dispute_recharge as B on (A.wallet_id = B.wallet_id)  where  A.parent_id = 0 and A.user_id='" . $o->user_id . "' and A.transaction_type = 'Recharge' and A.disputed !='No' and $triggers  and $trigger_to_date1";

        $sql_transactions1 = "Select A.provider_name,A.total_amount,A.wallet_id,A.api_name,A.provider_type,A.updated_at,A.user_id,A.transaction_date,A.mobile_number,A.opid,B.*  from wallet as A left join  dispute_recharge as B on (A.wallet_id = B.wallet_id) where  A.parent_id = 0 and A.user_id='" . $o->user_id . "' and  A.transaction_type = 'Recharge' and   A.disputed !='No' and  $triggers and $trigger_to_date1 order by A.wallet_id ASC ";
        $res_total1 = getXbyY($sql_total1);
        $res_transactions1 = getXbyY($sql_transactions1);
    }
    $sql_total = "Select count(A.wallet_id) as total_transactions from wallet_backup as A left join  dispute_recharge as B on (A.wallet_id = B.wallet_id)  where  A.parent_id = 0 and A.user_id='" . $o->user_id . "' and A.transaction_type = 'Recharge' and A.disputed !='No' and $triggers and $trigger_from_date and $trigger_to_date";

    $sql_transactions = "Select A.provider_name,A.total_amount,A.wallet_id,A.api_name,A.provider_type,A.updated_at,A.user_id,A.transaction_date,A.mobile_number,A.opid,B.*  from wallet_backup as A left join  dispute_recharge as B on (A.wallet_id = B.wallet_id) where  A.parent_id = 0 and A.user_id='" . $o->user_id . "' and  A.transaction_type = 'Recharge' and   A.disputed !='No' and  $triggers and $trigger_from_date and $trigger_to_date order by A.wallet_id ASC ";
}

$res_total = getXbyY($sql_total);
$res_total[0]['total_transactions'] = $res_total[0]['total_transactions'] + $res_total1[0]['total_transactions'];
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);
for ($n = 0; $n < count($res_transactions1); $n++) {
    $res_transactions[$row_transactions + $n] = $res_transactions1[$n];
}
$row_transactions = count($res_transactions);

if ($row_transactions > 0) {


    for ($i = 0; $i < $row_transactions; $i++) {

        $data[$i]['wallet_id'] = $res_transactions[$i]['wallet_id'];
        $data[$i]['recharge_date_time'] = $res_transactions[$i]['updated_at'];
        $data[$i]['mobile_number'] = $res_transactions[$i]['mobile_number'];
        $data[$i]['provider_type'] = $res_transactions[$i]['provider_type'];
        $data[$i]['provider_name'] = $res_transactions[$i]['provider_name'];
        $data[$i]['dispute_date'] = $res_transactions[$i]['dispute_date'];
        $data[$i]['status'] = $res_transactions[$i]['status'];
        $data[$i]['opid'] = $res_transactions[$i]['opid'];
        $data[$i]['remark'] = $res_transactions[$i]['remark'];
        $data[$i]['update_date'] = $res_transactions[$i]['update_date'];
        $data[$i]['provider_name'] = $res_transactions[$i]['provider_name'];
        $data[$i]['provider_type'] = $res_transactions[$i]['provider_type'];
        $data[$i]['number'] = $res_transactions[$i]['mobile_number'];
        $data[$i]['amount'] = $res_transactions[$i]['total_amount'];
    }
} else {
    $data = [];
}
$response['data'] = $data;
$response['error'] = "0";
$response['error_msg'] = "Data Fetch";


echo json_encode($response);
?>
