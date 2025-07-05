<form name="ipay_login" id="ipay_login" method="post" action="recharge_imps.php" onsubmit="return false;">
    <div class="row">
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> Mobile Number</label>
            <input type="number" name="ipay_mobile" id="ipay_mobile" min="6000000000" max="9999999999" class="form-control" required="required"  placeholder="Mobile Number" />
        </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="ipay_login_updte" id="ipay_login_updte" value="1" />
            <button type="submit" name="ipay_submit" id="ipay_submit" class="btn btn-primary form-control btn-large" >Continue </button>
        </div>

    </div>
</form>
<form name="ipay_pin" id="ipay_pin" method="post"  onsubmit="return false;" style="display : none">
    <div class="row">
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> PIN</label>
            <input type="number" name="ipay_pin" id="ipay_pin" class="form-control" required="required"  placeholder="Enter Pin" />
        </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="ipay_pin_updte" id="ipay_pin_updte" value="1" />
            <input type="hidden" name="ipay_user_id" id="ipay_user_id" value="0">
            <button type="submit" name="ipay_pin_submit" id="ipay_pin_submit" class="btn btn-primary form-control btn-large" />Save </button>
        </div>
 </div>
</form>
<form name="ipay_register" id="ipay_register" method="post" onsubmit="return false;" style="display : none">
    <div class="row">
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i>Mobile </label>
            <input type="number" name="ipay_mobileNo" id="ipay_mobileNo" readonly=""  class="form-control" required="required"  placeholder="Mobile Number" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-user"></i>  First Name</label>
            <input type="text" name="ipay_first_Name" id="ipay_first_Name" class="form-control" required="required"  placeholder="First Name" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-user"></i> Last Name</label>
            <input type="text" name="ipay_last_Name" id="ipay_last_Name" class="form-control" required="required"  placeholder="Last Name" />
        </div>
        <div class="col-md-3 top_margin_10" >
            <label><i class="fa fa-map-marker"></i> Pincode</label>
            <input type="number" name="ipay_pincode" id="ipay_pincode" class="form-control" placeholder="Pincode" />
        </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="ipay_join_updte" id="ipay_join_updte" value="1" />
            <input type="hidden" name="ipay_mobile_reg" id="ipay_mobile_reg" value="0" />
            <button type="submit" name="ipay_reg_submit" id="ipay_reg_submit" class="btn btn-primary form-control btn-large" >Register </button>
        </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="button" name="ipay_back_btn" id="ipay_back_btn" class="btn btn-primary form-control btn-large"  value="Back" />
        </div>
    </div>
</form> 