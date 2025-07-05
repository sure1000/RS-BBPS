<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="col-md-6 text-center border_box green_header" id="select_insurance_premium" onclick="insurance_service('insurance_premium')">
            Insurance Premium
        </div>
        <div class="col-md-6 text-center border_box black_header" id="select_insurance_purchase" onclick="insurance_service('insurance_purchase')">
            Insurance Purchase
        </div>
    </div>
    <div class="card-body">
        <div id="insurance_premium_div">
            <?php include $path . "recharge_insurance_premium.php"; ?> 
        </div>
        <div id="insurance_purchase_div" style="display:none;">
            <?php include $path . "recharge_insurance_purchase.php"; ?> 
        </div>
        <div id="insurance_processing" style="display:none;" class="text-center top_margin_10">
            <?php include $path . "processing.php"; ?>
        </div>
    </div>
</div>