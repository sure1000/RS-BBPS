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
if( $_SESSION['rech_customer_id'] > 0 ){
      $rech_user = $factory->get_object( $_SESSION['rech_customer_id'], "rech_customer", "rech_customer_id");
 }

$sql_total = "Select count(rech_beneficiary_id) as total_transactions from rech_beneficiary where user_id = " . $o->user_id . " and rech_customer_id = '".$rech_user->rech_customer_id."'";
$res_total = getXbyY($sql_total);

$sql_transactions = "Select * from rech_beneficiary where user_id = " . $o->user_id . " and  rech_customer_id = '".$rech_user->rech_customer_id."' order by rech_beneficiary_id DESC limit $row ,$length";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);

if ($row_transactions > 0) {

	for ($i = 0; $i < $row_transactions; $i++) {
		

		$data[] = array(
			"sr_id" => ($i+1),
			"ben_details" =>  $res_transactions[$i]['beneficiaryName'] ."<br/>".$res_transactions[$i]['beneficiaryMobileNumber'] ,
			"Address" =>  $res_transactions[$i]['beneficiaryAddress']  ,
			"bank_details" =>$res_transactions[$i]['ifscCode'],
			"account_details" => $res_transactions[$i]['beneficiaryAccountNumber'],
			
			"Action" => "<i class='fa fa-edit'></i> <br/> <i class='fa fa-trash'></i>",
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

