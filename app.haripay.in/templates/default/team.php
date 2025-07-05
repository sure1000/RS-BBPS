
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">My <?= $mtype ?> List</h1>

    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="color:white; background-color:#205f56;">
                        <tr>
                            <th>S.No</th>
                            <th>Username</th>
                            <th>User Type</th>
                            <?php if($o->user_type != "Retailer"){?>
                            <th>Parent</th>
                            <?php }?>
                            <th>Balance</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php for ($i = 0; $i < $rows; $i++) { ?>
                            <?php $colors = user_type_colors($res[$i]['user_type']); ?>
                            <tr bgcolor="<?= $colors['bgcolor']; ?>" style="color:<?= $colors['color']; ?>" >
                                <td><?= $i + 1; ?></td>
                                <td>
                                    <?= $res[$i]['name']; ?><br />
                                    <?= $res[$i]['mobile']; ?><br />
                                    <?= $res[$i]['email']; ?><br />

                                </td>
                                <td>
                                    <?= $res[$i]['user_name']; ?> <br/>
                                    <?= $res[$i]['user_type']; ?><br/>
                                    <span style="color:red"> <?= user_plans($res[$i]['plan_id']); ?></span>
                                </td>
                                 <?php if($o->user_type != "Retailer"){?>
                                <td>
                                    <?= get_username_from_id($res[$i]['parent_id']); ?>
                                </td>

                                 <?php }?>
                                <td>
                                    <i class="fa fa-rupee-sign"></i> <?= $res[$i]['amount_balance']; ?>
                                </td>
                                <td>
                                    <?= $res[$i]['user_address'] . "<br />" . $res[$i]['state']; ?>
                                </td>

                                <td>
                                    <?= status($res[$i]['is_active']); ?> 
                                   
                                </td>
                                <td>
                                    <a href="team_details.php?aid=<?= $res[$i]['user_id']; ?>" ><i class="fa fa-edit  fa_approve"></i></a> 
                                   <a href="send_money.php?aid=<?= $res[$i]['user_id']; ?>" ><i class="fa fa-arrow-alt-circle-right fa_money "></i></a>  
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid>





