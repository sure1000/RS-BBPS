<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">APIS</h1>
        </div>            
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of API(s)</h6>
        </div>
        
        <div class="card-body">
            <form name="ra" id="ra" method="post" action="api_wise_transactions.php">
                <div class="row">
                    <div class="col-md-3">
                        <label>From Date</label>
                        <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From Date" value="" />
                    </div>
                    <div class="col-md-3">
                        <label>To Date</label>
                        <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date" value="" />
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <input type="submit" name="submit" id="submit" class="btn btn-primary form-control" value="Search" />
                        <input type="hidden" name="updte" id="updte" value="1" />
                    </div>
                </div>
            </form>
            <div class="table-responsive top_margin_10">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>API</th>
                            <th>Opening Balance</th>
                            <th>Recharge Amount</th>
                            <th>Wallet Top Up</th>
                            <th>Closing Balance</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.No</th>
                            <th>API</th>
                            <th>Opening Balance</th>
                            <th>Recharge Amount</th>
                            <th>Wallet Top Up</th>
                            <th>Closing Balance</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php for ($i = 0; $i < $row_api; $i++) { ?>
                            <tr >
                                <td><?= $i + 1; ?></td>
                                <td>
                                    <?= $res_api[$i]['api_name']; ?>
                                </td>
                                <td>
                                    <i class="fa fa-rupee-sign"></i> <?= $res_api[$i]['opening_balance']; ?>
                                </td>
                                <td>
                                    <i class="fa fa-rupee-sign"></i> <?= $res_api[$i]['recharge_amount']; ?>
                                </td>
                                <td>
                                    <i class="fa fa-rupee-sign"></i> <?= $res_api[$i]['api_top_up']; ?>
                                </td>
                                <td>
                                    <i class="fa fa-rupee-sign"></i> <?= $res_api[$i]['closing_balance']; ?>
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