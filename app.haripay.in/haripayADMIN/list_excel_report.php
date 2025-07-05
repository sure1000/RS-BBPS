<?php

session_start();

include "include.php";
include "session.php";
$recharge_page = 1;
$tables = 1;

$draw = $_POST['draw'];
$row = $_POST['start'];
$length = $_POST['length'];

if ($row == "") {
    $row = 0;
}

if ($length == "") {
    $length = 10;
}

$trigger_provider_type = "1=1";
$trigger_provider_id = "1=1";
$trigger_from_date = "1=1";
$trigger_to_date = "1=1";


if (isset($_SESSION['report_search'])) {
    if (isset($_SESSION['report_search']['service_id'])) {
        $provider_type = get_service_name($_SESSION['report_search']['service_id']);
        $trigger_provider_type = "provider_type = '" . $provider_type . "'";
    }
    if (isset($_SESSION['report_search']['provider_id'])) {
        $trigger_provider_id = "provider_id = '" . $_SESSION['report_search']['provider_id'] . "'";
    }


    if (isset($_SESSION['report_search']['from_date'])) {
        $trigger_from_date = "transaction_date >= '" . $_SESSION['report_search']['from_date'] . " 00:00:00'";
    }
    if (isset($_SESSION['report_search']['to_date'])) {
        $trigger_to_date = "transaction_date <= '" . $_SESSION['report_search']['to_date'] . " 23:59:59'";
    }
}

$triggers = $trigger_provider_type . " and " . $trigger_provider_id . " and " . $trigger_from_date . " and " . $trigger_to_date;

$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value


$sql_total = "Select count(wallet_id) as total_transactions from wallet where transaction_type='Recharge' and status='Success' and $triggers group by provider_name";
$res_total = getXbyY($sql_total);

$sql_transactions = "Select provider_name ,sum(api_amount) as totalapi_amount ,sum(total_amount) as total ,sum(commission_rt) as rt_comm ,sum(total_commission) as total_comm from wallet where transaction_type='Recharge' and status='Success' and $triggers group by provider_name limit $row ,$length";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);

if ($row_transactions > 0) {

    for ($i = 0; $i < $row_transactions; $i++) {
        $admin_total_comm = $res_transactions[$i]['total'] - $res_transactions[$i]['totalapi_amount'];
        $commission_dt = $res_transactions[$i]['total_comm'] - $res_transactions[$i]['rt_comm'];
        $profit = $admin_total_comm - $res_transactions[$i]['total_comm'];
        $adminProfit = ($res_transactions[$i]['total'] * $profit) / 100;
        $data[] = array(
            "provider_name" => $res_transactions[$i]['provider_name'],
            "admin_total_comm" => $admin_total_comm,
            "dt_comm" => $commission_dt,
            "rt_comm" => $res_transactions[$i]['rt_comm'],
            "surge" => "0",
            "profit" => $profit,
            "total_Sell" => $res_transactions[$i]['total'],
            "admintotal_profit" => $adminProfit,
        );
    }
} else {
    $data = array();
}


$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => count($res_total),
    "iTotalDisplayRecords" => count($res_total),
    "aaData" => $data,
);

echo json_encode($response);
?>
