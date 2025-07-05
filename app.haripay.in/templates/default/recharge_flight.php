<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="col-md-6 text-center border_box green_header" id="select_flight" onclick="flight_service('flight')" >
           Domestic  Flight
        </div>
        <div class="col-md-6 text-center border_box black_header" id="select_international_flight" onclick="flight_service('international_flight')" >
          International Flight
        </div>
     
    </div>
    <div class="card-body">
        <div id="flight_div">
            <?php include $path . "recharge_flight_search.php"; ?> 
        </div>
          <div id="international_flight_div" style="display:none;">
            <?php include $path . "recharge_flight_international.php"; ?> 
        </div>
     
        <div id="flight_processing" style="display:none;" class="text-center top_margin_10">
            <?php include $path . "processing.php"; ?>
        </div>
    </div>
</div>