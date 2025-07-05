<?php

session_start();
include "include.php";
include "session.php";

if ($_POST['imps_send_updte'] == '1') {
    $beneficiary_id = $_POST['beneficiary_id'];
    $dezire_amount = $_POST['dezire_amount'];
    $transactiontype = $_POST['transactiontype'];

    if ($beneficiary_id > 0) {
        $o3 = $factory->get_object($beneficiary_id, "dezire_beneficiary", "dezire_beneficiary_id");
    }
    $o2->api_id = '16';
    if ($o2->api_id > 0) {
        $o2 = $factory->get_object($o2->api_id, "api", "api_id");
    }
    if ($_SESSION['dezire_user_id'] > 0) {
        $o4 = $factory->get_object($_SESSION['dezire_user_id'], "dezire_user", "dezire_user_id");
    }
    $o1->provider_id = '84';
    if($dezire_amount <= 1000){
    $ccf_amount = '10';
    }else{
        $ccf_amount = round((1 / 100) * $dezire_amount, 2); 
        $ccf_amount = ceil($ccf_amount);
    }

    $sql_comm = "Select * from user_plan_service where user_plan_id = " . $o->plan_id . " and provider_id = " . $o1->provider_id . " and is_active = 1";
    $res_comm = getXbyY($sql_comm);
    $row_comm = count($res_comm);

    if ($row_comm > 0) {
        if ($res_comm[0]['commission_percentage'] > 0) {
            $comm_amount = round(($res_comm[0]['commission_percentage'] / 100) * $dezire_amount, 2);
        } else {
            $comm_amount = $res[0]['commission_amount'];
        }
    } else {
        $comm_amount = 0;
    }
    $gst_amount = round($comm_amount * 18 / 100, 2);
    $o1->amount = $dezire_amount + $comm_amount;
    if ($o1->amount <= $o->amount_balance) {
        $total = $dezire_amount + $comm_amount + $gst_amount;
        $response = '      <div class="modal-content  modal_dezire">
       <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 text-left" >
                        <div class="col-md-12 text-left dezire_padding_10 small" >Beneficiary Details</div>
                        <div class="col-md-12 text-left dezire_modal_padding small" >' . $o3->beneficiaryName . '</div>
                        <div class="col-md-12 text-left dezire_modal_padding small" >' . $o3->mobileNo . '</div>
                        <div class="col-md-12 text-left dezire_modal_padding small" >' . $o3->beneficiaryAddress . '</div>
                        <div class="col-md-12 text-left dezire_modal_padding small" >' . $o3->bank_name . '</div>
                        <div class="col-md-12 text-left dezire_modal_padding small" >' . $o3->accountNo . ' </div>
                        <div class="col-md-12 text-left dezire_modal_padding small" >' . $o3->accountType . '</div>
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
                                <div class="col-md-6 text-left padding_10 small" >' .($dezire_amount +  $ccf_amount) . '</div>
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
                                <div class="col-md-6 text-left padding_10 small" >' . $gst_amount . '</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 text-left padding_10 small" >TDS</div>
                                <div class="col-md-6 text-left padding_10 small" >0</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 text-left padding_10 small" >Total</div>
                                <div class="col-md-6 text-left padding_10 small" >' . ($total) . '</div>
                            </div>
                        </div>
                  </div>
                  <span id="dezire_send_response"></span>
                </div>
                <div class="row">
                    <div class="col-md-12 top_margin_10 text-center">
                        <button name="dezire_send_money_button" id="dezire_send_money_button" type="button" onclick="dezire_money()"class="btn btn-success">Pay <i class="fa fa-rupee-sign"></i> '.$total.'</span></button>
                        <button name="dezire_send_money_print" id="dezire_send_money_print" class="btn btn-warning " style="display : none">Print </button>
                        <input type="button" name="close_now" id="close_now" class="btn btn-secondary" value="Close" onclick=\'$("#dezire_send_popup").modal("hide");\' />
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
    }else{
          $result['error'] = "1";
    $result['error_msg'] = "Sorry, Your Wallet Balance is less than Required Amount";
    }


  
} else {
    $result['error'] = "1";
    $result['error_msg'] = "Something went wrong please try again";
}

echo json_encode($result);
?>


