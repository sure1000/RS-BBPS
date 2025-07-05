<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800"><?=$o1->user_name;?> Team Members</h1>
          

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List of Members</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Username</th>
                      <th>Balance</th>
                      <th>Credit</th>
                      <th>Location</th>                      
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>S.No</th>
                      <th>Username</th>
                      <th>Balance</th>
                      <th>Credit</th>
                      <th>Location</th>                      
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php for($i=0;$i<$rows;$i++){ ?>
                      <?php $colors = user_type_colors($res[$i]['user_type']);?>
                      <tr bgcolor="<?=$colors['bgcolor'];?>" style="color:<?=$colors['color'];?>" >
                        <td><?=$i+1;?></td>
                        <td>
                          <?=$res[$i]['user_name'];?><br />
                          <?=$res[$i]['mobile'];?><br />
                          <?=$res[$i]['email'];?><br />
                          (<?=$res[$i]['user_type'];?>)
                        </td>
                        <td>
                          <i class="fa fa-rupee-sign"></i> <?=$res[$i]['amount_balance'];?>
                        </td>
                        <td>
                          <i class="fa fa-rupee-sign"></i><?=$res[$i]['credit_amount'];?>
                        </td>
                        <td>
                          <?=$res[$i]['district']."<br />".$res[$i]['state'];?>
                        </td>
                        <td>
                          <?=status($res[$i]['is_active']);?>
                        </td>
                        <td>
                          <a href="team_details.php?aid=<?=$res[$i]['user_id'];?>" style="color:<?=$colors['color'];?>"><i class="fa fa-pen-square fa-fw"></i></a> | 
                          <a href="user_kyc.php?aid=<?=$res[$i]['user_id'];?>" style="color:<?=$colors['color'];?>"><i class="fa fa-id-card"></i></a> <br />                          
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->