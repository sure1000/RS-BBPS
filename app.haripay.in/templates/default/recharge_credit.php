<form name="credit" id="credit" method="post" action="recharge_credit.php" onsubmit="return false;">
    <div class="row">
        <!--div class="col-md-3 top_margin_10">
            <label><i class="fa fa-map-marker"></i> Select Bank</label>
            <select name="credit_bank" id="credit_bank" class="form-control">
                <option value="">Select Bank</option>
            </select>
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-address-card"></i> Account Number</label>
            <input type="text" name="credit_account_number" id="credit_account_number" class="form-control" required="required" placeholder="Account Number" />
        </div>
         <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> Customer Number</label>
            <input type="number" name="credit_mobile" id="credit_mobile" class="form-control" required="required"  placeholder="Customer Number" />
        </div>
       <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-rupee-sign"></i>  Amount</label>
            <input type="number" name="credit_amount" id="credit_amount" class="form-control" required="required" step="0.01" placeholder=" Amount" />
        </div>
          <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-rupee-sign"></i>  Payable Amount</label>
            <input type="number" name="payable_amount" id="payable_amount" class="form-control" required="required" step="0.01" placeholder="  Payable Amount" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="credit_updte" id="credit_updte" value="1" />
            <input type="submit" name="credit_submit" id="credit_submit" class="btn btn-primary form-control btn-large" value="Recharge Now" />
        </div-->
        <div class="col-md-12 text-danger">
            You are not authorized to Use this Service
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-10" id="credit_provider_info">
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
        <div class="col-md-2 text-right" id="credit_provider_logo">
            <img src="./provider_logos/thumbs/Airtel_Prepaid.png" alt="" class="img-rounded" />
        </div>
    </div>
</form>