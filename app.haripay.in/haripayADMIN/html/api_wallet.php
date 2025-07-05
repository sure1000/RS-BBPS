<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800"><?=$o1->api_name;?> API Wallet Transactions</h1>
    </div>
    
  </div>
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Recharges</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                40,000
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Success full Recharges</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Failed Recharges</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pending Recharges</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="row">
        <div class="col-md-6">
          <h6 class="m-0 font-weight-bold text-primary">List of Transactions</h6>
        </div>
        <div class="col-md-6 text-right">
          <h6 class="m-0 font-weight-bold text-primary">Showing 1 to <?=$rows;?> of <?=$res_total[0]['total_transactions'];?></h6>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-3">
              <label>From Date</label>
              <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From Date" />
            </div>
            <div class="col-md-3">
              <label>To Date</label>
              <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
            </div>
            <div class="col-md-3">
              <label>&nbsp;</label>
              <input type="button" name="search" id="search" class="btn btn-primary form-control" value="Search" />
            </div>
            <div class="col-md-3">
              <label>&nbsp;</label>
              <input type="button" name="excel" id="excel" class="btn btn-secondary form-control" value="Export To Excel" />
            </div>
          </div>
        </div>
      </div>
      <div class="table-responsive top_margin_10">
        <table class="table table-bordered"  width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="5%">S.No</th>
              <th width="10%">Type</th>
              <th width="10%">Date</th>
              <th width="45%">Details</th>
              <th width="10%">Old Balance</th>
              <th width="10%">Amount</th>
              <th width="10%">New Balance</th>
            </tr>
          </thead>
          <tfoot>
          <tr>
            <th width="5%">S.No</th>
            <th width="10%">Type</th>
            <th width="10%">Date</th>
            <th width="45%">Details</th>
            <th width="10%">Old Balance</th>
            <th width="10%">Amount</th>
            <th width="10%">New Balance</th>
          </tr>
          </tfoot>
          <tbody>
            <?php for ($i = 0; $i < $rows; $i++) {?>
            <tr >
              <td><?=$i + 1;?></td>
              <td>
                <?=$res[$i]['transaction_type'];?>
              </td>
              <td>
                <?=$res[$i]['transaction_date'];?>
              </td>
              <td>
                <?=$res[$i]['transaction_details'];?>
              </td>
              <td>
                <i class="fa fa-rupee-sign"></i> <?=$res[$i]['api_old_balance'];?>
              </td>
              <td>
                <?php if($res[$i]['transaction_type'] != "API Top up"){ ?>
                -
                <?php } ?>
                <i class="fa fa-rupee-sign"></i> <?=$res[$i]['api_amount'];?>
              </td>
              <td>
                <i class="fa fa-rupee-sign"></i> <?=$res[$i]['api_new_balance'];?>
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->