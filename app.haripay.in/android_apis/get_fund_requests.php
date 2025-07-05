<?php
include "include.php";
if (isset($_POST)) {
$o->user_id = $_POST['user_id'];
    $o = $factory->get_object($o->user_id, "users", "user_id");
if ($o->is_active == "1") {
 $dd = explode(" ", todaysDate());

$trigger_ref_number ="1=1";
$trigger_from_date = "1=1";
$trigger_to_date = "1=1";

if ($_POST['ref_number'] != "") {
            $trigger_ref_number = "(ref_number Like  '%" . $_POST['ref_number'] . "%' or api_number Like  '%" . $_POST['ref_number'] . "%')";
        }
        if ($_POST['from_date'] != "") {
            $trigger_from_date = "request_date >= '" . $_POST['from_date'] . " 00:00:00'";
        } else {
            $trigger_from_date = "request_date >= '" . $dd[0] . " 00:00:00'";
        }
        if ($_POST['to_date'] != "") {
            $trigger_to_date = "request_date <= '" . $_POST['to_date'] . " 23:59:58'";
        } else {
            $trigger_to_date = "request_date <= '" . $dd[0] . " 23:59:58' ";
        }

        $triggers = $trigger_ref_number .  " and " . $trigger_from_date . " and " . $trigger_to_date;

$sql_total = "Select count(request_money_id) as total_transactions from request_money where    user_id='" . $o->user_id . "' and $triggers";
$res_total = getXbyY($sql_total);

$sql_transactions = "Select *  from request_money  where   user_id = '" . $o->user_id . "' and  $triggers order by request_money_id DESC ";
$res_transactions = getXbyY($sql_transactions);
$row_transactions = count($res_transactions);
if($row_transactions > 0 ){

	 for ($i = 0; $i < $row_transactions; $i++) {

        $class = 'green';
        $sign = '+';

        $ref_number = $res_transactions[$i]['ref_number'];

        if ($res_transactions[$i]['money_file'] != "") {
            $ref_number .= "<br/><a target='_blank' href='../wallet_image/" . $res_transactions[$i]['file_money'] . "'>(File View)</a>";
        }

	 
            $results[$i]['api_number'] = $res_transactions[$i]['transaction_number'];
            $results[$i]['transaction_date'] =format_date($res_transactions[$i]['request_date']);
         $results[$i]['user_old_balance'] ="" . $res_transactions[$i]['bank_details'];
      $results[$i]['amount'] = $res_transactions[$i]['amount'];
          $results[$i]['user_new_balance']="" . $res_transactions[$i]['status'];
             $results[$i]['transaction_type']=$res_transactions[$i]['transfer_mode'];
             $results[$i]['ref_number'] =$ref_number;
             $results[$i]['comment'] = $res_transactions[$i]['remark'];

	 }
  $result['fund_requests'] = $results;
            $result['error'] = "0";
            $result['error_msg'] = "Fetch Requested Funds";
}else{
            $result['fund_requests'] = "[]";
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