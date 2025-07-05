<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"> <?= $mtype ?> List</h1>

    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="color:#fff;background-color:#034ea1">
                        <tr>
                            <th>S.No</th>
                            <th>Username</th>
                            <th>User Type</th>
                            <th>Parent</th>
                            <th>Balance</th>
                            <th>Location</th>
                            <?php if($mtype == 'Retailer' ||$mtype == 'All'){ ?>
                            <th>User Pin</th>
                        <?php } ?>
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
                                <?php if($mtype == 'Retailer' ||$mtype == 'All'){ ?>
                                    <?php if($res[$i]['user_type'] == 'Retailer'){?>
                                  <td> <?= $res[$i]['kyc_id']  ?></td>
                              <?php }else{?>
                                  <td></td>
                              <?php } ?>
                              <?php } ?>
                                <td>
                                    <?= status($res[$i]['is_active']); ?> 

                                </td>
                                <td>
                                    <a href="team_details.php?aid=<?= $res[$i]['user_id']; ?>" ><i class="fa fa-edit  fa_approve"></i></a> 
                                    <?php if ($res[$i]['user_type'] != "Retailer") { ?>
                                        <a href="user_team.php?aid=<?= $res[$i]['user_id']; ?>" ><i class="fa fa-users  fa_pending"></i></a> 

                                    <?php } ?>
                                    <?php if ($res[$i]['user_type'] == "Retailer") { ?>
                                        <a onclick="user_rights(<?= $res[$i]['user_id']; ?>)" title="User Service"><i class="fas fa-fw fa-cog fa_settings" ></i></a> 

                                    <?php } ?>
                                    <?php if ($res[$i]['user_type'] != "Admin") { ?>
                                        <a href="send_money.php?aid=<?= $res[$i]['user_id']; ?>" ><i class="fa fa-arrow-alt-circle-right fa_money "></i></a>  
                                        <a href="member_dashboard.php?aid=<?= $res[$i]['user_id']; ?>" target="_blank" ><i class="fa fa-life-ring fa_reject"></i></a>

                                    <?php } ?>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 <div id="user_rights_status" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         <h4 class="modal-title">Manage User Rights</h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>

       </div>
       <form  id="update_status" method="POST" class="form-horizontal form-label-left input_mask" onsubmit="return false">

         <div class="modal-body">
           <div class="row" id="user_service_rights">

            <?php

            for($i=0;$i<$rows_services;$i++) { ?>
             <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <span> <?= $res_services[$i]['service_name']?> </span>
                </div> 
                <div class="col-md-6">
                  <label class="switch">
                    <input type="checkbox" name="status_<?php echo $i?>" id="status_<?php echo $i?>" value="Yes" 
                    onclick="save_user_rights($res_services[$i]['service_id'],$i,$res[$i]['user_id'])">
                    <span class="slider round span_margin">Yes</span>
                  </label>

                </div>
            <!-- <input type="hidden" name="loop_id" id="loop_id" value="<?= $i?>">
            <input type="hidden" name="service_id" id="service_id" value="<?= $res_services[$i]['service_id']?>">
            <input type="hidden" name="user_id" id="user_id" value="<?= $res[$i]['user_id'] ?>" /> -->

          </div>
        </div>
      <?php } ?>
      
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    <button type="submit" class="btn btn-primary">Save</button>
    <input type="hidden" name="updte" id="updte" value="1" />

  </div>
</form>

</div>

</div>
</div>
</div>
 <!-- /.container-fluid -->
  <!--   <div class="modal fade " id="plan_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Services Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="service_plan_id">
                
            </div>
            <div class="modal-footer">
                <input type="hidden" name="user_id" id="user_id" value='0'>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>                
            </div>
        </div>
    </div>
</div> -->