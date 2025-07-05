<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Approved Wallet Top Up Requests</h1>
        </div>
    </div>
    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <div class="col-md-12 text-left ">
                List of Request Money(Approved)
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="dataTable">
                        <thead>
                            <tr style="background-color:#034ea1 !important; color:white !important; ">
                                <th>Request Date</th>
                                <th>User Details</th>
                                <th>Transaction </th>
                                <th>Amount</th>                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php for ($i = 0; $i < $rows; $i++) { ?>
                            <tr>
                                <td><?= format_date1($res[$i]['request_date']); ?></td>
                              
                                <td><?php echo $res[$i]['name']; ?> <br/><?= $res[$i]['mobile']; ?>(<?php echo $res[$i]['user_type']; ?>)</td>
                                <td><?php echo $res[$i]['transfer_mode']; ?> <br/> <?php echo $res[$i]['transaction_number']; ?></td>
                                <td><i class="fa fa-rupee-sign"></i> <?= $res[$i]['amount']; ?></td>  
                                <td>
                                   <?= $res[$i]['status']; ?>
                                </td>
                            </tr>

                        <?php } ?> 
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
