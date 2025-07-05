<form name="electricity" id="electricity" method="post" action="recharge_electricity.php" onsubmit="return false;">
    <div class="row">
        <!--        <div class="col-md-3 top_margin_10">
                    <label><i class="fa fa-map-marker"></i> Select State</label>
                    <select name="electricity_state" id="electricity_state" onchange="get_providers(this.value,'7')" class="form-control">
                        <option value="">Select State</option-->
        <!--?=get_circle_list("");?-->
        <!--/select>
    </div>-->
        <div class="col-md-3 top_margin_10" id="provs_onchanges" class="select2_single elec form-control"style="display:none;">
        </div>


        <div class="col-md-3 top_margin_10" id="provs">
            <label><i class="fa fa-globe"></i> Service Provider</label>
            <select name="electricity_provider" id="electricity_provider" class="form-control"  onchange="Elec_provider_info(this.value, 'Electricity')">
                <option value="">Select Service Provider</option>
                <?= get_provider_list_by_service("0", "6"); ?>
            </select>
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-address-card"></i> Account Number</label>
            <input type="text" name="electricity_account_number" id="electricity_account_number" class="form-control" placeholder="Account Number" />
        </div>
    
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> Customer Number</label>
            <input type="number" name="electricity_mobile" id="electricity_mobile" class="form-control" placeholder="Customer Number" />
        </div>
           <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
         
            <input type="button" name="fetch_button" id="fetch_button" onclick="fetch_bill()" class="btn btn-primary form-control btn-large" value="Fetch Bill" />
        </div>
          
        <div class="row col-md-12" id="other_rech_info" style="display: none">
              <div class="col-md-3 top_margin_10 ">
            <label><i class="fa fa-rupee-sign"></i>  Customer Name</label>
            <input type="text" readonly="" name="electricity_customer_name" id="electricity_customer_name" class="form-control"  step="0.01" value="0" placeholder="Customer Name" />
        </div>
              <div class="col-md-3 top_margin_10 ">
            <label><i class="fa fa-rupee-sign"></i> Recharge Amount</label>
            <input type="number" readonly="" name="electricity_amount" id="electricity_amount" class="form-control"  step="0.01" value="0" placeholder="Recharge Amount" />
        </div>
        <div class="col-md-3 top_margin_10" id="bill_unit" style="display: none;">
            <label><i class="fa fa-building"></i>Billing Unit</label>
            <input type="number" name="bill_unit" id="bill_unit" class="form-control"   placeholder="Billing Unit" />
        </div>
        <div class="col-md-3 top_margin_10" id="sub_div" style="display: none;">
            <label>Subdivcode</label>
            <input type="number" name="subdivision_code" id="subdivision_code" class="form-control"  placeholder="Subdivcode" />
        </div>
         <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="electricity_updte" id="electricity_updte" value="1" />
            <input type="submit" name="electricity_submit" id="electricity_submit" class="btn btn-primary form-control btn-large" value="Pay Bill " />
        </div>
        </div>
       
    </div>
    <hr />

</form>