<form name="postpaid" id="postpaid" method="post" action="recharge_postpaid.php" onsubmit="return false;">
    <div class="row">
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> Postpaid Number</label>
            <input type="number" name="postpaid_number" id="postpaid_number" class="form-control" placeholder="Enter 10 Digit Postpaid Number" value="" min="6000000000" max="9999999999"  required="required" onchange="check_number(this.value, 'postpaid')" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-rss"></i> Service Provider</label>
            <select name="postpaid_provider" id="postpaid_provider" class="form-control" required="required" onchange="provider_info(this.value,'postpaid')">
                <option value="">Select Provider</option>
                 <?=get_provider_list_by_service("0","10");?>
            </select>
        </div>
        <div class="col-md-2 top_margin_10">
            <label><i class="fa fa-globe"></i> Service Circle</label>
            <select name="postpaid_circle" id="postpaid_circle" class="form-control" required="required">
                <option value="">Select Service Circle</option>
                 <?=get_circle_list("");?>
            </select>
        </div>
        <div class="col-md-2 top_margin_10">
            <label><i class="fa fa-rupee-sign"></i> Recharge Amount</label>
            <input type="number" name="postpaid_amount" id="postpaid_amount" class="form-control" required="required" step="0.01" placeholder="Recharge Amount" />
        </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="postpaid_updte" id="postpaid_updte" value="1" />
            <input type="submit" name="postpaid_submit" id="postpaid_submit" class="btn btn-primary form-control btn-large" value="Recharge Now" /></div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-10" id="postpaid_provider_info">
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
        <div class="col-md-2 text-right" id="postpaid_provider_logo">
            
        </div>
    </div>
</form>