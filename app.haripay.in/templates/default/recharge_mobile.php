<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="col-md-4 text-center border_box green_header" id="select_prepaid" onclick="mobile_service('prepaid')">
            Prepaid
        </div>
        <div class="col-md-4 text-center border_box black_header" id="select_postpaid" onclick="mobile_service('postpaid')">
            Postpaid
        </div>
        <div class="col-md-4 text-center border_box black_header" id="select_landline" onclick="mobile_service('landline')">
            Landline
        </div>                
    </div>
    <div class="card-body">
        <div id="prepaid_div">
            <?php include $path . "recharge_prepaid.php"; ?> 
        </div>
        <div id="postpaid_div" style="display:none;">
            <?php include $path . "recharge_postpaid.php"; ?> 
        </div>
        <div id="landline_div" style="display:none;">
            <?php include $path . "recharge_landline.php"; ?> 
        </div>
        <div id="mobile_processing" style="display:none;" class="text-center top_margin_10">
            <?php include $path . "processing.php"; ?>
        </div>
    </div>
</div>