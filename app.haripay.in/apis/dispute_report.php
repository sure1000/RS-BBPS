<?php
include "include.php";
if (isset($_POST)) {
 $o->user_id = $_POST['user_id'];
    $o = $factory->get_object($o->user_id, "users", "user_id");
    if ($o->is_active == "1") {
$dd = explode(" ", todaysDate());
$trigger_provider_type = "1=1";
$trigger_provider_id = "1=1";
$trigger_from_date = "1=1";
$trigger_to_date = "1=1";
$trigger_search_val = "1=1";
 if (isset($_POST['service_id']) && $_POST['service_id'] != "" ) {
            //$provider_type = get_service_name($_POST['service_id']);
            $trigger_provider_type = "provider_type = '" .  $_POST['service_id'] . "'";
        }
        if (isset($_POST['provider_id'])  && $_POST['provider_id'] != "") {
            $trigger_provider_id = "provider_id = '" . $_POST['provider_id'] . "'";
        }
       
        if (isset($_POST['from_date']) && $_POST['from_date'] != "") {
            $trigger_from_date = "transaction_date >= '" . $_POST['from_date'] . " 00:00:00'";
        } else {
            $trigger_from_date = "transaction_date >= '" . $dd[0] . " 00:00:00'";
        }
        if (isset($_POST['to_date']) && $_POST['to_date'] != "") {
            $trigger_to_date = "transaction_date <= '" . $_POST['to_date']. " 23:59:58' ";
        } else {
            $trigger_to_date = "transaction_date <= '" . $dd[0] . " 23:59:58' ";
        }
        if (isset($_POST['search_val']) && $_POST['search_val'] != "") {
            $trigger_search_val = "(mobile_number = '" . $_POST['search_val'] . "' or ref_number = '" . $_POST['search_val'] . "' or opid = '" . $_POST['search_val'] . "')";
        }

     $triggers = $trigger_provider_type . " and " . $trigger_provider_id . " and " . $trigger_from_date . " and " . $trigger_to_date . " and " . $trigger_search_val;
$sql_total = "Select count(wallet_id) as total_transactions from wallet where user_id = " . $o->user_id . " and $triggers and (disputed = 'Yes' or disputed = 'Resolved') order by wallet_id desc";
$res_total = getXbyY($sql_total);

$sql_transactions = "Select * from wallet where user_id = " . $o->user_id . " and $triggers and (disputed = 'Yes' or disputed = 'Resolved') order by wallet_id DESC ";
//$sql_transactions = "Select * from wallet where user_id = ".$o->user_id." order by transaction_date DESC";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);

if ($row_transactions == 0) {
	$old_balance = "0";
} else {
	$sql_turnover = "Select transaction_type, sum(amount) as commission from wallet where user_id = '" . $o->user_id . "' and $triggers and wallet_id < " . $res_transactions[0]['wallet_id'];
	$res_turnover = getXbyY($sql_turnover);
	$row_turnover = count($res_turnover);

	$old_balance = round($res_turnover[0]['commission'], 2);

}

if ($row_transactions > 0) {

	for ($i = 0; $i < $row_transactions; $i++) {
$new_balance = $old_balance + $res_transactions[$i]['amount'];
		
		if ($res_transactions[$i]['circle_name'] == " ") {
			$res_transactions[$i]['circle_name'] = "Pan India";
		}

		// $ttype =  $res_transactions[$i]['transaction_type'] . " -"
		// 	. " " . $res_transactions[$i]['mobile_number'] . " (" . $res_transactions[$i]['provider_type'] . ") "
		// 	. "Ref. No.: " . $res_transactions[$i]['ref_number'] . " / " . $res_transactions[$i]['opid'] . " "
		// 	. $res_transactions[$i]['transaction_details'] . " (" . $res_transactions[$i]['provider_name'] . ")(" . $res_transactions[$i]['circle_name'] . ") "
		// 	. $res_transactions[$i]['recharge_path'] . " (" . $res_transactions[$i]['ip_address'] . ") ";
		// if ($res_transactions[$i]['disputed'] == "Yes") {
		// 	$ttype .= "  <button class='btn btn-warning' onclick='dispute_info(" . $res_transactions[$i]['ref_number'] . ")'>Open</button>";
		// } else {
		// 	$ttype .= "  <button class='btn btn-success' onclick='dispute_info(" . $res_transactions[$i]['ref_number'] . ")' >Resolved</button>";
		// }
$results[$i]['transaction_date'] = format_date($res_transactions[$i]['transaction_date']);
$results[$i]['transaction_type'] = $res_transactions[$i]['transaction_type'];
$results[$i]['reference_number'] ="Ref. No.: " . $res_transactions[$i]['ref_number'];
$results[$i]['opid']=$res_transactions[$i]['opid'];
$results[$i]['mobile_number'] =$res_transactions[$i]['mobile_number'];
$results[$i]['provider_circle'] =$res_transactions[$i]['provider_name'] ."(" . $res_transactions[$i]['circle_name'] . ") ";
$results[$i]['user_old_balance'] = "$old_balance";
$results[$i]['actual_amount']= $res_transactions[$i]['total_amount'];
$results[$i]['amount'] = $sign ." ". $res_transactions[$i]['amount'];
$results[$i]['user_new_balance'] ="$new_balance";

	}
$result['Dispute_report'] = $results;
            $result['error'] = "0";
            $result['error_msg'] = "Fetch History";

} else {
            $result['Dispute_report'] = "";
            $result['error'] = "1";
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