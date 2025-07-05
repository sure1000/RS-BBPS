<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <div class="col-md-12 text-left ">
                Commission Structure <small>(Depending upon services, amount can vary time to time)</small>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="recharge_history">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Commission Type</th>
                                <th>Commission Percentage/Flat</th>
                            </tr>
                        </thead>
                        <?php  if($o->user_type == "Distributor"){?>
                            <?php for ($i = 0; $i < $rows; $i++) {?>
                            <tr>
                                <td><b><?=$res[$i]['provider_name'];?>(<?=$res[$i]['service'];?>)</b></td>
                                <td>
                                    
                                       <?= $res[$i]['type_rt']?></td>
                                 

                                <td>
                                     
                                       <?php if ($res[$i]['type_rt'] == "Commission Percentage" || $res[$i]['type_rt'] == "Surcharge Percentage") {?>
                                    <?php if ($res[$i]['commission_amount_dt'] != 0) {?>
                                        <?=$res[$i]['commission_amount_dt'];?>%
                                    <?php } else {?>
                                        -
                                    <?php }?>
                                <?php }else { ?>
                    <?php if ($res[$i]['commission_amount_dt'] != 0) {?>
                                       <i class="fa fa-rupee-sign"></i>  <?=$res[$i]['commission_amount_dt'];?>
                                    <?php } else {?>
                                        -
                                    <?php }?>

                                <?php } ?>
                                </td>
                            </tr>

                        <?php }?>
                        <?php }else {?>
                        <?php for ($i = 0; $i < $rows; $i++) {?>
                            <tr>
                                <td><b><?=$res[$i]['provider_name'];?>(<?=$res[$i]['service'];?>)</b></td>
                                <td>
                                    
                                       <?= $res[$i]['type_rt']?></td>
                                 

                                <td>
                                     
                                       <?php if ($res[$i]['type_rt'] == "Commission Percentage" || $res[$i]['type_rt'] == "Surcharge Percentage") {?>
                                    <?php if ($res[$i]['commission_amount_rt'] != 0) {?>
                                        <?=$res[$i]['commission_amount_rt'];?>%
                                    <?php } else {?>
                                        -
                                    <?php }?>
                                <?php }else { ?>
                               <?php if ($res[$i]['commission_amount_rt'] != 0) {?>
                                       <i class="fa fa-rupee-sign"></i>  <?=$res[$i]['commission_amount_rt'];?>
                                    <?php } else {?>
                                        -
                                    <?php }?>

                                <?php } ?>
                                </td>
                            </tr>

                        <?php }?>
                    <?php }?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->