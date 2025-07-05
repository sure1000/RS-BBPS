<div id="rech_beneficary_div">
    <form id="rech_add_recipient" class="custom-form-style"  method="POST" onsubmit="return false;">
        <div class="form-content">
            <div class="input-group mb-3">
                <span class="input-group-addon recharge_icon"><i class="fa fa-university fa-2x"></i></span>
                <input type="text" name="bank_rech" id="bank_rech" class="form-control recharge_text Show" placeholder="Bank " autocomplete="off" required="" />                             
                <div class="showDiv scroll src-select6">
                     <div class="bs-component">
                        <div class="list-group" id="src_search_rech">

                        </div>
                    </div>
                </div>

            </div>

            <div class="input-group mb-3">
                <span class="input-group-addon recharge_icon"><i class="fa fa-address-card-o fa-2x"></i></span>
                <input type="text" name="rech_ifsc"  id="rech_ifsc" class="form-control recharge_text" placeholder="IFSC Code" required="" />                                            
            </div>
            <div class="input-group mb-3">
                <span class="input-group-addon recharge_icon"><i class="fa fa-address-card-o fa-2x"></i></span>
                <input type="number" name="rech_account" id="rech_account" class="form-control recharge_text" placeholder="Account Number" required="" />                                            
            </div>

            <div class="input-group mb-3">
                <span class="input-group-addon recharge_icon"><i class="fa fa-user fa-2x"></i></span>
                <input type="name" name="rech_recipient_name" id="rech_recipient_name" class="form-control recharge_text" placeholder="Recipient Name" required=""  />                                            
            </div>
            <div class="input-group mb-3">
                <span class="input-group-addon recharge_icon"><i class="fa fa-mobile fa-2x"></i></span>
                <input type="text" name="rech_receipient_mobile" id="rech_receipient_mobile" class="form-control recharge_text" placeholder="Mobile" required=""  />                                            
            </div>





            <div class="col-md-12 text-center">
                <div class="input-group text-center mb-3">
                                        
                    <input type="hidden" name="updte" id="updte" value="1" />
                    <button type="button" class="recharge-section-btn btn mb-2" onclick="rech_acc_verify()" style="width:60%"><i class="fa fa-paper-plane"></i>Account Verification</button>
            <button type="submit" class="recharge-section-btn-submit btn mb-2"><i class="fa fa-paper-plane"></i>Send</button>


                </div>      

            </div> 
        </div>
    </form>
</div>
<div id="rech_ben_verify" style="display: none" >
    <form id="rech_ben_verify_form" class="custom-form-style"  method="POST" onsubmit="return false;">
        <div class="col-md-12" style="margin-top:20px">
            <div class="form-content">

                <div class="input-group mb-3">
                    <span class="input-group-addon recharge_icon"><i class="fa fa-user fa-2x"></i></span>
                    <input type="number" name="rech_otp" id="rech_otp" class="form-control recharge_text" placeholder="Otp" required=""  />                                            
                </div>
                <div class="col-md-12 text-center">
                    <div class="mb-3 padding_30px">
                        <input type="submit" class="recharge-section-btn-submit btn mb-2" value="Verify" />                                    
                        <input type="hidden" name="updte" id="updte" value="1" />
                        <input type="hidden" name="rech_benificiary_id_otp" id="rech_benificiary_id_otp" value="0" />
                        <!--input type="button" class="recharge-section-btn btn mb-2" value="ReSend OTP" onclick='resend_otp_rech();' /--> 

                    </div>                                
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="rech_account_verify" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header" style="background:#f26430; display: inline" >
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Beneficiary Account Verification </h4>
            </div>
            <form id="rech_acc_verify_form" class="custom-form-style"  method="POST" onsubmit="return false;">
                <div class="col-md-12" style="margin-top:20px">
                    <div id="acc_ver_hide">
                        <div class="form-content">

                            <div class="input-group mb-3">
                                <span class="input-group-addon recharge_icon"><i class="fa fa-user fa-2x"></i></span>
                                <input type="number" name="rech_acc_number" id="rech_acc_number" class="form-control recharge_text" placeholder="Account Number" required=""  />                                            
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-addon recharge_icon"><i class="fa fa-user fa-2x"></i></span>
                                <input type="text" name="rech_verify_ifsc" id="rech_verify_ifsc" class="form-control recharge_text" placeholder="IFSC Code" required=""  />                                            
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="mb-3 padding_30px">
                                    <input type="submit" class="btn btn-quaternary text-color-light text-uppercase font-weight-semibold outline-none custom-btn-style-2 custom-border-radius-1" value="Verify" />                                    
                                    <input type="hidden" name="updte" id="updte" value="1" />


                                </div>                                
                            </div>
                        </div>
                        <div id="rech_ben_info" style="display:none">
                            <h4>Account Detail :</h4>
                            <div class="col-md-12">
                            <div class="col-md-row">
                                <div class="col-md-6">Name :</div>
                                <div class="col-md-6"><span id="ben_name"></span></div>
                                <div class="col-md-6">Account Number :</div>
                                <div class="col-md-6"><span id="benificiary_acc" ></span></div>
                                <div class="col-md-6">IFSC Code :</div>
                                <div class="col-md-6"><span id="ipay_ifsc_bn" ></span></div>
                                <div class="col-md-6">Charged Amt. :</div>
                                <div class="col-md-6"><span id="charged_amt" ></span></div>
                                <div class="col-md-6">Account Status  :</div>
                                <div class="col-md-6"><span id="ver_status" ></span></div>

                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="processing_rech" style="display: none;">
                    <div class="text-center">
                        <img src="./img/rings.svg" width="100" alt="processing" class="text-center" />
                    </div>
                </div>
            </form>



            <div class="modal-footer"> </div>
        </div>
    </div>
</div>