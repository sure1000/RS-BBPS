<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="col-md-6 text-center border_box green_header" id="select_dth" onclick="dth_service('dth')">
            DTH
        </div>
        <div class="col-md-6 text-center border_box black_header" id="select_dth_activation" onclick="dth_service('dth_activation')">
            DTH Activation
        </div>
    </div>
    <div class="card-body">
        <div id="dth_div">
            <?php include $path . "recharge_dth_tv.php";?>
        </div>
        <div id="dth_activation_div" style="display:none;">
            <?php include $path . "recharge_dth_activation.php";?>
        </div>
        <div id="dth_processing" style="display:none;" class="text-center top_margin_10">
            <?php include $path . "processing.php";?>
        </div>
    </div>
</div>