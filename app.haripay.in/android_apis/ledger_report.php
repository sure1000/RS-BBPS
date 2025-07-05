<?php

include "include.php";
if (isset($o)) {

    $o = $factory->get_object($o->user_id, "users", "user_id");
    if ($o->is_active == "1") {
$dd = explode(" ", todaysDate());
$trigger_provider_type = "1=1";
$trigger_provider_id = "1=1";
$trigger_transaction_type = "1=1";
$trigger_status = "1=1";
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
        if (isset($_POST['transaction_type'])  && $_POST['transaction_type'] != "") {
            $trigger_transaction_type = "transaction_type = '" . $_POST['transaction_type'] . "'";
        }
        if (isset($_POST['status'])  && $_POST['status'] != "") {
            $trigger_status = "status = '" . $_POST['status'] . "'";
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

     $triggers = $trigger_provider_type . " and " . $trigger_provider_id . " and " . $trigger_transaction_type . " and " . $trigger_status . " and " . $trigger_from_date . " and " . $trigger_to_date . " and " . $trigger_search_val;
     $sql_total = "Select count(wallet_id) as total_transactions from wallet where user_id = " . $o->user_id . " and $triggers";
$res_total = getXbyY($sql_total);

$sql_transactions = "Select * from wallet where user_id = " . $o->user_id . " and $triggers order by wallet_id DESC ";

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
        // $ttype = $res_transactions[$i]['transaction_type'] . "/"
        //     .  $res_transactions[$i]['mobile_number'] . " (" . $res_transactions[$i]['provider_type'] . ") /"
        //     . "Ref. No.: " . $res_transactions[$i]['ref_number'] . " / " . $res_transactions[$i]['opid'] . "/"
        //     . $res_transactions[$i]['transaction_details'] . " (" . $res_transactions[$i]['provider_name'] . ")(" . $res_transactions[$i]['circle_name'] . ")/"
        //     . $res_transactions[$i]['recharge_path'] . " (" . $res_transactions[$i]['ip_address'] . ")";
        
        if ($class == "green") {
            $credit = $res_transactions[$i]['amount'] ;
            $debit = "";
        } else {
            $credit = "";
            $debit =  $res_transactions[$i]['amount'] ;
        }
 if($res_transactions[$i]['transaction_type']=='Recharge'){
           $data[$i]['transaction_detail'] .= "Paid For ".$res_transactions[$i]['provider_name']." No. ". $res_transactions[$i]['mobile_number']; 
       } else if($res_transactions[$i]['transaction_type']=='Refund') {
         $data[$i]['transaction_detail'] .= "Refund ".$res_transactions[$i]['provider_name']." No. ". $res_transactions[$i]['mobile_number']; 
     } else {
      $data[$i]['transaction_detail'] .= $res_transactions[$i]['transaction_details']; 
  }
        
                $results[$i]['transaction_date'] = format_date($res_transactions[$i]['transaction_date']);
                $results[$i]['transaction_type'] = $data[$i]['transaction_detail'];
                $results[$i]['credit_amount'] =$credit;
                $results[$i]['ref_numer'] = $res_transactions[$i]['ref_number'];
                $results[$i]['debit_amount'] = $debit;
				$results[$i]['user_old_balance'] = $res_transactions[$i]['user_old_balance'];
                $results[$i]['user_new_balance'] = $res_transactions[$i]['user_new_balance'];
               
            }

            $result['Ledger_report'] = $results;
            $result['error'] = "0";
            $result['error_msg'] = "Fetch History";



} else {
            $result['Ledger_report'] = "";
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