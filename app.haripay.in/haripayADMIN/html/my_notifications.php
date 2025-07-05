<?php for ($i = 0; $i < $row_notifications; $i++) {?>
    <a class="dropdown-item d-flex align-items-center" href="#">
        <div>
            <div class="small text-gray-500"><?=format_date_without_br($res_notifications[$i]['dispute_date']);?></div>
            <?php if ($res_notifications[$i]['is_active'] == 2) {?>
                <span class="font-weight-bold">Dispute Raised </span>
                    Ref. no. : <?=$res_notifications[$i]['ref_number'];?> &
                    Name : <?=$res_notifications[$i]['user_name']; ?> 
               
                 
            <?php } else {?>
                <?=$res_notifications[$i]['user_name'];?>

            <?php }?>
        </div>
    </a>
<?php }?>
<!-- <a class="dropdown-item text-center small text-gray-500" href="#" onclick="clear_notifications()">Clear All Alerts</a> -->