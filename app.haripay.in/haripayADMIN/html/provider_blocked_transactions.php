<!-- Begin Page Content -->
<form action="provider_blocked_transactions.php" name="ra" id="ra" method="post">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-6">
                <h1 class="h3 mb-2 text-gray-800">Blocked Transaction(s)</h1>
            </div>
            <div class="col-md-6 text-right">
                <a class="btn btn-primary" href="block_transaction.php">Block New Transaction</a>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-9">
                        <h6 class="m-0 font-weight-bold text-primary">List of Blocked Transactions(s) for <?= $provider_name; ?>    </h6>
                    </div>
                    <div class="col-md-3">
                        <select name="provider_id" id="provider_id" class="form-control" onchange="document.ra.submit()">
                            <option value="0">All Providers</option>
                            <?=service_provider_list($o1->provider_id);?>
                        </select>   
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row pull-right" style="margin-bottom: 10px;">
                    <div class="col-md-3">
                        <label>Select Provider</label>
                        
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Provider Name</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S.No</th>
                                <th>Provider Name</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php for ($i = 0; $i < $rows; $i++) { ?>
                                <tr >
                                    <td><?= $i + 1; ?></td>
                                    <td>
                                        <?= $res[$i]['provider']; ?>
                                    </td>
                                    <td>
                                        <i class="fa fa-rupee-sign"></i> <?= $res[$i]['amount']; ?>
                                    </td>
                                    <td>
                                        <a href="block_transaction.php?aid=<?= $res[$i]['blocked_transaction_id']; ?>" ><i class="fa fa-pen-square fa-fw" title="Edit Blocked Transaction"></i></a> | 
                                        <a href="delete_blocked_transaction.php?aid=<?= $res[$i]['blocked_transaction_id']; ?>" ><i class="fa fa-times fa-fw" title="Delete Blocked Transaction"></i></a>                 
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- /.container-fluid -->