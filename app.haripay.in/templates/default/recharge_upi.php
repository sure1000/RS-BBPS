<form name="upi" id="upi" method="post" action="recharge_upi.php" onsubmit="return false;">
    <div class="row">

       <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-mobile"></i> Upi Number</label>
            <input type="number" name="upi_mobile" id="upi_mobile" class="form-control" required="required"  placeholder="Upi Number" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="upi_updte" id="upi_updte" value="1" />
            <input type="submit" name="upi_submit" id="upi_submit" class="btn btn-primary form-control btn-large" value="Submit" />
        </div>
        <div class="col-md-12 text-danger">
            You are not authorized to Use this Service
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-10" id="upi_provider_info">
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
        <div class="col-md-2 text-right" id="upi_provider_logo">
            <img src="./provider_logos/thumbs/Airtel_Prepaid.png" alt="" class="img-rounded" />
        </div>
    </div>
</form>