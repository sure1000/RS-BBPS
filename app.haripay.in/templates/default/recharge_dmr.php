<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="col-md-4 text-center border_box green_header" id="select_imps" onclick="dmr_service('imps')">
            IMPS / NEFT 
        </div>
        <div class="col-md-4 text-center border_box black_header" id="select_aeps" onclick="dmr_service('aeps')">
            AEPS 
        </div>
        <div class="col-md-4 text-center border_box black_header" id="select_upi" onclick="dmr_service('upi')">
            UPI
        </div>                
    </div>
    <div class="card-body">
        <div id="imps_div">
            <?php if ($_SESSION['rech_customer_id'] > 0) { ?>
                <?php include $path . "recharge_dezire.php"; ?>
            <?php } else { ?>
                <?php include $path . "recharge_imps.php"; ?> 
            <?php } ?>
        </div>
        <div id="aeps_div" style="display:none;">
            <?php include $path . "dmr.php"; ?> 
        </div>
        <div id="upi_div" style="display:none;">
            <!-- <?php include $path . "recharge_upi.php"; ?>  -->
        </div>
        <div id="dmr_processing" style="display:none;" class="text-center top_margin_10">
            <?php include $path . "processing.php"; ?>
        </div>
    </div>
</div>