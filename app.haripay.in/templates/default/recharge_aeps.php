<form name="aeps" id="aeps" method="post"  onsubmit="return false;">
    <div class="row">
<div class="col-md-3 top_margin_10">
            <label><i class="fa fa-user"></i> Name</label>
            <input type="text" name="rech_name" id="rech_name" class="form-control" required="required"  placeholder="Name" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> Mobile Number</label>
            <input type="number" name="rech_mobile" id="rech_mobile" class="form-control" required="required"  placeholder="Mobile Number" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa fa-map-marker "></i> Pin</label>
            <input type="text" name="rech_pincode" id="rech_pincode" class="form-control" required="required"  placeholder="Pin" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="aeps_updte" id="aeps_updte" value="1" />
            <input type="submit" name="aeps_submit" id="aeps_submit" class="btn btn-primary form-control btn-large" value="Submit" />
        </div>
        <!--div class="col-md-12 text-danger">
            You are not authorized to Use this Service
        </div-->
    </div>
    <hr />
    <div class="row">
        <div class="col-md-10" id="aeps_provider_info">
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
        <div class="col-md-2 text-right" id="aeps_provider_logo">
            <!--img src="./provider_logos/thumbs/Airtel_Prepaid.png" alt="" class="img-rounded" /-->
        </div>
    </div>
</form>
<form name="customer_verify" id="customer_verify" method="post"  onsubmit="return false;" style="display: none;">
    <div class="row">
<!-- <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-user"></i> Name</label>
            <input type="text" name="rech_name" id="rech_name" class="form-control" required="required"  placeholder="Name" />
        </div> -->
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> Mobile Number</label>
            <input type="number" name="rech_mobile_verify" id="rech_mobile_verify" class="form-control" required="required"  placeholder="Mobile Number" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa fa-map-marker "></i> OTP</label>
            <input type="text" name="otp" id="otp" class="form-control" required="required"  placeholder="OTP" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="verify_updte" id="verify_updte" value="1" />
            <input type="submit" name="Verify_customer" id="Verify_customer" class="btn btn-primary form-control btn-large" value="Submit" />
        </div>
        <!--div class="col-md-12 text-danger">
            You are not authorized to Use this Service
        </div-->
    </div>
    <hr />
    <div class="row">
        <div class="col-md-10" >
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
       
    </div>
</form>