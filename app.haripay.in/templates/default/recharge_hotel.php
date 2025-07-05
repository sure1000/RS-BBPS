<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="col-md-6 text-center border_box green_header" id="select_hotel" onclick="hotel_service('hotel')" >
           Domestic Hotels
        </div>
        <div class="col-md-6 text-center border_box black_header" id="select_international_hotel" onclick="hotel_service('international_hotel')" >
           International Hotels
        </div>
     
    </div>
    <div class="card-body">
        <div id="hotel_div">
            <?php include $path . "recharge_hotel_search.php"; ?> 
        </div>
         <div id="international_hotel_div" style="display:none;">
            <?php include $path . "recharge_hotel_international.php"; ?> 
        </div>
     
        <div id="hotel_processing" style="display:none;" class="text-center top_margin_10">
            <?php include $path . "processing.php"; ?>
        </div>
    </div>
</div>