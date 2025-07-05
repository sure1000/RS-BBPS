<?php

include "include.php";


if ($_POST['dmt_send_updte'] == '1') {
    $beneficiary_id = $_POST['beneficiary_id_ep'];
    $dezire_amount = $_POST['dmt_amount'];
    if ($beneficiary_id > 0) {
        $o3 = $factory->get_object($beneficiary_id, "paytm_beneficiary", "paytm_beneficiary_id");
    }
    $o2->api_id = '9';
    if ($o2->api_id > 0) {
        $o2 = $factory->get_object($o2->api_id, "api", "api_id");
    }
    if ($_SESSION['ipay_customer_id'] > 0) {
        $o4 = $factory->get_object($_SESSION['paytm_user_id'], "ipay_user", "ipay_user_id");
    }
    $o1->provider_id = '115';

    if ($dezire_amount <= 1000) {
        $ccf_amount = '10';
    } else {
        $ccf_amount = round((1 / 100) * $dezire_amount, 2);
        $ccf_amount = ceil($ccf_amount);
    }



    $amount_slab = ceil($dezire_amount / 5000);
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
            $rt_comm_dt = $res_comm[0]['rt_amount'];
        }
        $last_amount[0] = $comm_amount;
        $transfer_amount[0] = $dezire_amount;
        $tds_amount_wallet[0] = $tds_amount;
        $gst_amount_wallet[0] = $gst_amount;
        $rt_comm[0] = $res_comm[0]['rt_amount'];
    }

    $o1->amount = $dezire_amount + $comm_amount - $rt_comm_dt;
    if ($o1->amount <= $o->dmr_balance) {
        $total = $final_amount;
        $response = '      <div class="modal-content  modal_dezire">
        <div class="modal-body">
        <div class="row">
        <div class="col-md-6 text-left" >
        <div class="col-md-12 text-left dezire_padding_10 small" >Beneficiary Details</div>
        <div class="col-md-12 text-left dezire_modal_padding small" >' . $o3->beneficiaryName . '</div>
        <div class="col-md-12 text-left dezire_modal_padding small" >' . $o3->mobileNo . '</div>
        <div class="col-md-12 text-left dezire_modal_padding small" >' . $o3->bank_name . '</div>
        <div class="col-md-12 text-left dezire_modal_padding small" >' . $o3->accountNo . ' </div>
        <div class="col-md-12 text-left dezire_modal_padding small" >' . $o3->ifscType . ' : ' . $o3->ifscCode . '</div>
        </div>
        <div class="col-md-6 text-left" >
        <div class="col-md-12 text-left dezire_padding_10 small" >Transaction Details</div>
        <div class="col-md-12">
        <div class="row">
        <div class="col-md-6 text-left padding_10 small" >Amount</div>
        <div class="col-md-6 text-left padding_10 small" >' . $dezire_amount . '</div>
        </div>
        </div>
        <div class="col-md-12">
        <div class="row">
        <div class="col-md-6 text-left padding_10 small" >CCF</div>
        <div class="col-md-6 text-left padding_10 small" >' . $ccf_amount . '</div>
        </div>
        </div>
        <div class="col-md-12">
        <div class="row">
        <div class="col-md-6 text-left padding_10 small" >Pay by customer</div>
        <div class="col-md-6 text-left padding_10 small" >' . ($dezire_amount + $ccf_amount) . '</div>
        </div>
        </div>
        <div class="col-md-12">
        <div class="row">
        <div class="col-md-6 text-left padding_10 small" >Surcharge</div>
        <div class="col-md-6 text-left padding_10 small" >' . $comm_amount . '</div>
        </div>
        </div>
        <div class="col-md-12">
        <div class="row">
        <div class="col-md-6 text-left padding_10 small" >GST</div>
        <div class="col-md-6 text-left padding_10 small" >' . $gst_amount1 . '</div>
        </div>
        </div>
        <div class="col-md-12">
        <div class="row">
        <div class="col-md-6 text-left padding_10 small" >TDS</div>
        <div class="col-md-6 text-left padding_10 small" >' . $tds_amount1 . '</div>
        </div>
        </div>
        <div class="col-md-12">
        <div class="row">
        <div class="col-md-6 text-left padding_10 small" >Total</div>
        <div class="col-md-6 text-left padding_10 small" >' . ($total) . '</div>
        </div>
        </div>
        </div>

        </div>
        <div class="row">
        <div class="col-md-12 top_margin_10 text-center">
        <button name="ipay_send_money_button" id="ipay_send_money_button" type="button" onclick="ipay_money()"class="btn btn-success">Pay <i class="fa fa-rupee-sign"></i> ' . $total . '</span></button>
        <span id="btn-print_dmr"></span>

        <input type="button" name="close_now" id="close_now" class="btn btn-secondary" value="Close" onclick=\'$("#ipay_send_popup").modal("hide");\' />
        <input type="hidden" name="recharge_type" id="recharge_type" value="DMR" />
        <input type="hidden" name="recharge_txid" id="recharge_txid" value="0" />

        </div>
        </div>
        </div>
        </div>';
        $result['response'] = $response;
        $result['error'] = "0";
        $result['status'] = "Success";
        $result['error_msg'] = "data";
    } else {
        $result['error'] = "1";
        $result['error_msg'] = "Sorry, Your Wallet Balance is less than Required Amount";
    }
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>


