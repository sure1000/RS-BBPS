<form name="prepaid" id="prepaid" method="post" action="recharge_prepaid.php" onsubmit="return false;">
    <div class="row">
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> Prepaid Number</label>
            <input type="number" name="prepaid_number" id="prepaid_number" class="form-control" placeholder="Enter 10 Digit Prepaid Number" value="" min="6000000000" max="9999999999"  required="required" onchange="check_number(this.value, 'prepaid')" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-rss"></i> Service Provider</label>
            <select name="prepaid_provider" id="prepaid_provider" class="form-control" required="required" onchange="provider_info(this.value,'prepaid')" >
                <option value="">Select Provider</option>
                <?=get_provider_list_by_service("0", "1");?>
            </select>
        </div>
        <div class="col-md-2 top_margin_10">
            <label><i class="fa fa-globe"></i> Service Circle</label>
            <select name="prepaid_circle" id="prepaid_circle" class="form-control" required="required" onchange="get_prepaid_plans('combo', 'prepaid')">
                <option value="">Select Service </option>
                <?=get_circle_list("");?>
            </select>
        </div>

        <div class="col-md-2 top_margin_10">
            <label><i class="fa fa-rupee-sign"></i> Recharge Amount</label>
            <input type="number" name="prepaid_amount" id="prepaid_amount" class="form-control" required="required" step="0.01" placeholder="Recharge Amount" />
          
        </div>
        <div class="col-md-2 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="prepaid_updte" id="prepaid_updte" value="1" />
            <input type="submit" name="prepaid_submit" id="prepaid_submit" class="btn btn-primary form-control btn-large" value="Recharge Now" />
        </div>
<!--        <div class="col-md-1 top_margin_10">
            <label>&nbsp;</label>
             <input type="hidden" name="prepaid_updte" id="prepaid_updte" value="1" /> 
            <input type="button" name="offer_submit" id="offer_submit" class="btn btn-primary form-control btn-large" value="R Offers" />
        </div>-->
    </div>
    <div class="row top_margin_10" id="special_recharge" style="display:none;">
        <div class="offset-3 col-md-3 top_margin_10">
            <input type="radio" name="special" id="special" value="Special" class="form-radio" checked="checked" /> STV
            <input type="radio" name="special" id="topup" value="Topup" class="form-radio" /> Topup
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-10" id="prepaid_provider_info">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs">
                        <ul class="nav nav-tabs" id="prepaid_plans_parent">
<!--                            <li class="nav-item active" id="prepaid_plans_primary">
                                <a class="nav-link active" href="#prepaid_plans" data-toggle="tab" onclick="get_prepaid_plans('COMBO','prepaid')">Popular / Combo</a>
                            </li>-->
                            <li class="nav-item ">
                                <a class="nav-link  " href="#prepaid_plans" data-toggle="tab" onclick="get_mobile_offers('prepaid')">R Offers</a>
                            </li>
<!--                            <li class="nav-item">
                                <a class="nav-link" href="#prepaid_plans" data-toggle="tab" onclick="get_prepaid_plans('FULLTT','prepaid')">Full TT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#prepaid_plans" data-toggle="tab" onclick="get_prepaid_plans('RATE CUTTER','prepaid')">Rate Cutter</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#prepaid_plans" data-toggle="tab" onclick="get_prepaid_plans('TOPUP','prepaid')">Top Up</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#prepaid_plans" data-toggle="tab" onclick="get_prepaid_plans('3G/4G','prepaid')">3g/4g Data</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#prepaid_plans" data-toggle="tab" onclick="get_prepaid_plans('2G','prepaid')">2g Data</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#prepaid_plans" data-toggle="tab" onclick="get_prepaid_plans('Romaing','prepaid')">Roaming</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#prepaid_plans" data-toggle="tab" onclick="get_user_info('prepaid')">User Info</a>
                            </li>-->
                        </ul>
                        <div class="tab-content top_margin_10">
                            <div id="prepaid_plans" class="tab-pane active" style="padding-left:10px;">
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
                            <div id="roffer_processing" style="display:none;" class="text-center top_margin_10">
                                <?php include $path . "processing.php";?>
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
        <div class="col-md-2 text-right top_margin_10" id="prepaid_provider_logo">

        </div>
    </div>
</form>