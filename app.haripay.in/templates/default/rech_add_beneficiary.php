<form name="rech_add_recipient" id="rech_add_recipient" method="post" action="recharge_imps.php" onsubmit="return false;">
    <div class="row">
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> Name</label>
            <input type="text" name="rech_recipient_name" id="rech_recipient_name" class="form-control" required="required"  placeholder="Name" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> Mobile No</label>
            <input type="number" name="rech_receipient_mobile" id="rech_receipient_mobile" class="form-control" required="required"  placeholder="Mobile No" />
        </div>
        <!-- <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> Address</label>
            <input type="text" name="beneficiaryAddress" id="beneficiaryAddress" class="form-control" required="required"  placeholder="Address" />
        </div> -->
       <!--  <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-address-book-o"></i> Account Type</label>
            <select name="accountType" id="accountType" class="form-control" required  >
                <option value="0">Select Account Type</option>
                <option value="Saving">Saving</option>
                <option value="Current">Current</option>
            </select>
        </div> -->
        <!-- <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-address-book-o"></i> Ifsc Type</label>
            <select name="ifscType" id="ifscType" class="form-control" required  >
                <option value="0">Select IFSC Type</option>
                <option value="IFSC">IFSC</option>
                <option value="MMID">MMID</option>
                <option value="IFSC MMID">IFSC MMID</option>
            </select>
        </div> -->
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-globe"></i> Bank Name</label>
            
            <input type="text" name="bank_rech" id="bank_rech" class="form-control" required="required" placeholder="Bank Name" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-map-marker"></i> Ifsc Code</label>
            <input type="text" name="rech_ifsc" id="rech_ifsc" class="form-control" required="required" placeholder="Ifsc Code" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-map-marker"></i> Account No</label>
            <input type="text" name="rech_account" id="rech_account" class="form-control" required="required" placeholder="Account No" />
        </div>
        <!-- <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-map-marker"></i> MMID</label>
            <input type="text" name="MMID" id="MMID" class="form-control"  placeholder="MMID" />
        </div> -->
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="updte" id="updte" value="1" />
           <!--  <input type="submit" name="imps_submit" id="imps_submit" class="btn btn-primary form-control btn-large" value="Register" /> -->
            <button type="submit" class="btn btn-primary form-control btn-large">Send</button>
           
        </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="button" name="rech_get_name" id="rech_get_name" class="btn btn-primary form-control btn-large" value="Beneficiary Validation" />
        </div>
  </div>
</form>

<form id="rech_ben_verify_form" class="custom-form-style"  method="POST" onsubmit="return false;" style="display: none;">
    <div class="row">
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i>OTP</label>
            <input type="text" name="rech_otp" id="rech_otp" class="form-control" required="required"  placeholder="OTP" />
        </div>
         <div class="col-md-2 top_margin_10">
            <button type="submit" class="btn btn-primary form-control btn-large">Verify</button>
                                            
                        <input type="hidden" name="updte" id="updte" value="1" />
                        <input type="hidden" name="rech_benificiary_id_otp" id="rech_benificiary_id_otp" value="0" />
           
        </div>
    </div>
</form>