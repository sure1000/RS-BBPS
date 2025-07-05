<?php

include "include.php";


if ($_POST['dmt_send_updte'] == 1) {

    if ($_POST['paytm_user_id'] > 0) {
        $ben_id = $_POST['beneficiary_id_ep'];
        $amount = $_POST['dmt_amount'];

        $o1 = $factory->get_object($_POST['paytm_user_id'], "paytm_user", "paytm_user_id");

        $sql_chk_ben = "Select paytm_beneficiary_id from paytm_beneficiary where paytm_beneficiary_id='" . $ben_id . "' and paytm_user_id = '" . $o1->paytm_user_id . "' and is_active = '1'";
        $res_chk_ben = getXbyY($sql_chk_ben);
        $row_chk_ben = count($res_chk_ben);
        if ($row_chk_ben == "1") {
            $o2 = $factory->get_object($res_chk_ben[0]['paytm_beneficiary_id'], "paytm_beneficiary", "paytm_beneficiary_id");
            $o3->provider_id = '115';
            $dezire_amount = $amount;
            if ($dezire_amount <= 1000) {
                $ccf_amount = '10';
            } else {
                $ccf_amount = round((1 / 100) * $dezire_amount, 2);
                $ccf_amount = ceil($ccf_amount);
            }
            $tt_amount = 0;
            $tds_amount = 0;
            $gst_amount = '0';
            $comm_amount = 0;
            if ($amount_slab > 1) {
                $sql_comm = "Select * from dmr_commission where (start_amount <= '5000' and end_amount >='5000' ) and dmr_type = 'Paytm' and user_plan_id='" . $o->plan_id . "'  and is_active = 1";
                $res_comm = getXbyY($sql_comm);
                $tt_amount = 0;
                $comm_type = '';

                for ($i = 0; $i < $amount_slab; $i++) {
                    if ($i == ($amount_slab - 1)) {
                        $pending_amount = $dezire_amount - (5000 * $i);

                        $sql_comm = "Select * from dmr_commission where (start_amount <= '" . $pending_amount . "' and end_amount >='" . $pending_amount . "' ) and dmr_type = 'Paytm' and user_plan_id='" . $o->plan_id . "'  and is_active = 1";
                        $res_comm = getXbyY($sql_comm);
                        $transfer_amount[$i] = $pending_amount;
                        $comm_type = $res_comm[0]['commission_type'];
                        $commission_value = $res_comm[0]['commission_value'];
                        $tds_amt[$i] = $res_comm[0]['tds_amount'];
                        $gst_amt[$i] = $res_comm[0]['gst_amount'];
                        $gst_type[$i] = $res_comm[0]['gst_type'];
                        $tds_type[$i] = $res_comm[0]['tds_type'];
                        $rt_comm[$i] = $res_comm[0]['rt_amount'];
                    } else {
                        $comm_type = $res_comm[$i]['commission_type'];
                        $commission_value = $res_comm[$i]['commission_value'];
                        $transfer_amount[$i] = 5000;
                        $tds_amt[$i] = $res_comm[$i]['tds_amount'];
                        $gst_amt[$i] = $res_comm[$i]['gst_amount'];
                        $gst_type[$i] = $res_comm[$i]['gst_type'];
                        $tds_type[$i] = $res_comm[$i]['tds_type'];
                        $rt_comm[$i] = $res_comm[$i]['rt_amount'];
                    }

                    if ($comm_type == "Percentage") {
                        $comm_amount1 = round(($commission_value / 100) * $transfer_amount[$i], 2);
                        $comm_amount = $comm_amount + round(($commission_value / 100) * $transfer_amount[$i], 2);
                    } else {
                        $comm_amount1 = $commission_value;
                        $comm_amount = $comm_amount + $commission_value;
                    }
                    if ($gst_type[$i] == "Yes") {
                        $gst_amount1 = round($comm_amount1 * $gst_amt[$i] / 100, 3);
                        $gst_amount = $gst_amount + round($comm_amount1 * $gst_amt[$i] / 100, 3);
                    }
                    if ($tds_type[$i] == "Yes") {
                        $tds_amount1 = round($comm_amount1 * $tds_amt[$i] / 100, 3);
                        $tds_amount = $tds_amount + round($comm_amount1 * $tds_amt[$i] / 100, 3);
                    }
                    $rt_comm_show = $rt_comm + $rt_comm[$i];

                    $last_amount[$i] = $comm_amount1;
                    $tds_amount_wallet[$i] = $tds_amount1;
                    $gst_amount_wallet[$i] = $gst_amount1;
                    $rt_comm[$i] = $rt_comm;
                }
            } else {
                $sql_comm = "Select * from dmr_commission where (start_amount <= '" . $dezire_amount . "' and end_amount >='" . $dezire_amount . "' ) and dmr_type = 'Paytm' and user_plan_id='" . $o->plan_id . "'  and is_active = 1";
                $res_comm = getXbyY($sql_comm);
                $row_comm = count($res_comm);
                if ($row_comm > 0) {
                    if ($res_comm[0]['commission_type'] == 'Percentage') {
                        $comm_amount = round(($res_comm[0]['commission_value'] / 100) * $dezire_amount, 2);
                    } else {
                        $comm_amount = $res_comm[0]['commission_value'];
                    }

                    if ($res_comm[0]['gst_type'] == "Yes") {
                        $gst_amount = round($comm_amount * $res_comm[0]['gst_amount'] / 100, 3);
                    }
                    if ($res_comm[0]['tds_type'] == "Yes") {
                        $tds_amount = round($comm_amount * $res_comm[0]['tds_amount'] / 100, 3);
                    }
                    $rt_comm_show = $res_comm[0]['rt_amount'];
                }
                $last_amount[0] = $comm_amount;
                $transfer_amount[0] = $dezire_amount;
                $tds_amount_wallet[0] = $tds_amount;
                $gst_amount_wallet[0] = $gst_amount;
                $rt_comm[0] = $res_comm[0]['rt_amount'];
            }
           // $o1->amount = $dezire_amount + $comm_amount - $rt_comm_show;
            $o3->amount = $dezire_amount + $tt_amount;
            $hold_amount = $o->dmr_balance - $o->wallet_limit;
            if ($o3->amount <= $hold_amount) {
                $amount_slab = ceil($dezire_amount / 5000);
                for ($i = 0; $i < $amount_slab; $i++) {
                    unset($o3->wallet_id);
                    $o3->parent_id = 0;
                    $o3->api_id = "9";
                    $o3->api_amount = $transfer_amount[$i] + $comm_slab[$i];
                    $o3->transaction_type = "Recharge";
                    $o3->total_amount = $transfer_amount[$i];
                    $o3->amount = $transfer_amount[$i] + $comm_slab[$i];
                    $o3->mobile_number = $account_number;
                    $o3->circle_name = '0';
                    $o3->circle_id = "0";
                    $o3->status = "Pending";
                    $o3->user_ref_number = $orderId;
                    $o3->recharge_path = "Web";
                    $o3->payment_mode = $ccf_amount;
                    $o3 = wallet_insert_new($o, $o3);
                    $api_response = ep_send_money($o3, $o2, $o1);

                    if ($api_response['error'] == '0') {
                        $o3->transaction_details = "Money Transfer to " . $o2->beneficiaryName . " [ " . $o2->accountNo . " ] ";
                        $o3->comment = $api_response['data']['error_msg'];
                        $o3->gst = round((18 / 100) * $comm_slab[$i], 2);
                        $o3->updated_at = todaysDate();
                        $o3->api_response = $api_response['response'];
                        $o3->recharge_url = "0";
                        $o3->api_number = "0";
                        $o3->opid = "0";
                        $o3->tds = $tds_amount1;

                        $o3->status = $api_response['data']['status'];
                        if ($o3->status == 'Pending') {
                            $o3->status = "Pending";
                            $o3->wallet_id = $updater->update_object($o3, "wallet");
                            $result['error'] = "0";
                        } else if ($o3->status == 'Failed') {
                            $o3->status = "Failed";
                            $o3->wallet_id = $updater->update_object($o3, "wallet");
                            $o3->transaction_type = "Refund";
                            $o3->status = "Success";
                            $o3->parent_id = $o3->wallet_id;
                            $o3 = wallet_insert_new($o, $o3);
                            $api_response['data']['error_msg'] = "Server down . Transaction Failed";
                            $result['error'] = "1";
                        } else {
                              if ($api_response['data']['error_msg'] == "Sorry, Your Wallet Balance is less than Required Amount") {
                                $o3->status = "Failed";
                                $o3->wallet_id = $updater->update_object($o3, "wallet");
                                $o3->transaction_type = "Refund";
                                $o3->status = "Success";
                                $o3->parent_id = $o3->wallet_id;
                                $o3 = wallet_insert_new($o, $o3);
                                $api_response['data']['error_msg'] = "Server down . Transaction Failed";
                                 $result['error'] = "1";
                            } else {
                                $result['error'] = "1";
                            }
                        }

                        $result['error_msg'] = $api_response['data']['error_msg'];
                    } else {
                        $result['error'] = "1";
                        $result['error_msg'] = $api_response['error_msg'];
                    }
                }
            } else {
                $result['error'] = 1;
                $result['error_msg'] = "Sorry, Your Wallet Balance is less than Required Amount";
            }
        } else {
            $result['error'] = "1";
            $result['error_msg'] = "Beneficiary Account Not Found";
        }
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "Invalid User Mobile Number";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong.";
}

echo json_encode($result);
?>
