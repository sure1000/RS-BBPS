<?php

include "include.php";
if (isset($_POST)) {
    $o->user_id = $_POST['user_id'];
    $o = $factory->get_object($o->user_id, "users", "user_id");
    if ($o->is_active == "1") {
        $dd = explode(" ", todaysDate());

        $trigger_ref_number = "1=1";
        $trigger_from_date = "1=1";
        $trigger_to_date = "1=1";
        $trigger_to_date1 = '1=1';
        $transaction_type = '1=1';
        $flag_date = "0";

        $old_date = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 5, date("y"))) . " " . ' 00:00:01';

        if (isset($_POST['from_date'])) {
            $start_date = $_POST['from_date'] . " 00:00:00";
            $date_diff = (strtotime($old_date) - strtotime($start_date));

            if ($date_diff > 0) {
                $flag_date = "1";
            }
        }
        if ($_POST['ref_number'] != "") {
            $trigger_ref_number = "(ref_number Like  '%" . $_POST['ref_number'] . "%' or api_number Like  '%" . $_POST['ref_number'] . "%')";
        }
		if ($_POST['transaction_type'] != "") {
            $transaction_type = " transaction_type ='". $_POST['transaction_type'] ."'";
        }
        if ($flag_date == '0') {
            if ($_POST['from_date'] != "") {
                $trigger_from_date = "transaction_date >= '" . $_POST['from_date'] . " 00:00:00'";
            } else {
                $trigger_from_date = "transaction_date >= '" . $dd[0] . " 00:00:00'";
            }
            if ($_POST['to_date'] != "") {
                $trigger_to_date = "transaction_date <= '" . $_POST['to_date'] . " 23:59:59'";
            } else {
                $trigger_to_date = "transaction_date <= '" . $dd[0] . " 23:59:59' ";
            }
        } else {
            if ($_POST['from_date'] != "") {
                $trigger_from_date = "transaction_date >= '" . $_POST['from_date'] . " 00:00:00'";
            }
            $today_dt = strtotime(date('d-m-Y'));
            $to_date = strtotime($_POST['to_date']);

            if ($today_dt == $to_date) {

                $trigger_to_date = 'transaction_date <= "' . date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 1, date("y"))) . " " . '23:59:59"';

                $trigger_to_date1 = "transaction_date >= '" . date('Y-m-d') . " 00:00:00'";
            } else if ($to_date < $today_dt) {

                if (isset($_POST['to_date'])) {
                    $trigger_to_date = "transaction_date <= '" . $_POST['to_date'] . " 23:59:59'";
                }
            }
        }

        $triggers = $trigger_ref_number;
        if ($flag_date == '0') {
            $sql_total = "Select count(wallet_id) as total_transactions from wallet where  ( transaction_type='Payment Gateway' OR transaction_type='Commission' OR transaction_type='Recieve Money' or transaction_type ='Reverse')  and  user_id='" . $o->user_id . "' and $triggers and $trigger_from_date and $trigger_to_date and $transaction_type";
            $sql_transactions = "Select *  from wallet  where  ( transaction_type='Payment Gateway' OR transaction_type='Commission' OR transaction_type='Recieve Money' or transaction_type ='Reverse') and  user_id = '" . $o->user_id . "' and  $triggers and $trigger_from_date and $trigger_to_date and $transaction_type order by wallet_id DESC ";
        } else {
            if ($trigger_to_date1 != '1=1') {
                $sql_total1 = "Select count(wallet_id) as total_transactions from wallet where  ( transaction_type='Payment Gateway' OR transaction_type='Commission' OR transaction_type='Recieve Money' or transaction_type ='Reverse')  and  user_id='" . $o->user_id . "' and $triggers and  $trigger_to_date1 and  $transaction_type";
                $sql_transactions1 = "Select *  from wallet  where  ( transaction_type='Payment Gateway' OR transaction_type='Commission' OR transaction_type='Recieve Money' or transaction_type ='Reverse') and  user_id = '" . $o->user_id . "' and  $triggers and  $trigger_to_date1 and  $transaction_type order by wallet_id ASC ";
                $res_total1 = getXbyY($sql_total1);
                $res_transactions1 = getXbyY($sql_transactions1);
            }
            $sql_total = "Select count(wallet_id) as total_transactions from wallet where  ( transaction_type='Payment Gateway' OR transaction_type='Commission' OR transaction_type='Recieve Money' or transaction_type ='Reverse')  and  user_id='" . $o->user_id . "' and $triggers and $trigger_from_date and $trigger_to_date and $transaction_type";
            $sql_transactions = "Select *  from wallet  where  ( transaction_type='Payment Gateway' OR transaction_type='Commission' OR transaction_type='Recieve Money' or transaction_type ='Reverse') and  user_id = '" . $o->user_id . "' and  $triggers and $trigger_from_date and $trigger_to_date and $transaction_type order by wallet_id ASC ";
        }

        $res_total = getXbyY($sql_total);
        $res_transactions = getXbyY($sql_transactions);
        $row_transactions = count($res_transactions);
        if ($flag_date == '1') {
            $res_total[0]['total_transactions'] = $res_total[0]['total_transactions'] + $res_total1[0]['total_transactions'];
            for ($n = 0; $n < count($res_transactions1); $n++) {
                $res_transactions[$row_transactions + $n] = $res_transactions1[$n];
            }
            $row_transactions = count($res_transactions);
        }
        if ($row_transactions > 0) {
            for ($i = 0; $i < $row_transactions; $i++) {
                if ($res_transactions[$i]['transfer_type'] == "Debit") {
                    $class = 'red';
                    $sign = '-';
                } else {
                    $class = 'green';
                    $sign = '+';
                }
                $ref_number = $res_transactions[$i]['ref_number'];

                if ($res_transactions[$i]['money_file'] != "") {
                    $ref_number .= "<br/><a target='_blank' href='../wallet_image/" . $res_transactions[$i]['money_file'] . "'>(File View)</a>";
                }

                $results[$i]['api_number'] = $res_transactions[$i]['api_number'];
                $results[$i]['transaction_date'] = $res_transactions[$i]['transaction_date'];
                $results[$i]['user_old_balance'] = $res_transactions[$i]['user_old_balance'];
                $results[$i]['amount'] = $res_transactions[$i]['amount'];
                $results[$i]['transaction_type'] = $res_transactions[$i]['transaction_type'];
                $results[$i]['user_new_balance'] = $res_transactions[$i]['user_new_balance'];
                $results[$i]['payment_mode'] = $res_transactions[$i]['cash_credit'];
                $results[$i]['ref_number'] = $ref_number;
                 $results[$i]['by'] = $res_transactions[$i]['user_1_name'];
                $results[$i]['comment'] = $res_transactions[$i]['comment'];
            }



            $result['all_transactions'] = $results;
            $result['error'] = "0";
            $result['error_msg'] = "Fetch Recieved Funds";
        } else {
            $result['all_transactions'] = "[]";
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