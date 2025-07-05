<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="col-md-4 text-center border_box green_header" id="select_electricity" onclick="utility_service('electricity')">
            Electricity
        </div>
        <div class="col-md-4 text-center border_box black_header" id="select_water" onclick="utility_service('water')">
            Water
        </div>
        <div class="col-md-4 text-center border_box black_header" id="select_gas" onclick="utility_service('gas')">
            Gas
        </div>                
    </div>
    <div class="card-body">
        <div id="electricity_div">
            <?php include $path . "recharge_electricity.php"; ?> 
        </div>
        <div id="water_div" style="display:none;">
            <?php include $path . "recharge_water.php"; ?> 
        </div>
        <div id="gas_div" style="display:none;">
            <?php include $path . "recharge_gas.php"; ?> 
        </div>
        <div id="utility_processing" style="display:none;" class="text-center top_margin_10">
            <?php include $path . "processing.php"; ?>
        </div>
    </div>
</div>