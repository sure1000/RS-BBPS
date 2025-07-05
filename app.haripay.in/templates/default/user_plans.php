<div class="row ">
    <div class="col-md-4 border-bottom-1"><b>Service</b></div>
    <div class="col-md-4 border-bottom-1"><b>Commission Amount</b></div>
    <div class="col-md-4 border-bottom-1"><b>Commission Percentage</b></div>
</div>
<div class="row ">
    <?php for ($i = 0; $i < $rows; $i++) {?>

        <?php if ($i % 2 == 0) {$bgcolor = "bg-gray-100";} else { $bgcolor = "";}?>
        <div class="<?=$bgcolor;?> col-md-4 border-bottom-1"><?=$res[$i]['provider_name'];?> (<?=$res[$i]['service'];?>)</div>
        <?php if ($o->user_type =="Retailer" && $res[$i]['type_rt'] =="Commission Flat" ){?>
        <div class="<?=$bgcolor;?> col-md-4 border-bottom-1"><i class="fa fa-rupee-sign"></i> <?=$res[$i]['commission_amount_rt'];?></div>    
        <?php }else{?>
            <div class="<?=$bgcolor;?> col-md-4 border-bottom-1"><i class="fa fa-rupee-sign"></i> <?=$res[$i]['commission_amount_dt'];?></div>
        <?php } ?>
        <?php if ($o->user_type=="Retailer" && $res[$i]['type_rt']=='Commission Percentage') { ?>
        <div class="<?=$bgcolor;?> col-md-4 border-bottom-1"><?=$res[$i]['commission_amount_rt'];?>%
        </div>
<?php }else{ ?>
    <div class="<?=$bgcolor;?> col-md-4 border-bottom-1"><?=$res[$i]['commission_amount_dt'];?>%
        </div> 
<?php } ?>
    <?php }?>
</div>
<div class="row top_margin_10">
    <div class="col-md-12 text-right">
        <a href="activate_plan.php?aid=<?=$user_plan_id;?>" class="btn btn-success">Activate Plan</a>
    </div>
</div>