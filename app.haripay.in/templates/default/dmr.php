<div class="row">
    <!-- <div class="col-md-6">
        <div class="recharge-bg p-4 tabs">
            <?php if ($o->kyc_id > 0) { ?>
                <ul class="nav nav-tabs tab-dmr">
                    <li class="nav-item active">
                        <a class="nav-link border-color-tab" href="#AddBeneficary_DMR" data-toggle="tab"><i class="fa fa-mobile" aria-hidden="true"></i> Add Beneficary</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-color-tab" href="#SendMoney_DMR" data-toggle="tab"><i class="fa fa-mobile" aria-hidden="true"></i> Send Money</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-color-tab" href="#Transactions_DMR" data-toggle="tab"><i class="fa fa-mobile" aria-hidden="true"></i> Transactions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link border-color-tab" href="#AllBeneficary_DMR" data-toggle="tab"><i class="fa fa-mobile" aria-hidden="true"></i> All Beneficary</a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div id="AddBeneficary_DMR" class="tab-pane active">
                        <?php include "html/add_beneficary.php"; ?>

                    </div>
                    <div id="SendMoney_DMR" class="tab-pane ">
                        <?php include "html/dmr_send_money.php"; ?>
                    </div>
                    <div id="Transactions_DMR" class="tab-pane ">
                        <?php include "html/transaction.php"; ?>
                    </div>
                    <div id="AllBeneficary_DMR" class="tab-pane ">
                        <?php include "html/all_beneficary.php"; ?>	
                    </div>

                </div>
            <?php } else if ($row_kyc > 0 && $res_kyc[0]['is_verified'] == "") { ?>

                <div class="col-md-12 padding_30px " style="min-height: 250px">

                    <div class="alert alert-tertiary" style="background: #2baab1;">
                        <strong>Please Wait!</strong> Your document has been upload ! <a href="" class="alert-link">but approval is pending and DMR will active only after approval </a>.


                    </div>
                </div>
            <?php } else { ?>
                <div class="recharge_box">
                    <div class="" >
                        <div   class="col-md-12 right_line text-center ">
                            <strong>KYC</strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 padding_30px ">
                    <?php include $path . "html/kyc.php"; ?>
                </div>

            <?php } ?>

            <div id="processing_dmr" style="display:none" >
                <div class="text-center">
                    <img src="./img/rings.svg" width="100" alt="processing" class="text-center" />
                </div>
            </div>
        </div>
    </div> -->

    <div class="col-md-12">
        <div class="recharge-bg p-4 tabs">


            <h4 class="text-center" > Money Transfer 
                <?php if ($_SESSION['rech_customer_id'] > 0) { ?>
                <br/>
                <i class="fa fa-sign-out " onclick="window.location.href = 'rech_logout.php'">Logout</i>  <?php } ?> </h4>
           
        
            <?php if ($_SESSION['user_id'] > 0) { ?>

                <?php if ($_SESSION['rech_customer_id'] > 0) { ?>                      
                    <ul class="nav nav-tabs tab-dmr">
                        <li class="nav-item active">
                            <a class="nav-link border-color-tab" href="#rech_add_ben" data-toggle="tab"><i class="fa fa-mobile" aria-hidden="true"></i> Add Beneficary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-color-tab" href="#rech_send_money_tab" data-toggle="tab"><i class="fa fa-mobile" aria-hidden="true"></i> Send Money</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-color-tab" href="#rech_transactions_tab" data-toggle="tab"><i class="fa fa-mobile" aria-hidden="true"></i> Transactions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-color-tab" href="#rech_beneficary" data-toggle="tab"><i class="fa fa-mobile" aria-hidden="true"></i> All Beneficary</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div id="rech_add_ben" class="tab-pane active">
                            <?php include  $path . "rech_beneficary.php"; ?>

                        </div>
                        <div id="rech_send_money_tab" class="tab-pane ">
                            <?php include  $path . "rech_send_money.php"; ?>
                        </div>
                        <div id="rech_transactions_tab" class="tab-pane ">
                            <?php include  $path . "rech_transaction.php"; ?>
                        </div>
                        <div id="rech_beneficary" class="tab-pane ">
                            <?php include  $path . "rech_all_beneficary.php"; ?>	
                        </div>

                    </div>
                <?php } else { ?>
                    <!-- <div class="recharge_box">
                        <div class="" >
                            <div  id="mudra_tab" class="col-md-12 right_line text-center active" >
                                <strong>Login / Sign up</strong>
                            </div>

                        </div>

                    </div> -->
                    <div class="col-md-12 padding_30px " style="margin-top: 20px">
                        <?php include  $path . "recharge_aeps.php"; ?>

                    </div> 


                <?php } ?>
            <?php } ?>
             <div id="rech_processing" style="display: none;">
                <div class="text-center">
                    <img src="./img/rings.svg" width="100" alt="processing" class="text-center" />
                </div>
            </div>
          
        </div>
    </div>
</div>



