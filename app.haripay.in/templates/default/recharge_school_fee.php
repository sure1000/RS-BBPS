<form name="school_fee" id="school_fee" method="post" action="recharge_school_fee.php" onsubmit="return false;">
    <div class="row">
        <div class="col-md-3 top_margin_10">
            <div id="errormessge26" class="errormsg"></div>
            <label><i class="fa fa-map-marker"></i> Select State</label>
            <select name="school_fee_state" id="school_fee_state" class="form-control">
                <option value="">Select State</option>
                  <?=get_circle_list("");?>
            </select>
        </div>
        <div class="col-md-3 top_margin_10">
            <div id="errormessage27" class ="errormsg"></div>
            <label><i class="fa fa-address-card"></i> Account Number</label>
            <input type="text" name="school_fee_account_number" id="school_fee_account_number" class="form-control" placeholder="Account Number" />
        </div>

        <div class="col-md-3 top_margin_10">
            <div id="errormessge28" class="errormsg"></div>
            <label><i class="fa fa-globe"></i> Service Provider</label>
            <select name="school_fee_circle" id="school_fee_circle" class="form-control" onchange="provider_info(this.value,'school_fee');">
                <option value="">Select Service Provider</option>
                 <?=get_provider_list_by_service("0", "10");?>
            </select>
        </div>
        <div class="col-md-3 top_margin_10">
            <div id="errormessge29" class="errormsg"></div>
            <label><i class="fa fa-calendar"></i> DOB </label>
            <input type="date" name="school_fee_dob" id="school_fee_dob" class="form-control"  placeholder="DOB" />
        </div>
        <div class="col-md-3 top_margin_10">
            <div id="errormessge30" class="errormsg"></div>
            <label><i class="fa fa-rupee-sign"></i>  Amount</label>
            <input type="number" name="school_fee_amount" id="school_fee_amount" class="form-control" step="0.01" placeholder=" Amount" />
        </div>
        <div class="col-md-3 top_margin_10">
            <div id="errormessge31" class="errormsg"></div>
            <label><i class="fa fa-rupee-sign"></i>  Payable Amount</label>
            <input type="number" name="school_fee_pay_amount" id="school_fee_pay_amount" class="form-control" step="0.01" placeholder="  Payable Amount" />
        </div>
        <div class="col-md-3 top_margin_10">
            <div id="errormessge32" class="errormsg"></div>
            <label><i class="fa fa-mobile"></i> Customer Number</label>
            <input type="number" name="school_fee_mobile" id="school_fee_mobile" class="form-control" placeholder="Customer Number" />
        </div>
        <div class="col-md-3 top_margin_10">
            <div id="errormessge33" class="errormsg"></div>
            <label><i class="fa fa-calendar"></i> Last Date</label>
            <input type="date" name="school_fee_last_date" id="school_fee_last_date" class="form-control" placeholder="Last Date" />
        </div>
        <div class="col-md-3 top_margin_10 ">
            <label>&nbsp;</label>
            <input type="hidden" name="school_fee_updte" id="school_fee_updte" value="1" />
            <input type="submit" name="school_fee_submit" id="school_fee_submit" class="btn btn-primary form-control btn-large" value="Recharge Now" />
        </div>
        <div class="col-md-12 text-danger">
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-10" id="school_fee_provider_info">
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
        <div class="col-md-2 text-right" id="school_fee_provider_logo">
            
        </div>
    </div>
</form>