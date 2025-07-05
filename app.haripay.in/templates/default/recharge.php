
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row" id="service_mobile" style="display: none;">
        <div class="col-md-12">
            <?php include $path . "recharge_mobile.php";?>
        </div>
    </div>
    <div class="row" id="service_dth" style="display: none;">
        <div class="col-md-12">
            <?php include $path . "recharge_dth.php";?>
        </div>
    </div>
    <div class="row" id="service_utilities" style="display: none;">
        <div class="col-md-12">
            <?php include $path . "recharge_utilities.php";?>
        </div>
    </div>
    <div class="row" id="service_dmr" style="display: none;">
        <div class="col-md-12">
            <?php include $path . "recharge_dmr.php";?>
        </div>
    </div>
    <div class="row" id="service_dmr_pay" style="display: none;">
        <div class="col-md-12">
            <?php include $path . "recharge_dmr_pay.php";?>
        </div>
    </div>
    <div class="row" id="service_dmr_pz" style="display: none;">
        <div class="col-md-12">
            <?php include $path . "recharge_dmr_pz.php";?>
        </div>
    </div>
    <div class="row" id="service_insurance" style="display: none;">
        <div class="col-md-12">
            <?php include $path . "recharge_insurance.php";?>
        </div>
    </div>
    <div class="row" id="service_school" style="display: none;">
        <div class="col-md-12">
            <?php include $path . "recharge_school.php";?>
        </div>
    </div>
    <div class="row" id="service_bus" style="display: none;">
        <div class="col-md-12">
            <?php include $path . "recharge_bus.php";?>
        </div>
    </div>
    <div class="row" id="service_creditcard" style="display: none;">
        <div class="col-md-12">
            <?php include $path . "recharge_creditcard.php";?>
        </div>
    </div>
    <div class="row" id="service_hotel" style="display: none;">
        <div class="col-md-12">
            <?php include $path . "recharge_hotel.php";?>
        </div>
    </div>
    <div class="row" id="service_flight" style="display: none;">
        <div class="col-md-12">
            <?php include $path . "recharge_flight.php";?>
        </div>
    </div>
    <div class="row" >
        <div class="col-md-12">
            <?php include $path . "recharge_transactions.php";?>
        </div>
    </div>

    <!-- Content Row -->
    <input type="hidden" name="commission_amount" id="commission_amount" value="0" />
    <input type="hidden" name="commission_percentage" id="commission_percentage" value="0" />
    <input type="hidden" name="tds" id="tds" value="<?=$o->tds;?>" />
    <input type="hidden" name="gst" id="gst" value="<?=$o->gst;?>" />
</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->

<div class="modal fade" id="recharge_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal_design" role="document">
        <div class="modal-content  modal_design">

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-left" id="recharge_logo"></div>
                    <div class="col-md-6 text-left padding_10 small" >Number</div>
                    <div class="col-md-6 text-left padding_10 small" id="number_data"></div>
                    <div class="col-md-6 text-left padding_10 small">Amount</div>
                    <div class="col-md-6 text-left padding_10 small" id="amount_data"></div>
                    <!--div class="col-md-6 text-left padding_10 small">GST</div>
                    <div class="col-md-6 text-left padding_10 small" id="gst_data"></div-->
                    <div class="col-md-6 text-left padding_10 small">Commission</div>
                    <div class="col-md-6 text-left padding_10 small" id="commission_data"></div>
                    <!--div class="col-md-6 text-left padding_10 small">TDS</div>
                    <div class="col-md-6 text-left padding_10 small" id="tds_data"></div-->
                    <div class="col-md-6 text-left padding_10 small black_color">Your Profit</div>
                    <div class="col-md-6 text-left padding_10 small black_color" id="net_profit"></div>
                    <div class="col-md-6 text-left padding_10"><b>Your Cost</b></div>
                    <div class="col-md-6 text-left padding_10" id="total_payable"></div>

                </div>
                <div class="row">
                    <div class="col-md-12 top_margin_10 text-center">
                        <button name="recharge_now" id="recharge_now" class="btn btn-success" onclick="recharge_now($('#recharge_type').val());">Pay <i class="fa fa-rupee-sign"></i> <span id="recharge_now_amount"></span></button>
                        <input type="button" name="close_now" id="close_now" class="btn btn-secondary" value="Close" onclick="$('#recharge_data').modal('hide');" />
                        <input type="hidden" name="recharge_type" id="recharge_type" value="prepaid" />

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="get_dth_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal_design" role="document">
        <div class="modal-content  modal_design">

            <div class="modal-body">
                <div class="row">
                  
                    <div class="col-md-5 text-left padding_10 small" >VC</div>
                    <div class="col-md-7 text-left padding_10 small" id="show_dth_VC"></div>
                    <div class="col-md-5 text-left padding_10 small" >Name</div>
                    <div class="col-md-7 text-left padding_10 small" id="show_dth_Name"></div>
                    <div class="col-md-5 text-left padding_10 small" >Mobile</div>
                    <div class="col-md-7 text-left padding_10 small" id="show_dth_Rmn"></div>
                    <div class="col-md-5 text-left padding_10 small" >Balance</div>
                    <div class="col-md-7 text-left padding_10 small" id="show_dth_Balance"></div>
                    <div class="col-md-5 text-left padding_10 small" >Monthly</div>
                    <div class="col-md-7 text-left padding_10 small" id="show_dth_Monthly"></div>
                    <div class="col-md-5 text-left padding_10 small" >Next Recharge</div>
                    <div class="col-md-7 text-left padding_10 small" id="show_dth_Next_recharge"></div>
                    <div class="col-md-5 text-left padding_10 small" >Address</div>
                    <div class="col-md-7 text-left padding_10 small" id="show_dth_Address"></div>
                    <div class="col-md-5 text-left padding_10 small" >City</div>
                    <div class="col-md-7 text-left padding_10 small" > 
                        <span id="show_dth_City"></span>
                        <span id="show_dth_State"></span>
                        <span id="show_dth_District"></span>
                        <span id="show_dth_Pin"></span>
                    </div>
                  
                    
                    <div class="col-md-5 text-left padding_10 small" >Plan</div>
                    <div class="col-md-7 text-left padding_10 small" id="show_dth_Plan"></div>
                  

                </div>
                <div class="row">
                    <div class="col-md-12 top_margin_10 text-center">
                        <input type="button" name="close_now" id="close_now" class="btn btn-secondary" value="Close" onclick="$('#get_dth_data').modal('hide');" />
                      

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="recharge_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" id="recharge_status_response">
 </div>
</div>
<div class="modal fade" id="dezire_send_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="    max-width: 45%;"  id="dezire_send_popup_id">

    </div>
</div>