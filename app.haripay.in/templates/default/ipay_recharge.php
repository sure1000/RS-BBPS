<div class="card shadow mb-4 " id="dezire_show_deatils">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6> <label class="m-0 font-weight-bold text-primary">User :</label>  <?= $ipay_user->first_Name; ?> <?= $ipay_user->last_Name; ?> <?= $ipay_user->mobileNo; ?> </h6>
        <h6> <label class="m-0 font-weight-bold text-primary"> Total Limit : </label>  <span id="ipay_balance_limit"> <?= $ipay_user->balance_limit; ?> </span>
                <label class="m-0 font-weight-bold text-primary">  Remaining : </label> <span id="ipay_balance" > <?= $ipay_user->balance; ?> </span></h6>
        <h6><label class="m-0 font-weight-bold text-primary">  Last Login : </label>  <?= $ipay_user->updated_at; ?> </h6>
        <h6><a class="m-0 font-weight-bold text-primary" href="ipay_logout.php"> Logout </a>  </h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">  
                <?php include $path . "ipay_add_beneficiary.php"; ?> 
                <?php include $path . "ipay_send_money.php"; ?>  </div>
            <div class="col-md-6"> <?php include $path . "ipay_all_beneficiary.php"; ?> </div>
        </div>
        <div id="ipay_processing" style="display:none;" class="text-center top_margin_10">
            <?php include $path . "processing.php"; ?>
        </div>
    </div>
</div>