<?php

include "include.php";
if (isset($o)) {
$dd = explode(" ", todaysDate());
//pt($_POST);
if (isset($_POST['from_date']) && $_POST['from_date'] != "") {
            $trigger_from_date = "d.dispute_date >= '" . $_POST['from_date'] . " 00:00:00'";
        } else {
            $trigger_from_date = "d.dispute_date >= '" . $dd[0] . " 00:00:00'";
        }
        if (isset($_POST['to_date']) && $_POST['to_date'] != "") {
            $trigger_to_date = "d.dispute_date <= '" . $_POST['to_date']. " 23:59:58' ";
        } else {
            $trigger_to_date = "d.dispute_date <= '" . $dd[0] . " 23:59:58' ";
        }
		//pt($trigger_to_date);
		$sql_total="SELECT * FROM disputes AS d,wallet AS w WHERE w.wallet_id = d.wallet_id and d.user_id ='$o->user_id' and $trigger_from_date and $trigger_to_date";
		$res_transactions = getXbyY($sql_total);
		$row_transactions = count($res_transactions);
		if ($row_transactions > 0) {
			for ($i = 0; $i < $row_transactions; $i++) {

				$results[$i]['transaction_date'] = format_date($res_transactions[$i]['transaction_date']);
				$results[$i]['dispute_date'] = $res_transactions[$i]['dispute_date'];
				$results[$i]['dispute'] = $res_transactions[$i]['dispute'];
				$results[$i]['dispute_resolution'] = $res_transactions[$i]['dispute_resolution'];
				$results[$i]['resolution_date'] = $res_transactions[$i]['resolution_date'];
				$results[$i]['reference_number'] =$res_transactions[$i]['ref_number'];
				$results[$i]['opid']=$res_transactions[$i]['opid'];
				$results[$i]['mobile_number'] =$res_transactions[$i]['mobile_number'];
				$results[$i]['provider_circle'] =$res_transactions[$i]['provider_name'] ."(" . $res_transactions[$i]['circle_name'] . ") ";
				$results[$i]['user_old_balance'] = "$old_balance";
				$results[$i]['total_amount']= $res_transactions[$i]['total_amount'];
				$results[$i]['amount'] = $sign ." ". $res_transactions[$i]['amount'];
				$results[$i]['user_new_balance'] ="$new_balance";

			}
			$result['Dispute_report'] = $results;
            $result['error'] = "0";
            $result['error_msg'] = "Fetch History";
		}else{
			$result['Dispute_report'] = "";
            $result['error'] = "1";
            $result['error_msg'] = "No Data Found";
		}
		
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong. Please try again";
}
echo json_encode($result);
?>
