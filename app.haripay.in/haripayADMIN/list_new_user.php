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
$dt = explode(" ", todaysDate());

$trigger_from_date = "1=1";
$trigger_to_date = "1=1";
$trigger_user_type = "1=1";

if (isset($_SESSION['search_user_new'])) {
   
   
    if (isset($_SESSION['search_user_new']['from_date'])) {
        $trigger_from_date = "created_at >= '" . $_SESSION['search_user_new']['from_date'] . " 00:00:00'";
    }
    if (isset($_SESSION['search_user_new']['to_date'])) {
        $trigger_to_date = "created_at <= '" . $_SESSION['search_user_new']['to_date'] . " 23:59:59'";
    }
    if (isset($_SESSION['search_user_new']['user_type'])) {
        $trigger_user_type = "user_type = '" . $_SESSION['search_user_new']['user_type'] . "'";
    }
}else{
     $trigger_from_date = "created_at >= '" . $dt[0] . " 00:00:00'";
     $trigger_to_date = "created_at <= '" . $dt[0] . " 23:59:59'";
}

$triggers = $trigger_from_date . " and " . $trigger_to_date . " and " . $trigger_user_type;

$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
//pt($_POST);

$sql_total = "Select count(user_id) as total_transactions from users where   $triggers";
$res_total = getXbyY($sql_total);

$sql_transactions = "Select * from users where $triggers order by user_id DESC limit $row ,$length";

$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);

if ($row_transactions > 0) {

    for ($i = 0; $i < $row_transactions; $i++) {
      $verified = "";
      if($res_transactions[$i]['email_verified'] == "Yes"){
          $verified .= "<span class='fa_approve'>Email</span>";
      }else{
          $verified .= "<span class='fa_reject'>Email</span>";
      }
      if($res_transactions[$i]['mobile_verified'] == "Yes"){
          $verified .= "<span class='fa_approve'>Mobile</span>";
      }else{
          $verified .= "<span class='fa_reject'>Mobile</span>";
      }
      
        $data[] = array(
            "sr_id" => ($i+1),
            "user_details" => $res_transactions[$i]['user_name'] ." : ". $res_transactions[$i]['name'] . "<br/>" .$res_transactions[$i]['mobile'] . "<br/>" .$res_transactions[$i]['email'],
            "user_type" =>$res_transactions[$i]['user_type'],
            "verified" => $verified,
            "created_at" => format_date($res_transactions[$i]['created_at']),
            "status" => status($res_transactions[$i]['is_active']),
            
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
