<?php

include "include.php";
if ($o->user_id > 0) {
$dd = explode(" ", todaysDate());
//pt($_POST);
if (isset($_POST['from_date']) && $_POST['from_date'] != "") {
            $trigger_from_date = "request_date >= '" . $_POST['from_date'] . " 00:00:00'";
        } else {
            $trigger_from_date = "request_date >= '" . $dd[0] . " 00:00:00'";
        }
        if (isset($_POST['to_date']) && $_POST['to_date'] != "") {
            $trigger_to_date = "request_date <= '" . $_POST['to_date']. " 23:59:58' ";
        } else {
            $trigger_to_date = "request_date <= '" . $dd[0] . " 23:59:58' ";
        }
    $sql = "Select * from request_money where  user_id ='" . $o->user_id . "'  and $trigger_from_date and $trigger_to_date order by request_date DESC";
    //pt($sql);die;
	$res = getXbyY($sql);
    $rows = count($res);
    for ($i = 0; $i < $rows; $i++) {

        $results[$i]['request_to'] = (string) $res[$i]['request_to'];
        $results[$i]['amount'] = (string) $res[$i]['amount'];
        $results[$i]['request_date'] = (string) format_date1($res[$i]['request_date']);
        $results[$i]['status'] = (string) $res[$i]['status'];
        $results[$i]['ref_number'] = (string) $res[$i]['ref_number'];
        $results[$i]['transfer_mode'] = (string) $res[$i]['transfer_mode'];
        $results[$i]['transaction_number'] = (string) $res[$i]['transaction_number'];
        $results[$i]['decision'] = (string) $res[$i]['decision'];
        $results[$i]['decision_date'] = (string) $res[$i]['decision_date'];
        
	}
		$result['request_list'] = $results;
		$result['error'] = "0";
		$result['error_msg'] = "Fetch Data";
} else {
    $result['error'] = "1";
    $result['error_msg'] = "No Data found.";
}


echo json_encode($result);
?>