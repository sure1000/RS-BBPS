<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">APIS</h1>
        </div>
        <div class="col-md-6 text-right">
<!--            <a class="btn btn-primary" href="api_wise_transactions.php">API Wise Transactions</a>-->
            <a class="btn btn-primary" href="api_details.php">Add New API</a>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of API(s)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="apiTABLE" width="100%" cellspacing="0">
                    <thead style="color:#fff;background-color:#034ea1">
                        <tr>
                            <th>S.No</th>
                            <th>API</th>
                            <th>Balance</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $rows; $i++) {
                            $total = $total + $res[$i]['api_balance']; ?>
                            <tr >
                                <td><?= $i + 1; ?></td>
                                <td>
                                    <?= $res[$i]['api_name']; ?>
                                </td>
                                <td>
                                    <i class="fa fa-rupee-sign"></i> <?= $res[$i]['api_balance']; ?>
                                </td>
                                <td>
                                    <?= status($res[$i]['is_active']); ?>
                                </td>
                                <td>
                                    <a href="api_details.php?aid=<?= $res[$i]['api_id']; ?>" ><i class="fa fa-pen-square fa-fw" title="Edit API"></i></a> |
                                    <a href="api_update_money.php?aid=<?= $res[$i]['api_id']; ?>" ><i class="fa fa-piggy-bank fa-fw" title="Update API Wallet"></i></a> |
                                  <!--   <a href="api_transactions.php?aid=<?= $res[$i]['api_id']; ?>" ><i class="fa fa-list fa-fw" title="API Provider Transactions"></i></a>| --> 
                                  <!--   <a href="api_wallet.php?api_id=<?= $res[$i]['api_id']; ?>" ><i class="fa fa-server fa-fw" title="API Transactions"></i></a> | -->
                                    <a href="api_plans.php?api_id=<?= $res[$i]['api_id']; ?>" ><i class="fas fa-tasks fa-fw" title="API Plans"></i></a> |
                                    <a href="api_provider_code.php?api_id=<?= $res[$i]['api_id']; ?>" ><i class="fas fa-plug fa-fw" title="API Provider Codes"></i></a> |
                                    <a href="api_circle_code.php?api_id=<?= $res[$i]['api_id']; ?>" ><i class="fas fa fa-globe fa-fw" title="API Circle Codes"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    <tfoot>
                        <tr>
                            <th colspan="2">Total</th>
                            <th colspan="3"><i class="fa fa-rupee-sign"></i> <?= $total; ?></th>
                        </tr>
                    </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->