<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="col-md-6 text-center border_box green_header" id="select_bus" onclick="bus_service('bus')">
            Bus Booking
        </div>
        <div class="col-md-6 text-center border_box black_header" id="select_cab" onclick="bus_service('cab')">
            Cab Booking
        </div>        
    </div>
    <div class="card-body">
        <div id="bus_div">
            <?php include $path . "recharge_bus_search.php"; ?> 
        </div>
        <div id="cab_div" style="display:none;">
            <?php include $path . "recharge_cab_search.php"; ?> 
        </div>
        <div id="bus_processing" style="display:none;" class="text-center top_margin_10">
            <?php include $path . "processing.php"; ?>
        </div>
    </div>
</div>