<form name="dth" id="dth" method="post" action="recharge_dth.php" onsubmit="return false;">
    <div class="row">
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> DTH Number</label>
            <input type="number" name="dth_number" id="dth_number" class="form-control" placeholder="DTH Number" value="" required="required" onkeyup="dth_operator(this.value);"  />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-rss"></i> Service Provider</label>
            <select name="dth_provider" id="dth_provider" class="form-control" required="required" onchange="provider_info(this.value,'dth')">
                <option value="">Select Provider</option>
                <?=get_provider_list_by_service("0","4");?>
            </select>
        </div>
        <div class="col-md-2 top_margin_10">
            <label><i class="fa fa-rupee-sign"></i> Recharge Amount</label>
            <input type="number" name="dth_amount" id="dth_amount" class="form-control" required="required" step="0.01" placeholder="Recharge Amount" />
        </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="dth_updte" id="dth_updte" value="1" />
            <input type="submit" name="dth_submit" id="dth_submit" class="btn btn-primary form-control btn-large" value="Recharge Now"/>
    </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
           
            <button type="button" name="get_info" id="get_info" onclick="get_dth_info('dth')" class="btn btn-primary form-control btn-large" >Dth Info </button>
        </div>
    </div>
    <hr />
<!--    <div class="row">
        <div class="col-md-10" id="dth_provider_info">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs">
                        <ul class="nav nav-tabs" id="dth_plans_parent">
                            <li class="nav-item active" id="dth_plans_primary">
                                <a class="nav-link active" href="#dth_plans" data-toggle="tab" onclick="get_prepaid_plans('Plan','dth')">Plans</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#dth_plans" data-toggle="tab" onclick="get_prepaid_plans('Add-On Pack','dth')">Add-On Pack(s)</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#dth_plans" data-toggle="tab" onclick="get_mobile_offers('dth')">R Offers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#dth_plans" data-toggle="tab" onclick="get_user_info('dth')">User Info</a>
                            </li>
                        </ul>
                        <div class="tab-content top_margin_10">
                            <div id="dth_plans" class="tab-pane active" style="padding-left:10px;">
                                <table class="table table-bordered table-striped" width="100%" padding="4" style="padding:10px;">
                                    <tr>
                                        <th width="75%">Description</th>
                                        <th width="15%">Validity</th>
                                        <th width="10%">Price</th>
                                    </tr>
                                    <tr>
                                        <td colspan='3'>Plans will be listed here</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-12">

            </div>
        </div>
        <div class="col-md-2 text-right top_margin_10" id="dth_provider_logo">
            
        </div>
    </div>-->
</form>