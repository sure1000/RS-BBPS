<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="col-md-12 text-center border_box green_header" id="select_school_fee" onclick="school_service('school_fee')" >
            School Fee
        </div>
     
    </div>
    <div class="card-body">
        <div id="school_fee_div">
            <?php include $path . "recharge_school_fee.php"; ?> 
        </div>
     
        <div id="school_processing" style="display:none;" class="text-center top_margin_10">
            <?php include $path . "processing.php"; ?>
        </div>
    </div>
</div>