
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Clients</h1>

    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Username</th>
                            <th>User Type</th>
                            <th>Parent</th>
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
                                <td>
                                    <?= get_username_from_id($res[$i]['parent_id']); ?>
                                </td>
                               
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
                                    <!--a href="user_kyc.php?aid=<?= $res[$i]['user_id']; ?>" style="color:<?= $colors['color']; ?>"><i class="fa fa-id-card"></i></a-->
                                    <?php if($res[$i]['user_type'] !="Retailer") { ?>
                                     <a href="user_team.php?aid=<?= $res[$i]['user_id']; ?>" ><i class="fa fa-users  fa_pending"></i></a> 
                                   
                                    <?php  } ?>
                                      <a href="send_money.php?aid=<?= $res[$i]['user_id']; ?>" ><i class="fa fa-arrow-alt-circle-right fa_money "></i></a>  
                                  
                                      <!--a href="recieve_money.php?aid=<?= $res[$i]['user_id']; ?>" style="color:<?= $colors['color']; ?>"><i class="fa fa-arrow-alt-circle-left fa-fw"></i></a-->
                                    <a href="member_dashboard.php?aid=<?= $res[$i]['user_id']; ?>" target="_blank" ><i class="fa fa-life-ring fa_reject"></i></a>
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



