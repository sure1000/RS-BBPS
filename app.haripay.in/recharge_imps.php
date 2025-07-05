<form name="imps" id="imps" method="post" action="recharge_imps.php" onsubmit="return false;">
    <div class="row">
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> Mobile Number</label>
            <input type="number" name="imps_mobile" id="imps_mobile" class="form-control" required="required"  placeholder="Mobile Number" />
        </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="imps_login_updte" id="imps_login_updte" value="1" />
            <input type="submit" name="imps_submit" id="imps_submit" class="btn btn-primary form-control btn-large" value="Continue" />
        </div>
  
    </div>
</form>
<form name="imps_pin" id="imps_pin" method="post" action="recharge_imps.php" onsubmit="return false;" style="display : none">
    <div class="row">
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> PIN</label>
            <input type="number" name="imps_pin" id="imps_pin" class="form-control" required="required"  placeholder="Enter Pin" />
        </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="imps_pin_updte" id="imps_pin_updte" value="1" />
            <input type="hidden" name="dezire_user_id" id="dezire_user_id" value="0" />
            <input type="submit" name="imps_submit" id="imps_submit" class="btn btn-primary form-control btn-large" value="Continue" />
        </div>
         <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="button" name="forget_pin" id="forget_pin" class="btn btn-primary form-control btn-large"  value="Forgot Pin" />
        </div>
  
    </div>
</form>
<!--<form name="imps" id="imps" method="post" action="recharge_imps.php" onsubmit="return false;">
    <div class="row">
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> Mobile Number</label>
            <input type="number" name="imps_mobile" id="imps_mobile" class="form-control" required="required"  placeholder="Mobile Number" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-map-marker"></i> Pin</label>
            <input type="number" name="imps_pin" id="imps_pin" class="form-control" required="required" placeholder="PIN" />
        </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="imps_login_updte" id="imps_login_updte" value="1" />
            <input type="submit" name="imps_submit" id="imps_submit" class="btn btn-primary form-control btn-large" value="Login" />
        </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="button" name="imps_register_btn" id="imps_register_btn" class="btn btn-primary form-control btn-large"  value="Register" />
        </div>
                <div class="col-md-12 text-danger">
                    You are not authorized to Use this Service
                </div>
    </div>
</form-->
<form name="imps_register" id="imps_register" method="post" action="imps_register.php" onsubmit="return false;" style="display : none">
    <div class="row">
          <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i>Mobile </label>
            <input type="number" name="imps_mobileNo" id="imps_mobileNo" readonly=""  class="form-control" required="required"  placeholder="Mobile Number" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-user"></i>  First Name</label>
            <input type="text" name="imps_first_Name" id="imps_first_Name" class="form-control" required="required"  placeholder="First Name" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-user"></i> Last Name</label>
            <input type="text" name="imps_last_Name" id="imps_last_Name" class="form-control" required="required"  placeholder="Last Name" />
        </div>
          <div class="col-md-3 top_margin_10" >
                    <label><i class="fa fa-map-marker"></i> Pincode</label>
                    <input type="number" name="imps_pincode" id="imps_pincode" class="form-control" placeholder="Pincode" />
                </div>
      
<!--
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-address-book-o"></i> Kyc</label>
            <select name="kyc_Flag" id="kyc_Flag" class="form-control" required  onclick="change_kyc(this.value)">
                <option value="0">Select Kyc Type</option>
                <option value="false">Non Kyc</option>
                <option value="true">Kyc</option>

            </select>
        </div>-->
<!--        <span id="kyc_div" class="col-md-12 top_margin_10" style="display : none" >
            <h6>Kyc Details :</h6>
            <div class="row">
                <div class="col-md-3 top_margin_10">
                    <label><i class="fa fa-address-book-o"></i> Address</label>
                    <input type="text" name="imps_address" id="imps_address" class="form-control"   placeholder="Address" />
                </div>
                <div class="col-md-3 top_margin_10">
                    <label><i class="fa fa-map-marker"></i> City Name</label>
                    <input type="text" name="imps_cityName" id="imps_cityName" class="form-control"  placeholder="City Name" />
                </div>
                <div class="col-md-3 top_margin_10">
                    <label><i class="fa fa-globe"></i> State</label>
                    <select name="stateID" id="stateID" class="form-control">
                        <option value="0">Select State</option>
                        <?= dezire_state_list(0); ?>
                    </select>
                </div>
              
                <div class="col-md-3 top_margin_10">
                    <label><i class="fa fa-map-marker"></i> Address Proof</label>
                    <select name="addressProof" id="addressProof" class="form-control">
                        <option value="0">Select Address Proof</option>
                        <?= dezire_proof_list(0, "Address Proof"); ?>
                    </select>
                </div>
                <div class="col-md-3 top_margin_10">
                    <label><i class="fa fa-map-marker"></i> Address Proof No</label>
                    <input type="text" name="imps_addressProofNo" id="imps_addressProofNo" class="form-control" placeholder="Address Proof No" />
                </div>

                <div class="col-md-3 top_margin_10">
                    <label><i class="fa fa-file"></i> Address Proof Image</label>
                    <input type="file" name="imps_addressProofUrl" id="imps_addressProofUrl" class="form-control"  />
                </div>
                <div class="col-md-3 top_margin_10">
                    <label><i class="fa fa-map-marker"></i> ID Proof</label>
                    <select name="idProof" id="idProof" class="form-control">
                        <option value="0">Select ID Proof</option>
                        <?= dezire_proof_list(0, "ID Proof"); ?>
                    </select>  </div>
                <div class="col-md-3 top_margin_10">
                    <label><i class="fa fa-map-marker"></i> ID Proof No</label>
                    <input type="text" name="imps_idProofNo" id="imps_idProofNo" class="form-control" r placeholder="ID Proof No" />
                </div>

                <div class="col-md-3 top_margin_10">
                    <label><i class="fa fa-map-marker"></i> ID Proof Image</label>
                    <input type="file" name="imps_idProofUrl" id="imps_idProofUrl" class="form-control"  />
                </div>
            </div>
        </span>-->
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="imps_join_updte" id="imps_join_updte" value="1" />
            <input type="hidden" name="dezire_mobile" id="dezire_mobile" value="0" />
            <input type="submit" name="imps_submit" id="imps_submit" class="btn btn-primary form-control btn-large" value="Register" />
        </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="button" name="imps_back_btn" id="imps_back_btn" class="btn btn-primary form-control btn-large"  value="Back" />
        </div>

            
    </div>
</form> 