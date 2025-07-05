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

$trigger_provider_type = "1=1";
$trigger_provider_id = "1=1";
$trigger_transaction_type = "1=1";
$trigger_status = "1=1";
$trigger_from_date = "1=1";
$trigger_to_date = "1=1";
$trigger_user_id = "1=1";
$trigger_api_id = "1=1";


if (isset($_SESSION['search_ledger'])) {
	if (isset($_SESSION['search_ledger']['service_id'])) {
		$provider_type = get_service_name($_SESSION['search_ledger']['service_id']);
		$trigger_provider_type = "provider_type = '" . $provider_type . "'";
	}
	if (isset($_SESSION['search_ledger']['provider_id'])) {
		$trigger_provider_id = "provider_id = '" . $_SESSION['search_ledger']['provider_id'] . "'";
	}
	if (isset($_SESSION['search_ledger']['user_id'])) {
		$trigger_user_id = "user_id = '" . $_SESSION['search_ledger']['user_id'] . "'";
	}
	if (isset($_SESSION['search_ledger']['api_id'])) {
		$trigger_api_id = "api_id = '" . $_SESSION['search_ledger']['api_id'] . "'";
	}
	if (isset($_SESSION['search_ledger']['transaction_type'])) {
		$trigger_transaction_type = "transaction_type = '" . $_SESSION['search_ledger']['transaction_type'] . "'";
	}
	if (isset($_SESSION['search_ledger']['status'])) {
		$trigger_status = "status = '" . $_SESSION['search_ledger']['status'] . "'";
	}
	if (isset($_SESSION['search_ledger']['from_date'])) {
		$trigger_from_date = "transaction_date >= '" . $_SESSION['search_ledger']['from_date'] . "'";
	}
	if (isset($_SESSION['search_ledger']['to_date'])) {
		$trigger_to_date = "transaction_date <= '" . $_SESSION['search_ledger']['to_date'] . "'";
	}
	
}

$triggers = $trigger_user_id." and ".$trigger_api_id." and  " .$trigger_provider_type . " and " . $trigger_provider_id . " and " . $trigger_transaction_type . " and " . $trigger_status . " and " . $trigger_from_date . " and " . $trigger_to_date;

$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
//pt($_POST);

$sql_total = "Select count(wallet_id) as total_transactions from wallet where $triggers";
$res_total = getXbyY($sql_total);

$sql_transactions = "Select * from wallet where  $triggers order by wallet_id DESC limit $row ,$length";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);

if ($row_transactions > 0) {

	for ($i = 0; $i < $row_transactions; $i++) {
		$class = transaction_type($res_transactions[$i]['transaction_type']);
		if ($class == "red") {
			$sign = "-";
		} else {
			$sign = "+";
		}
		if ($res_transactions[$i]['circle_name'] == " " || $res_transactions[$i]['circle_name'] == "") {
			$res_transactions[$i]['circle_name'] = "Pan India";
		}
		if ($res_transactions[$i]['provider_type'] == "") {
			$res_transactions[$i]['provider_type'] = "Wallet Transaction";
		}
		if ($res_transactions[$i]['provider_name'] == "") {
			$res_transactions[$i]['provider_name'] = "Wallet";
		}
		$ttype = "<b>" . $res_transactions[$i]['transaction_type'] . "</b> -"
			. "<b>" . $res_transactions[$i]['mobile_number'] . " (" . $res_transactions[$i]['provider_type'] . ")</b><br />"
			. "Ref. No.: " . $res_transactions[$i]['ref_number'] . " / " . $res_transactions[$i]['opid'] . "<br />"
			. $res_transactions[$i]['transaction_details'] . " (" . $res_transactions[$i]['provider_name'] . ")(" . $res_transactions[$i]['circle_name'] . ")<br />"
			. $res_transactions[$i]['recharge_path'] . " <b>(" . $res_transactions[$i]['ip_address'] . ")<br />";
		/*
				if ($res_transactions[$i]['status'] == "Success") {
					$ttype .= "<button class='btn btn-success' disabled='disabled'>Success</button>";
				} else if ($res_transactions[$i]['status'] == "Pending" || $res_transactions[$i]['InQueue']) {
					$ttype .= "<button class='btn btn-info' disabled='disabled'>Pending</button>";
					$ttype .= " <button class='btn btn-primary btn-lightblue' onclick='check_status(" . $res_transactions[$i]['wallet_id'] . ")'>Verify Status</button>";
				} else {
					$ttype .= "<button class='btn btn-danger' disabled='disabled'>Failed</button>";
				}

			if ($res_transactions[$i]['transaction_type'] == "Recharge" && $res_transactions[$i]['status'] == "Success" && $res_transactions[$i]['disputed'] == "No") {
				$ttype .= " <button class='btn btn-warning' id='dispute_" . $res_transactions[$i]['ref_number'] . "' onclick='dispute_recharge(" . $res_transactions[$i]['ref_number'] . ")'>Dispute</button>";
			}

			if ($res_transactions[$i]['disputed'] == "Yes") {
				$ttype .= " <button class='btn btn-outline-warning' disabled='disabled'>Disputed</button>";
			}
		*/
		if ($class == "green") {
			$credit = "<span class='green'><i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['amount'] . "</span>";
			$debit = "";
		} else {
			$credit = "";
			$debit = "<span class='red'><i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['amount'] . "</span>";
		}

		$data[] = array(
			"transaction_date" => format_date($res_transactions[$i]['transaction_date']),
			"transaction_type" => $ttype,
			"user_old_balance" => $credit,
			"amount" => $debit,
			"user_new_balance" => "<i class='fa fa-rupee-sign'></i> " . $res_transactions[$i]['user_new_balance'],
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
