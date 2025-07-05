<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800"><?=$o1->api_name;?> Transactions</h1>
    </div>    
  </div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">List of Transactions</h6>
      <input type="hidden" name="api_id" id="api_id" value="<?=$o1->api_id;?>" />
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="api_transaction_list" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Date</th>
              <th>Details</th>
              <th>Cash Amount</th>
              <th>Credit Amount</th>
            </tr>
          </thead>
          <tfoot>
          <tr>
              <th>S.No</th>
              <th>Date</th>
              <th>Details</th>
              <th>Cash Amount</th>
              <th>Credit Amount</th>
          </tr>
          </tfoot>
          
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->