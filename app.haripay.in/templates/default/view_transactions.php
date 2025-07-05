<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800"><?=get_service_name($_SESSION['search']['service_id']);?> <?=$_SESSION['search']['transaction_type'];?> Transactions
                <?php if (isset($_SESSION['search']['status'])) {?>
                    (<?=$_SESSION['search']['status'];?>)
                <?php }?>
            </h1>
        </div>

    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <div class="col-md-6 text-left ">
                From <b><?=format_date_without_br($_SESSION['search']['from_date']);?></b> To <b><?=format_date_without_br($_SESSION['search']['to_date']);?></b>
            </div>
            <div class="col-md-6 text-right">
                <b>Total Amount: <i class="fa fa-rupee-sign"></i> <?=$res_total[0]['amount'];?></b>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="recharge_history">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Transaction Details</th>
                                <th>Old Amount</th>
                                <th>Amount</th>
                                <th>New Amount</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->