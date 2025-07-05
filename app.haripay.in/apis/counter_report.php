<?php

include "include.php";
if (isset($_POST)) {

    $dd = explode(" ", todaysDate());


    $trigger_from_date = "1=1";
    $trigger_to_date = "1=1";
    $trigger_to_date1 = '1=1';
    $flag_date = "0";


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

    $sql_transactions = "Select *  from wallet  where    user_id = '" . $o->user_id . "'  and $trigger_from_date and $trigger_to_date order by wallet_id ASC ";
    $res_transactions = getXbyY($sql_transactions);
    $row_transactions = count($res_transactions);
    $flag_dmr_open = "0";
    $flag_main_open = "0";
    $flag_aeps_open = "0";

    $main_opening = $o->amount_balance;
    $main_closing = $o->amount_balance;
    $main_success = '0';
    $main_pending = '0';
    $main_failed = '0';
    $main_com = '0';
    $main_bal = '0';
    $main_refund = '0';

    $dmr_opening = $o->dmr_balance;
    $dmr_closing = $o->dmr_balance;
    $dmr_success = '0';
    $dmr_pending = '0';
    $dmr_failed = '0';
    $dmr_com = '0';
    $dmr_bal = '0';
    $dmr_refund = '0';



    $aeps_opening = $o->aeps_balance;
    $aeps_closing = $o->aeps_balance;
    $aeps_success = '0';
    $aeps_pending = '0';
    $aeps_failed = '0';
    $aeps_bal = '0';
    $aeps_com = '0';
    $aeps_refund = '0';


    $main_res['opening'] = $main_opening;
    $main_res['closing'] = $main_closing;
    $main_res['pending'] = $main_pending;
    $main_res['failed'] = $main_failed;
    $main_res['success'] = $main_success;
    $main_res['commision'] = $main_com;
    $main_res['add_balance'] = $main_bal;
    $main_res['refund'] = $main_refund;
    

    $dmr_res['opening'] = $dmr_opening;
    $dmr_res['closing'] = $dmr_closing;
    $dmr_res['pending'] = $dmr_pending;
    $dmr_res['success'] = $dmr_success;
    $dmr_res['failed'] = $dmr_failed;
    $dmr_res['commision'] = $dmr_com;
    $dmr_res['add_balance'] = $dmr_bal;
    $dmr_res['refund'] = $dmr_refund;


    $aeps_res['opening'] = $aeps_opening;
    $aeps_res['closing'] = $aeps_closing;
    $aeps_res['pending'] = $aeps_pending;
    $aeps_res['success'] = $aeps_success;
    $aeps_res['failed'] = $aeps_failed;
    $aeps_res['commision'] = $aeps_com;
    $aeps_res['add_balance'] = $aeps_bal;
    $aeps_res['refund'] = $aeps_refund;






    if ($row_transactions > 0) {
        for ($i = 0; $i < $row_transactions; $i++) {

            if ($res_transactions[$i]['provider_type'] == "Money Transfer") {
                if ($flag_dmr_open == "0") {
                    $dmr_opening = $res_transactions[$i]['user_old_balance'];
                    $flag_dmr_open = "1";
                }
                $dmr_closing = $res_transactions[$i]['user_new_balance'];
                if ($res_transactions[$i]['status'] == "Success" && $res_transactions[$i]['transaction_type'] == "Recharge" && $res_transactions[$i]['parent_id'] == "0") {
                    $dmr_success = $dmr_success + $res_transactions[$i]['amount'];
                     $dmr_com = $dmr_com + $res_transactions[$i]['total_amount'];
                } else if ($res_transactions[$i]['status'] == "Failed" && $res_transactions[$i]['transaction_type'] == "Recharge" && $res_transactions[$i]['parent_id'] == "0") {
                    $dmr_failed = $dmr_failed + $res_transactions[$i]['total_amount'];
                } else if ($res_transactions[$i]['status'] == "Pending" && $res_transactions[$i]['transaction_type'] == "Recharge" && $res_transactions[$i]['parent_id'] == "0") {
                    $dmr_pending = $dmr_pending + $res_transactions[$i]['amount'];
                }
                
                
                if ($res_transactions[$i]['status'] == "Success" && $res_transactions[$i]['transaction_type'] == "Refund" ) {
                    $dmr_refund = $dmr_refund + $res_transactions[$i]['total_amount'];
                }
            } else if ($res_transactions[$i]['provider_type'] == "Prepaid" || $res_transactions[$i]['provider_type'] == "DTH" || $res_transactions[$i]['provider_type'] == "Postpaid" || $res_transactions[$i]['provider_type'] == "Electricity") {
                if ($flag_main_open == "0") {
                    $main_opening = $res_transactions[$i]['user_old_balance'];
                    $flag_main_open = "1";
                }
                $main_closing = $res_transactions[$i]['user_new_balance'];

                if ($res_transactions[$i]['status'] == "Success" && $res_transactions[$i]['transaction_type'] == "Recharge" && $res_transactions[$i]['parent_id'] == "0") {
                    $main_success = $main_success + $res_transactions[$i]['amount'];
                    $main_com = $main_com + $res_transactions[$i]['total_amount'];
                } else if ($res_transactions[$i]['status'] == "Failed" && $res_transactions[$i]['transaction_type'] == "Recharge" && $res_transactions[$i]['parent_id'] == "0") {
                    $main_failed = $main_failed + $res_transactions[$i]['total_amount'];
                } else if ($res_transactions[$i]['status'] == "Pending" && $res_transactions[$i]['transaction_type'] == "Recharge" && $res_transactions[$i]['parent_id'] == "0") {
                    $main_pending = $main_pending + $res_transactions[$i]['amount'];
                }
                 if ($res_transactions[$i]['status'] == "Success" && $res_transactions[$i]['transaction_type'] == "Refund" ) {
                    $main_refund = $main_refund + $res_transactions[$i]['total_amount'];
                }
            } else if ($res_transactions[$i]['provider_type'] == "Aeps") {
                if ($flag_aeps_open == "0") {
                    $aeps_opening = $res_transactions[$i]['user_old_balance'];
                    $flag_aeps_open = "1";
                }
                $aeps_closing = $res_transactions[$i]['user_new_balance'];

                if ($res_transactions[$i]['status'] == "Success" && $res_transactions[$i]['transaction_type'] == "Aeps" && $res_transactions[$i]['parent_id'] == "0") {
                    $aeps_success = $aeps_success + $res_transactions[$i]['amount'];
                } else if ($res_transactions[$i]['status'] == "Failed" && $res_transactions[$i]['transaction_type'] == "Aeps" && $res_transactions[$i]['parent_id'] == "0") {
                    $aeps_failed = $aeps_failed + $res_transactions[$i]['total_amount'];
                } else if ($res_transactions[$i]['status'] == "Pending" && $res_transactions[$i]['transaction_type'] == "Aeps" && $res_transactions[$i]['parent_id'] == "0") {
                    $aeps_pending = $aeps_pending + $res_transactions[$i]['amount'];
                }
                 if ($res_transactions[$i]['status'] == "Success" && $res_transactions[$i]['transaction_type'] == "Refund" ) {
                    $aeps_refund = $aeps_refund + $res_transactions[$i]['total_amount'];
                }
            } else if ($res_transactions[$i]['transaction_type'] == "Recieve Money") {
                if ($res_transactions[$i]['status'] == "Success" && $res_transactions[$i]['wallet_balance'] == "Main") {

                    if ($flag_main_open == "0") {
                        $main_opening = $res_transactions[$i]['user_old_balance'];
                        $flag_main_open = "1";
                    }
                    $main_closing = $res_transactions[$i]['user_new_balance'];


                    $main_bal = $main_bal + $res_transactions[$i]['amount'];
                }
                if ($res_transactions[$i]['status'] == "Success" && $res_transactions[$i]['wallet_balance'] == "Dmr") {
                    if ($flag_dmr_open == "0") {
                        $dmr_opening = $res_transactions[$i]['user_old_balance'];
                        $flag_dmr_open = "1";
                    }
                    $dmr_closing = $res_transactions[$i]['user_new_balance'];
                    $dmr_bal = $dmr_bal + $res_transactions[$i]['amount'];
                }
                if ($res_transactions[$i]['status'] == "Success" && $res_transactions[$i]['wallet_balance'] == "Aeps") {
                    if ($flag_aeps_open == "0") {
                        $aeps_opening = $res_transactions[$i]['user_old_balance'];
                        $flag_aeps_open = "1";
                    }
                    $aeps_closing = $res_transactions[$i]['user_new_balance'];
                    $aeps_bal = $aeps_bal + $res_transactions[$i]['amount'];
                }
            }
        }

        $main_res['opening'] = (string) $main_opening;
        $main_res['closing'] = (string) $main_closing;
        $main_res['pending'] = (string) $main_pending;
        $main_res['failed'] = (string) $main_failed;
        $main_res['success'] = (string) $main_success;
        $main_res['commision'] = (string) round($main_com - $main_success,2);
        $main_res['add_balance'] = (string) $main_bal;
        $main_res['refund'] = (string) $main_refund;


        $dmr_res['opening'] = (string) $dmr_opening;
        $dmr_res['closing'] = (string) $dmr_closing;
        $dmr_res['pending'] = (string) $dmr_pending;
        $dmr_res['success'] = (string) $dmr_success;
        $dmr_res['failed'] = (string) $dmr_failed;
        $dmr_res['commision'] = (string) round( $dmr_success - $dmr_com,2);
        $dmr_res['add_balance'] = (string) $dmr_bal;
        $dmr_res['refund'] = (string) $dmr_refund;


        $aeps_res['opening'] = (string) $aeps_opening;
        $aeps_res['closing'] = (string) $aeps_closing;
        $aeps_res['pending'] = (string) $aeps_pending;
        $aeps_res['success'] = (string) $aeps_success;
        $aeps_res['failed'] = (string) $aeps_failed;
        $aeps_res['commision'] = (string) $aeps_com;
        $aeps_res['add_balance'] = (string) $aeps_bal;
        $aeps_res['refund'] = (string) $aeps_refund;


        $result['main'] = $main_res;
        $result['aeps'] = $aeps_res;
        $result['dmr'] = $dmr_res;
        $result['error'] = "0";
        $result['error_msg'] = "Fetch Data";
    } else {
        $result['main'] = $main_res;
        $result['aeps'] = $main_res;
        $result['dmr'] = $dmr_res;
         $result['error'] = "0";
        $result['error_msg'] = "Fetch Data";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong. Please try again";
}


echo json_encode($result);
?>