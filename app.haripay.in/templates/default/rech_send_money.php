<form name="rech_send_money_form" id="rech_send_money_form" method="post" onsubmit="return false;">
    <div class="row">
           <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-address-book-o"></i> Beneficiary</label>
            <select name="beneficiary_id" id="beneficiary_id" class="form-control" required  >
            </select>
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i>Amount</label>
            <input type="number" name="rech_amount" id="rech_amount" class="form-control" required="required"  placeholder="Amount" />
        </div>
     
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-map-marker"></i>  Remarks</label>
            <input type="text" name="rech_remark" id="rech_remark" class="form-control"  placeholder="Remark" />
        </div>
     
    
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="rech_send_updte" id="rech_send_updte" value="1" />
            <input type="submit" name="rech_submit" id="rech_submit" class="btn btn-primary form-control btn-large" value="Save" />
           
        </div>
  </div>
</form>