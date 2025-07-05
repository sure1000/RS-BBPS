<?php for ($i = 0; $i < $row_notifications; $i++) {?>
    <a class="dropdown-item d-flex align-items-center" href="#">
        <div>
            <div class="small text-gray-500"><?=format_date_without_br($res_notifications[$i]['notification_date']);?></div>
            <?php if ($res_notifications[$i]['is_active'] == 1) {?>
                <span class="font-weight-bold">Notifications </span>
                 <?=$res_notifications[$i]['notification'];?> 

                   
               
                 
            <?php } else {?>
                <?=$res_notifications[$i]['notification'];?>

            <?php }?>
        </div>
    </a>
<?php }?>
<!-- <a class="dropdown-item text-center small text-gray-500" href="#" onclick="clear_notifications()">Clear All Alerts</a> -->