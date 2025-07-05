
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="row" style="width:100%;">
            <div class="col-md-6">
                <h1 class="h3 mb-0 text-gray-800">Choose API Plan <span class="small">(Current Plan: <?= $o1->plan_name; ?>)</span></h1>
            </div>
        </div>

    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <?php for ($i = 0; $i < $rows; $i++) { ?>
            <?php if ($o->plan_id == $res[$i]['user_plan_id']) { 
                    $class_name = "border-left-success";
                 }else{ 
                    $class_name = "border-left-warning";
             } ?>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card <?=$class_name;?>  shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h4><?= $res[$i]['plan_name']; ?></h4></div>
                                <?php if ($o->plan_id == $res[$i]['user_plan_id']) { ?>
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><h4>Current Plan</h4></div>
                                <?php } ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="fa fa-rupee-sign"></i> <?= $res[$i]['amount']; ?></div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <?php if ($res[$i]['validity'] == "") { ?>
                                        Validity Life Time
                                    <?php } else { ?>
                                        Validity <?= $res[$i]['validity']; ?> Months
                                    <?php } ?>
                                </div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <button name="view_plan" id="view_plan_<?= $i; ?>" class='btn btn-info' onclick="plan_details('<?=$res[$i]['user_plan_id'];?>')">View Plan</button>
                                    <a href="activate_plan.php?aid=<?=$res[$i]['user_plan_id'];?>" class="btn btn-success">Activate Plan</a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->


<div class="modal fade " id="plan_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Plan Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="user_plan_id">
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>                
            </div>
        </div>
    </div>
</div>