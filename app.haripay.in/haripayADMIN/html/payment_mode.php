<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Payment Mode(s)</h1>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-primary" href="payment_modes.php">Add New Payment Mode</a>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Payment Mode(s)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="color:#fff;background-color:#034ea1">
                        <tr>
                            <th>S.No</th>
                            <th width="30%">Mode</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.No</th>
                            <th width="30%">Mode</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php for ($i = 0; $i < $rows; $i++) { ?>
                            <tr >
                                <td><?= $i + 1; ?></td>
                                <td>
                                    <?= $res[$i]['payment_mode']; ?>
                                </td>
                                <td>
                                    <?= $res[$i]['account_name']."<br />".$res[$i]['account_number']."<br />".$res[$i]['ifsc_code']; ?>
                                </td>
                                <td>
                                    <?= status($res[$i]['is_active']); ?>
                                </td>
                                <td>
                                    <a href="payment_modes.php?aid=<?= $res[$i]['payment_mode_id']; ?>" ><i class="fa fa-pen-square fa-fw" title="Edit Payment Mode"></i></a> | 
                                    <a href="payment_mode_transactions.php?aid=<?= $res[$i]['payment_mode_id']; ?>" ><i class="fa fa-list fa-fw" title="Payment Mode Transactions"></i></a> 
                                    
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