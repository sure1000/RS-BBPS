<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="col-md-12 text-center border_box green_header" id="select_credit" onclick="credit_service('credit')" >
           Credit Card
        </div>
     
    </div>
    <div class="card-body">
        <div id="credit_div">
            <?php include $path . "recharge_credit.php"; ?> 
        </div>
     
        <div id="creditcard_processing" style="display:none;" class="text-center top_margin_10">
            <?php include $path . "processing.php"; ?>
        </div>
    </div>
</div>