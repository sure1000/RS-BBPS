<?php

session_start();

include "include.php";
include "session.php";
$recharge_page = 1;
$tables = 1;
//pt($_SESSION);
//pt($_POST);pt($_GET);
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$length = $_POST['length'];

if ($row == "") {
	$row = 0;
}

if ($length == "") {
	$length = 50;
}

$trigger_user_name = "1=1";
$trigger_plan_id = "1=1";
$trigger_provider_type = "1=1";
$trigger_provider_id = "1=1";
$trigger_from_date = "1=1";
$trigger_to_date = "1=1";
$trigger_is_active = "1=1";

if (isset($_SESSION['search'])) {
	if (isset($_SESSION['search']['service_id'])) {
		$provider_type = get_service_name($_SESSION['search']['service_id']);
		$trigger_provider_type = "B.provider_type = '" . $provider_type . "'";
	}
	if (isset($_SESSION['search']['provider_id'])) {
		$trigger_provider_id = "B.provider_id = '" . $_SESSION['search']['provider_id'] . "'";
	}
	if (isset($_SESSION['search']['user_name'])) {
		$trigger_user_name = "A.user_name like '%" . $_SESSION['search']['user_name'] . "%'";
	}
	if (isset($_SESSION['search']['plan_id'])) {
		$trigger_plan_id = "A.plan_id = '" . $_SESSION['search']['plan_id'] . "'";
	}
	if (isset($_SESSION['search']['from_date'])) {
		$trigger_from_date = "B.transaction_date >= '" . $_SESSION['search']['from_date'] . "'";
	}
	if (isset($_SESSION['search']['to_date'])) {
		if ($_SESSION['search']['to_date'] == todaysDate_only()) {
			$_SESSION['search']['to_date'] = todaysDate();
		}
		$trigger_to_date = "B.transaction_date <= '" . $_SESSION['search']['to_date'] . "'";
	}
	if (isset($_SESSION['search']['is_active'])) {
		$trigger_is_active = "A.is_active = '" . $_SESSION['search']['is_active'] . "'";
	}
}

$triggers = $trigger_user_name . " and " . $trigger_plan_id . " and " . $trigger_provider_type . " and " . $trigger_provider_id . " and " . $trigger_from_date . " and " . $trigger_to_date . " and " . $trigger_is_active;

$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
//pt($_POST);

$sql_total = "Select count(A.user_id) as total_users from users as A left join wallet as B on (A.user_id = B.user_id) where $triggers group by (A.user_id) order by A.name";
$res_total = getXbyY($sql_total);

$sql_users = "Select A.user_id, A.name, A.mobile, A.user_name, A.email, A.amount_balance, A.credit_amount, sum(B.amount) as amount, B.status, B.transaction_type from users as A left join wallet as B on (A.user_id = B.user_id) where $triggers and (transaction_type = 'Recharge' or transaction_type = 'R Offer Check' or transaction_type = 'User Info Check' or transaction_type = 'Commission' or transaction_type = 'Refund') group by A.user_id, B.status order by A.name asc limit $row ,$length";
//$sql_transactions = "Select * from wallet where user_id = ".$o->user_id." order by transaction_date DESC";
$res_users = getXbyY($sql_users);
$row_users = count($res_users);

$j = -1;
if ($row_users > 0) {

	for ($i = 0; $i < $row_users; $i++) {

		if ($res_users[$i]['user_id'] != $res_users[$i - 1]['user_id']) {
			$total_success = 0;
			$j++;
			$data[$j]['user_name'] = $res_users[$i]['user_name'] . "<br />" . $res_users[$i]['name'] . "<br />" . $res_users[$i]['mobile'] . "<br />" . $res[$i]['email'];
			$data[$j]['balance_amount'] = "<i class='fa fa-rupee-sign'></i> " . $res_users[$i]['amount_balance'];
			$data[$j]['credit_amount'] = "<i class='fa fa-rupee-sign'></i> " . $res_users[$i]['credit_amount'];

			if ($res_users[$i]['transaction_type'] == "Recharge" || $res_users[$i]['transaction_type'] == "R Offer Check" || $res_users[$i]['transaction_type'] == "User Info Check") {
				if ($res_users[$i]['status'] == "Success") {

					//$data[$j]['success'] = "<i class='fa fa-rupee-sign'></i> " . $res_users[$i]['amount'];
					$total_success = $total_success + $res_users[$i]['amount'];
					$data[$j]['success'] = "<i class='fa fa-rupee-sign'></i> " . $total_success;
				} else if ($res_users[$i]['status'] == "Pending") {
					$data[$j]['pending'] = "<i class='fa fa-rupee-sign'></i> " . $res_users[$i]['amount'];
				} else if ($res_users[$i]['status'] == "Failed") {
					$data[$j]['failed'] = "<i class='fa fa-rupee-sign'></i> " . $res_users[$i]['amount'];
				}
			} else if ($res_users[$i]['transaction_type'] == "Commission") {
				$data[$j]['revenue'] = "<i class='fa fa-rupee-sign'></i> " . $res_users[$i]['amount'];
			} else {
				$data[$j]['refund'] = "<i class='fa fa-rupee-sign'></i> " . $res_users[$i]['amount'];
			}

		} else {
			if ($res_users[$i]['transaction_type'] == "Recharge" || $res_users[$i]['transaction_type'] == "R Offer Check" || $res_users[$i]['transaction_type'] == "User Info Check") {
				if ($res_users[$i]['status'] == "Success") {
					//$data[$j]['success'] = "<i class='fa fa-rupee-sign'></i> " . $res_users[$i]['amount'];
					$total_success = $total_success + $res_users[$i]['amount'];
					$data[$j]['success'] = "<i class='fa fa-rupee-sign'></i> " . $total_success;
				} else if ($res_users[$i]['status'] == "Pending") {
					$data[$j]['pending'] = "<i class='fa fa-rupee-sign'></i> " . $res_users[$i]['amount'];
				} else if ($res_users[$i]['status'] == "Failed") {
					$data[$j]['failed'] = "<i class='fa fa-rupee-sign'></i> " . $res_users[$i]['amount'];
				}
			} else if ($res_users[$i]['transaction_type'] == "Commission") {
				$data[$j]['revenue'] = "<i class='fa fa-rupee-sign'></i> " . $res_users[$i]['amount'];
			} else {
				$data[$j]['refund'] = "<i class='fa fa-rupee-sign'></i> " . $res_users[$i]['amount'];
			}
		}

	}
	/*$data[$i]['user_name'] = "Total";
		$data[$i]['balance_amount'] = "<i class='fa fa-rupee-sign'></i> " . round($res_total[0]['total_amount'], 2);
		$data[$i]['credit_amount'] = "<i class='fa fa-rupee-sign'></i> " . round($res_total[0]['credit_amount'], 2);
		$data[$i]['status'] = "";
	*/
} else {
	$data = array();
}

## Response
$response = array(
	"draw" => intval($draw),
	"iTotalRecords" => $res_total[0]['total_users'],
	"iTotalDisplayRecords" => $res_total[0]['total_users'],
	"aaData" => $data,
);

echo json_encode($response);
?>
