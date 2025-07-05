<form name="landline" id="landline" method="post" action="recharge_landline.php" onsubmit="return false;">
    <div class="row">
	
        <div class="col-md-2 top_margin_10">
		<div id="errormessge1" class="errormsg"></div>
            <label><i class="fa fa-mobile"></i> Landline Number</label>
            <input type="number" name="landline_number" id="landline_number" class="form-control" placeholder="Landline Number like (0172****)" value="" />
        </div>
        <div class="col-md-2 top_margin_10">
		<div id="errormessge2" class="errormsg"></div>
            <label><i class="fa fa-rss"></i> Service Provider</label>
            <select name="landline_provider" id="landline_provider" class="form-control"  onchange="provider_info(this.value,'landline')" >
                <option value="">Select Provider</option>
				<?=get_provider_list_by_service("0", "12");?>
            </select>
        </div>
        <div class="col-md-2 top_margin_10">
		<div id="errormessge3" class="errormsg"></div>
            <label><i class="fa fa-user"></i> Account Number</label>
			<input type="hidden" name="updte" class="form-control" placeholder="Account Number" value="" required/>
            <input type="number" name="landline_account_number" id="landline_account_number" class="form-control" placeholder="Account Number" value="">
			
        </div>
        <div class="col-md-2 top_margin_10">
		<div id="errormessge4" class="errormsg"></div>
            <label><i class="fa fa-globe"></i> Service Circle</label>
            <select name="landline_circle" id="landline_circle" class="form-control" >
                <option value="">Select Service Circle</option>
				<?=get_circle_list("");?>
            </select>
        </div>
        <div class="col-md-2 top_margin_10">
		<div id="errormessge5" class="errormsg"></div>
            <label><i class="fa fa-rupee-sign"></i> Recharge Amount</label>
            <input type="number" name="landline_amount" id="landline_amount" class="form-control"  step="0.01" placeholder="Recharge Amount" />
        </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="landline_updte" id="landline_updte" value="1" />
            <input type="submit" name="landline_submit" id="landline_submit" class="btn btn-primary form-control btn-large" value="Recharge Now" />
        </div>
		
		
		
        <!--<div class="col-md-12 text-danger">
            You are not authorized to Use this Service
        </div>-->
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12" id="landline_provider_info">
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
		<div id="roffer_processing"  style="display:none;" class="text-center top_margin_10">
                                <?php include $path . "processing.php";?>
                            </div>
		
        <div class="col-md-2 text-right" id="landline_provider_logo">
          
        </div>
    </div>
</form>
