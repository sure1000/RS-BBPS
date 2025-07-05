<div class="card shadow mb-4 " id="dezire_show_deatils">
   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
       <h6> <label class="m-0 font-weight-bold text-primary">User :</label>  <?= $rech_user->first_Name; ?> <?= $rech_user->last_Name; ?> <?= $rech_user->mobileNo; ?> </h6>
       <h6> <label class="m-0 font-weight-bold text-primary">Kyc Status : </label>  <?= $rech_user->kyc_status; ?> </h6>
       <h6><label class="m-0 font-weight-bold text-primary">  Last Login : </label>  <?= $rech_user->updated_at; ?> </h6>
       <h6><a class="m-0 font-weight-bold text-primary" href="rech_logout.php"> Logout </a>  </h6>
    </div>
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="col-md-4 text-center border_box green_header" id="select_addben" onclick="rech_service('addben')">
            Add Beneficiary
        </div>
        <div class="col-md-4 text-center border_box black_header" id="select_rechsend" onclick="rech_service('rechsend')">
            Send Money 
        </div>
        <div class="col-md-4 text-center border_box black_header" id="select_allben" onclick="rech_service('allben')">
            All Beneficiary
        </div>                
    </div>
    <div class="card-body">
        <div id="addben_div">
  <?php include $path . "rech_add_beneficiary.php"; ?> 
  </div>
        <div id="rechsend_div" style="display:none;">
            <?php include $path . "rech_send_money.php"; ?> 
        </div>
        <div id="allben_div" style="display:none;">
            <?php include $path . "rech_all_beneficary.php"; ?> 
        </div>
        <div id="rech_processing" style="display:none;" class="text-center top_margin_10">
            <?php include $path . "processing.php"; ?>
        </div>
    </div>
</div>