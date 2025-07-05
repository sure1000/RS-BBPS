<div class="row">  
    <div class="col-md-12 top_margin_10">
        <label><i class="fa fa-address-book-o"></i>Action </label>
        <select name="action_mode" id="action_mode" class="form-control" required  onclick="ipay_service(this.value)"  >
            <option value="ADD BENEFICIARY">ADD BENEFICIARY</option>
            <option value="FUND TRANSFER">FUND TRANSFER</option>
        </select>
    </div>
</div>
<form name="ipay_add_beneficiary" id="ipay_add_beneficiary" method="post" action="recharge_imps.php" onsubmit="return false;">
    <div class="row">
        <div class="col-md-12 top_margin_10">
            <label><i class="fa fa-globe"></i> Bank Name</label>
            <select name="bank_ID_pay" id="bank_ID_pay" class="form-control" onchange="change_bank(this.value)">
                <option value="0">Select Bank</option>
                <?= ipay_bank_list(0); ?>
            </select>
        </div>
        <div class="col-md-6 top_margin_10">
            <label><i class="fa fa-map-marker"></i> Account No</label>
            <input type="text" name="accountNo_pay" id="accountNo_pay" class="form-control" required="required" placeholder="Account No" />
        </div>

        <div class="col-md-6 top_margin_10">
            <label><i class="fa fa-map-marker"></i> Ifsc Code</label>
            <input type="text" name="ifscCode_pay" id="ifscCode_pay" class="form-control" required="required" placeholder="Ifsc Code" />
        </div>
        <div class="col-md-5 top_margin_10">
            <label><i class="fa fa-mobile"></i> Name</label>
            <input type="text" name="beneficiaryName_ipay" id="beneficiaryName_ipay" class="form-control" required="required"  placeholder="Name" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label>&nbsp;</label>
            <button type="button" name="get_name" id="get_name" class="btn btn-success form-control btn-large"  > Verification</button>
        </div>
        <div class="col-md-4 top_margin_10">
            <label><i class="fa fa-mobile"></i> Mobile No</label>
            <input type="number" name="mobileNo_ipay" id="mobileNo_ipay" class="form-control" required="required"  placeholder="Mobile No" />
        </div>
        <div class="col-md-12 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="ipay_add_ben_updte" id="ipay_add_ben_updte" value="1" />
            <button type="submit" name="ipay_submit" id="ipay_submit" class="btn btn-primary form-control btn-large" /> Save</button>
        </div>
        <div class="col-md-3 top_margin_10">
            <label>&nbsp;</label>
        </div>
    </div>
</form>
<form id="ipay_ben_verify_form" class="custom-form-style"  method="POST" onsubmit="return false;" style="display: none;">
    <div class="col-md-4" style="margin-top:20px">
        <div class="form-content">
            <div class="input-group mb-2">
                <span class="input-group-addon "><i class="fa fa-user "></i></span>
                <input type="number" name="ipay_otp" id="ipay_otp" class="form-control recharge_text" placeholder="Otp" required=""  />                                            
            </div>
            <div class="col-md-12 text-center">
                <div class="mb-2 padding_30px">
                    <input type="submit" class="btn btn-quaternary text-color-light text-uppercase font-weight-semibold outline-none custom-btn-style-2 custom-border-radius-1" value="Verify" />                                    
                    <input type="hidden" name="updte" id="updte" value="1" />
                    <input type="hidden" name="benificiary_id" id="benificiary_id" value="0" />
                    <input type="button" class=" btn btn-quaternary text-color-light text-uppercase font-weight-semibold outline-none custom-btn-style-2 custom-border-radius-1"value="ReSend OTP" onclick='resend_otp_ipay();' /> 
                </div>                                
            </div>
        </div>
    </div>
</form>