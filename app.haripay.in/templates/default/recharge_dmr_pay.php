<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="col-md-12 text-center border_box green_header" id="select_dmr_pay" >
           Money Transfer
        </div>

    </div>
    <div class="card-body">
        <div id="ipay_div">
            <?php if ($_SESSION['ipay_customer_id'] > 0) { ?>
                <?php include $path . "ipay_recharge.php"; ?>
            <?php } else { ?>
                <?php include $path . "ipay_join.php"; ?> 
            <?php } ?>
        </div>
    
     
        <div id="dmr_pay_processing" style="display:none;" class="text-center top_margin_10">
            <?php include $path . "processing.php"; ?>
        </div>
    </div>
</div>