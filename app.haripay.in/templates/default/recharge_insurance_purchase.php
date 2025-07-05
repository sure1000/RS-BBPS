<form name="purchase" id="purchase" method="post" action="recharge_purchase.php" onsubmit="return false;">
    <div class="row">
        <!--div class="col-md-3 top_margin_10">
            <label><i class="fa fa-map-marker"></i> Select State</label>
            <select name="purchase_state" id="purchase_state" class="form-control">
                <option value="">Select State</option>
                                  <?=get_circle_list("");?>

            </select>
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-address-card"></i> Account Number</label>
            <input type="text" name="purchase_account_number" id="purchase_account_number" class="form-control" required="required" placeholder="Account Number" />
        </div>

        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-globe"></i> Service Provider</label>
            <select name="purchase_circle" id="purchase_circle" class="form-control" required="required">
                <option value="">Select Service Provider</option>
                    <?=get_provider_list_by_service("0", "9");?>
            </select>
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-calendar"></i> DOB </label>
            <input type="date" name="purchase_dob" id="purchase_dob" class="form-control" required="required" placeholder="DOB" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-rupee-sign"></i>  Amount</label>
            <input type="number" name="purchase_amount" id="purchase_amount" class="form-control" required="required" step="0.01" placeholder=" Amount" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> Customer Number</label>
            <input type="number" name="purchase_mobile" id="purchase_mobile" class="form-control" required="required"  placeholder="Customer Number" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-calendar"></i> Last Date</label>
            <input type="date" name="purchase_last_date" id="purchase_last_date" class="form-control" required="required" placeholder="Last Date" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="purchase_updte" id="purchase_updte" value="1" />
            <input type="submit" name="purchase_submit" id="purchase_submit" class="btn btn-primary form-control btn-large" value="Recharge Now" />
        </div-->
        <div class="col-md-12 text-danger">
            You are not authorized to Use this Service
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-10" id="purchase_provider_info">
            <div class="row">
                <div class="col-lg-12">
                    No Plans Available
                </div>

            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-12">

            </div>
        </div>
        <div class="col-md-2 text-right" id="purchase_provider_logo">
            <img src="./provider_logos/thumbs/Airtel_Prepaid.png" alt="" class="img-rounded" />
        </div>
    </div>
</form>