<div class="container-fluid">
<form id="ipay_oulet_otp" class="custom-form-style"  method="POST" onsubmit="return false;" >
    <div class="row">
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i>Mobile</label>
            <input type="text" name="ipay_mobile" id="ipay_mobile" class="form-control" required="required"  placeholder="Mobile Number" />
        </div>
         <div class="col-md-2 top_margin_10" style="margin-top: 42px;">
            <button type="submit" class="btn btn-primary form-control btn-large">Send Otp</button>
                                            
                        <input type="hidden" name="updte" id="updte" value="1" />
                       
           
        </div>
    </div>
</form>
<form id="ipay_oulet_registration" class="custom-form-style"  method="POST" onsubmit="return false;" style="display: none;" >
    <div class="row">
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i>Name</label>
            <input type="text" name="ipay_name_reg" id="ipay_name_reg" class="form-control" required="required"  placeholder="Name" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i>Mobile</label>
            <input type="text" name="ipay_mobile_reg" id="ipay_mobile_reg" class="form-control" required="required"  placeholder="Mobile Number" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i>Email</label>
            <input type="text" name="ipay_email_reg" id="ipay_email_reg" class="form-control" required="required"  placeholder="Email" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i>Company</label>
            <input type="text" name="ipay_company_reg" id="ipay_company_reg" class="form-control" required="required"  placeholder="Company" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i>PAN Number</label>
            <input type="text" name="ipay_pan_reg" id="ipay_pan_reg" class="form-control" required="required"  placeholder="PAN Number" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i>Pincode</label>
            <input type="text" name="ipay_pincode_reg" id="ipay_pincode_reg" class="form-control" required="required"  placeholder="Pincode" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i>Addess</label>
            <input type="text" name="ipay_address_reg" id="ipay_address_reg" class="form-control" required="required"  placeholder="Addess" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i>Otp</label>
            <input type="text" name="ipay_otp_reg" id="ipay_otp_reg" class="form-control" required="required"  placeholder="OTP" />
        </div>
        

         <div class="col-md-2 top_margin_10" style="margin-top: 42px;">
            <button type="submit" class="btn btn-primary form-control btn-large">Register</button>
                                            
                        <input type="hidden" name="updte" id="updte" value="1" />
                       
           
        </div>
    </div>
</form>
</div>