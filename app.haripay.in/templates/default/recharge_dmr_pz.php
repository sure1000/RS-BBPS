
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="col-md-12 text-center border_box green_header" id="select_dmr_pay" >
            PZ DMR
        </div>

    </div>
    <div class="card-body">
        <div id="pz_div">
            <form name="pz_send_money" id="pz_send_money" method="post" action="pz_send_money.php" onsubmit="return false;" >
                <div class="row">
                    <div class="col-md-3 top_margin_10">
                        <label><i class="fa fa-address-book-o"></i> Beneficiary Name</label>
                        <input type="text" name="ben_name_pz" id="ben_name_pz" class="form-control" required="required"  placeholder="Beneficiary Name" />
                    </div>
                    <div class="col-md-3 top_margin_10">
                        <label><i class="fa fa-address-book-o"></i> Account</label>
                        <input type="number" name="pz_account" id="pz_account" class="form-control" required="required"  placeholder="Account" />
                    </div>
                    <div class="col-md-3 top_margin_10">
                        <label><i class="fa fa-address-book-o"></i> IFSC</label>
                        <input type="text" name="pz_ifsc" id="pz_ifsc" class="form-control" required="required"  placeholder="IFSC" />
                    </div>
               
                    <div class="col-md-3 top_margin_10">
                        <label><i class="fa fa-mobile"></i>Amount</label>
                        <input type="number" step="0.01"name="pz_amount" id="pz_amount" class="form-control" required="required"  placeholder="Amount" />
                    </div>
                    <div class="col-md-3 top_margin_10">
                        <label>&nbsp;</label>
                        <input type="hidden" name="pz_send_updte" id="pz_send_updte" value="1" />
<!--                        <button type="submit" name="pz_send_submit" id="pz_send_submit" class="btn btn-primary form-control btn-large" >Send </button>-->

                    </div>
                </div>
            </form>
        </div>


        <div id="dmr_pz_processing" style="display:none;" class="text-center top_margin_10">
            <?php include $path . "processing.php"; ?>
        </div>
    </div>
</div>