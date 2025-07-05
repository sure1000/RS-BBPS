<form name="gas" id="gas" method="post" action="recharge_gas.php" onsubmit="return false;">
    <div class="row">
        <div class="col-md-3 top_margin_10">
		<div id="errormessge20" class="errormsg"></div>
            <label><i class="fa fa-map-marker"></i> Select State</label>
            <select name="gas_state" id="gas_state" class="form-control">
                <option value="">Select State</option>
                  <?=get_circle_list("");?>
            </select>
        </div>
        <div class="col-md-3 top_margin_10">
		<div id="errormessge21" class="errormsg"></div>
            <label><i class="fa fa-address-card"></i> Account Number</label>
            <input type="text" name="gas_account_number" id="gas_account_number" class="form-control"  placeholder="Account Number" />
        </div>

        <div class="col-md-3 top_margin_10">
		<div id="errormessge22" class="errormsg"></div>
            <label><i class="fa fa-globe"></i> Service Provider</label>
            <select name="gas_circle" id="gas_circle" class="form-control" onchange="provider_info(this.value,'gas')">
                <option value="">Select Service Provider</option>
                  <?=get_provider_list_by_service("0", "8");?>
            </select>
        </div>
        <div class="col-md-3 top_margin_10">
		<div id="errormessge23" class="errormsg"></div>
            <label><i class="fa fa-rupee-sign"></i> Recharge Amount</label>
            <input type="number" name="gas_amount" id="gas_amount" class="form-control" step="0.01" placeholder="Recharge Amount" />
        </div>
        <div class="col-md-3 top_margin_10">
		<div id="errormessge24" class="errormsg"></div>
            <label><i class="fa fa-mobile"></i> Customer Number</label>
            <input type="number" name="gas_mobile" id="gas_mobile" class="form-control"  placeholder="Customer Number" />
        </div>
        <div class="col-md-3 top_margin_10">
		<div id="errormessge25" class="errormsg"></div>
            <label><i class="fa fa-calendar"></i> Last Date</label>
            <input type="date" name="gas_last_date" id="gas_last_date" class="form-control" placeholder="Last Date" />
        </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="gas_updte" id="gas_updte" value="1" />
            <input type="submit" name="gas_submit" id="gas_submit" class="btn btn-primary form-control btn-large" value="Recharge Now" />
        </div>
        <!--div class="col-md-12 text-danger">
            You are not authorized to Use this Service
        </div-->
    </div>
    <hr />
    <div class="row">
        <div class="col-md-10" id="gas_provider_info">
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
        <div class="col-md-2 text-right" id="gas_provider_logo">
            <!--img src="./provider_logos/thumbs/Airtel_Prepaid.png" alt="" class="img-rounded" /-->
        </div>
    </div>
</form>