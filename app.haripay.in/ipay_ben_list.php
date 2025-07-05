<?php

session_start();

include "include.php";
include "session.php";
$recharge_page = 1;
$tables = 1;

//pt($_POST);pt($_GET);
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$length = $_POST['length'];

if ($row == "") {
    $row = 0;
}

if ($length == "") {
    $length = 10;
}

$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
//pt($_POST);
if ($_SESSION['ipay_customer_id'] > 0) {
    $ipay_user = $factory->get_object($_SESSION['ipay_customer_id'], "ipay_user", "ipay_user_id");
}
$sql_total = "Select count(ipay_beneficiary_id) as total_transactions from ipay_beneficiary where user_id = " . $o->user_id . " and ipay_user_id = '" . $ipay_user->ipay_user_id . "'";
$res_total = getXbyY($sql_total);

$sql_transactions = "Select * from ipay_beneficiary where user_id = " . $o->user_id . " and  ipay_user_id = '" . $ipay_user->ipay_user_id . "' and is_active = 1 order by ipay_beneficiary_id DESC ";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);

if ($row_transactions > 0) {

    for ($i = 0; $i < $row_transactions; $i++) {


        $data[] = array(
            "ben_details" => $res_transactions[$i]['beneficiaryName'] . "<br/>" . $res_transactions[$i]['accountNo'] . "<br/>" . $res_transactions[$i]['ifscCode'],
            "Action" => '<a  class="fa_approve" onclick=\'ipay_transfer("' . $res_transactions[$i]["ipay_beneficiary_id"] . '")\'>Transfer </a><a class="fa_reject" onclick=\'delete_recipient_ipay("' . $res_transactions[$i]["ipay_beneficiary_id"] . '")\'><i class="fa fa-trash"></i></a>',
        );
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
);

echo json_encode($response);
?>

