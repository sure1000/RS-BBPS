<div id="rech_transaction_div" >    
    <div class="col-md-12 padding_10px " style="min-height:350px !important;">
        <div class="table-responsive">
            <h4>Last Ten Transactions</h4>
            <table class="table table-bordered table-striped table-condensed mb-none">
                <thead>
                    <tr>
                       
                        <th width="10%"> Name</th>
                        <th width="10%">Account Number</th>
                        <th width="10%"> Transaction Id</th>
                        <th width="10%">Amount</th>
                        
                        <th width="10%">Status</th>
                          
                    </tr>
                    <?php for ($l = 0; $l < $rows_tra_rech; $l++) { ?>
                        <tr>
                           
                            <td><?= $res_tra_rech[$l]['beneficiaryName']; ?></td>
                            <td><?= $res_tra_rech[$l]['beneficiaryAccountNumber']; ?></td>
                          
                            <td><?= $res_tra_rech[$l]['urid']; ?></td>
                              <td><?= $res_tra_rech[$l]['wallet_amount']; ?></td>
                             <td>
                                
                              <?php if($res_tra_rech[$l]['other'] == 'Beneficiary Verification') { ?>
                               Verification
                              <?php } else { ?>
                               <?= $res_tra_rech[$l]['status']; ?>
                              <?php }?>
                          
                            </td>
                            
                           

                        </tr>
                    <?php } ?>
                </thead>                    
            </table>
        </div>
    </div>
</div>


   <div class="modal fade" id="refund_eko_modal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="form-horizontal form-label-left"   id='refund_otp_eko' name="refund_otp_eko" method="post" onsubmit="return false;"    enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="formModalLabel">Enter OTP</h4>
                    </div>
                    <div class="col-md-12">



                        <div class="col-md-12">
                            <label class="black">Transaction Id </label>
                            <input type="number" name="transaction_id" id="transaction_id"  readonly class="form-control input-lg" placeholder="transaction id" value=""  required="required" />
                        </div>
                        <div class="col-md-12">
                            <label class="black">Otp</label>
                            <input type="number" name="eko_otp" id="eko_otp" class="form-control input-lg" placeholder="otp " value=""  required="required" />
                        </div>


                        <div class="col-md-12">
                            <div class="col-md-12 mt-lg">
                                <input type="hidden" name="updte" id="updte" value="1" />
                                <input type="submit" name="save" id="save" class="btn btn-danger" value="Send" />
                                <input type="button" name="save"  onclick="resend_otp();" class="btn btn-danger " value="Resend Otp" />
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>