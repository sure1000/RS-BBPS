<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">User Balance</h1>
    </div>
  </div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">List of Active User(s)</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.No</th>
              <th>User</th>
              <th>Balance</th>
              <th>Credit</th>
            </tr>
          </thead>
          <tbody>
            <?php for ($i = 0; $i < $rows; $i++) {
	$total = $total + $res[$i]['amount_balance'];
	$total_credit = $total_credit + $res[$i]['credit_amount'];?>
            <tr >
              <td><?=$i + 1;?></td>
              <td>
                <?=$res[$i]['name'];?><br />
                <?=$res[$i]['user_name'];?><br />
                <?=$res[$i]['user_type'];?>
              </td>
              <td>
                <i class="fa fa-rupee-sign"></i> <?=$res[$i]['amount_balance'];?>
              </td>
              <td>
                <i class="fa fa-rupee-sign"></i> <?=$res[$i]['credit_amount'];?>
              </td>
            </tr>
            <?php }?>
            <tfoot>
            <tr>
              <th colspan="2">Total</th>
              <th ><i class="fa fa-rupee-sign"></i> <?=$total;?></th>
              <th ><i class="fa fa-rupee-sign"></i> <?=$total_credit;?></th>
            </tr>
          </tfoot>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->