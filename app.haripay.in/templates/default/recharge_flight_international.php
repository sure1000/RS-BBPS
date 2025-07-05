<form name="bus" id="bus" method="post" action="recharge_bus.php" onsubmit="return false;">
    <div class="row">
        <!--div class="col-md-3 top_margin_10">
            <label><i class="fa fa-map-marker"></i> Select Source City </label>
            <select name="bus_source_city" id="bus_source_city" class="form-control">
                <option value="">Select Source City </option>
            </select>
        </div>
        <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-map-marker"></i> Select Destination City </label>
            <select name="bus_destination_city" id="bus_destination_city" class="form-control">
                <option value="">Select Destination City </option>
            </select>
        </div>
       <div class="col-md-3 top_margin_10">
            <label><i class="fa fa-calendar"></i>  Departure Date</label>
            <input type="date" name="bus_departure_date" id="bus_departure_date" class="form-control" required="required" placeholder="Departure Date" />
        </div>
        <div class="col-md-3 top_margin_10">
            <label>&nbsp;</label>
            <input type="hidden" name="bus_updte" id="bus_updte" value="1" />
            <input type="submit" name="bus_submit" id="bus_submit" class="btn btn-primary form-control btn-large" value="Search" />
        </div-->
        <div class="col-md-12 text-danger">
            You are not authorized to Use this Service
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-10" id="bus_provider_info">
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
        <div class="col-md-2 text-right" id="bus_provider_logo">
            <img src="./provider_logos/thumbs/Airtel_Prepaid.png" alt="" class="img-rounded" />
        </div>
    </div>
</form>