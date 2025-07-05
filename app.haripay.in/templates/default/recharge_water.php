<form name="water" id="water" method="post" action="recharge_water.php" onsubmit="return false;">
    <div class="row">
        <div class="col-md-3 top_margin_10">
            <div id="errormessge14" class="errormsg"></div>
            <label><i class="fa fa-map-marker"></i> Select State</label>
            <select name="water_state" id="water_state" class="form-control">
                <option value="">Select State</option>
                  <?=get_circle_list("");?>
            </select>
        </div>
        <div class="col-md-3 top_margin_10">
            <div id="errormessge15" class="errormsg"></div>
            <label><i class="fa  fa-address-card"></i> Account Number</label>
            <input type="text" name="water_account_number" id="water_account_number" class="form-control" placeholder="Account Number" />
        </div>

        <div class="col-md-3 top_margin_10">
            <div id="errormessge16" class="errormsg"></div>
            <label><i class="fa fa-globe"></i> Service Provider</label>
            <select name="water_provider" id="water_provider" class="form-control" onchange="provider_info(this.value,'water');">
                <option value="">Select Service Provider</option>
                    <?=get_provider_list_by_service("0", "7");?>
            </select>
        </div>
        <div class="col-md-3 top_margin_10">
            <div id="errormessge17" class="errormsg"></div>
            <label><i class="fa fa-rupee-sign"></i> Recharge Amount</label>
            <input type="number" name="water_amount" id="water_amount" class="form-control" step="0.01" placeholder="Recharge Amount" />
        </div>
        <div class="col-md-3 top_margin_10">
            <div id="errormessge18" class="errormsg"></div>
            <label><i class="fa fa-mobile"></i> Customer Number</label>
            <input type="number" name="water_mobile" id="water_mobile" class="form-control"  placeholder="Customer Number" />
        </div>
        <div class="col-md-3 top_margin_10">
            <div id="errormessge19" class="errormsg"></div>
            <label><i class="fa fa-calendar"></i> Last Date</label>
            <input type="date" name="water_last_date" id="water_last_date" class="form-control" placeholder="Last Date" />
        </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="water_updte" id="water_updte" value="1" />
            <input type="submit" name="water_submit" id="water_submit" class="btn btn-primary form-control btn-large" value="Recharge Now" />
        </div>
       <!--  <div class="col-md-12 text-danger">
            You are not authorized to Use this Service
        </div> -->
    </div>
    <hr />
    <div class="row">
        <div class="col-md-10" id="water_provider_info">
            <div class="row">
                <div class="col-lg-12">
                    No Plans Available
                </div>

            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-12">

            </div>
            <div id="roffer_processing"  style="display:none;" class="text-center top_margin_10">
                <?php include $path . "processing.php";?>
            </div>
        
        </div>
        <div class="col-md-2 text-right" id="water_provider_logo">
            
        </div>
    </div>
</form>