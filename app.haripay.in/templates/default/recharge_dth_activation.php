<form name="dth_activation" id="dth_activation" method="post" action="recharge_dth_activation.php" onsubmit="return false;">
    <div class="row">
        <div class="col-md-3 top_margin_10">
		<div id="errormessge5" class="errormsg"></div>
            <label><i class="fa fa-rss"></i> Service Provider</label>
            <select name="dth_activation_provider" id="dth_activation_provider" class="form-control" onchange="provider_info(this.value,'dth_activation')" >
                <option value="">Select Provider</option>
				<?=get_provider_list_by_service("0", "4");?>
            </select>
        </div>
        <div class="col-md-3 top_margin_10">
		<div id="errormessge6" class="errormsg"></div>
            <label><i class="fa fa-barcode"></i> Select Box Type</label>
            <select name="dth_activation_box_type" id="dth_activation_box_type" class="form-control" >
                <option value="">Select Box Type</option>
				<option value="HD" >HD</option>
				<option value="SD" >SD</option>
				
            </select>
        </div>
        <div class="col-md-3 top_margin_10">
		<div id="errormessge7" class="errormsg"></div>
            <label><i class="fa fa-bars"></i>Months</label>
			<select name="dth_activation_month" id="dth_activation_month" class="form-control" onchange="dth_activation_monthsplan(this.value)">
			<option value="" >Select month</option>
			<option value="1 month" >1 month Packs</option>
			<option value="3 month">3 month Packs</option>
			<option value="4 month">4 month Packs</option>
			<option value="6 month">6 month Packs</option>
			<option value="12 month">Annual Packs</option>
            </select> 
        </div>
        <div class="col-md-3 top_margin_10">
		<div id="errormessge8" class="errormsg"></div>
            <label><i class="fa fa-rupee-sign"></i> Recharge Amount</label>
            <input type="number" name="dth_activation_amount" id="dth_activation_amount" class="form-control"  step="0.01" placeholder="Recharge Amount" />
        </div>
        <div class="col-md-3 top_margin_10">
		<div id="errormessge9" class="errormsg"></div>
            <label><i class="fa fa-user"></i> User name</label>
            <input type="text" name="dth_activation_user_name" id="dth_activation_user_name" class="form-control"  placeholder="User name" />
        </div>
        <div class="col-md-3 top_margin_10">
		<div id="errormessge10" class="errormsg"></div>
            <label><i class="fa fa-address-book-o"></i> Address</label>
            <input type="text" name="dth_activation_address" id="dth_activation_address" class="form-control"  placeholder="Address of Installation" />
        </div>
        <div class="col-md-3 top_margin_10">
		<div id="errormessge11" class="errormsg"></div>
            <label><i class="fa fa-building"></i> Near By Locality</label>
            <input type="text" name="dth_activation_locality" id="dth_activation_locality" class="form-control"  placeholder="Near By Locality" />
        </div>
        <div class="col-md-3 top_margin_10">
		<div id="errormessge12" class="errormsg"></div>
            <label><i class="fa fa-mobile"></i> Mobile Number</label>
            <input type="text" name="dth_activation_mobile" id="dth_activation_mobile" class="form-control"  placeholder="Mobile Number of User" />
        </div>
        <div class="col-md-3 top_margin_10">
		<div id="errormessge13" class="errormsg"></div>
            <label><i class="fa fa-map-marker"></i> Pin Code</label>
            <input type="text" name="dth_activation_pin_code" id="dth_activation_pin_code" class="form-control" placeholder="Pin Code" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="dth_activation_updte" id="dth_activation_updte" value="1" />
            <input type="submit" name="dth_activation_submit" id="dth_activation_submit" class="btn btn-primary form-control btn-large" value="Recharge Now" />
        </div>
        <!--div class="col-md-12 text-danger">
            You are not authorized to Use this Service
        </div-->
    </div>
    <hr />
    <div class="row">
        <div class="col-md-10" id="dth_activation_provider_info">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs">
                        <ul class="nav nav-tabs">
                            <li class="nav-item active">
                                <a class="nav-link active" href="#dth_activation_plans" data-toggle="tab">Offers</a>
                            </li>
                        </ul>
                        <div class="tab-content top_margin_10">
                            <div id="dth_activation_monthly" class="tab-pane active" style="padding-left:10px;">
                                Please Enter DTH Provider
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-12">

            </div>
        </div>
		<div class="col-md-10" id="show_data" > 
		</div>
		<div id="roffer_processing"  style="display:none;" class="text-center top_margin_10">
                                <?php include $path . "processing.php";?>
                            </div>
        <div class="col-md-2 text-right" id="dth_activation_provider_logo">
            <!--img src="./provider_logos/thumbs/Airtel_Prepaid.png" alt="" class="img-rounded" /-->
        </div>
    </div>
</form>