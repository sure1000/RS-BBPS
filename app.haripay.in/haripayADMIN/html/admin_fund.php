<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Fund Transfer</h1>
        </div>            
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Fund Transfer</h6>
        </div>
        
        <div class="card-body">
        
            <div class="table-responsive top_margin_10">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Admin detail</th>
                            <th>User Details</th>
                            <th>Ref. Number</th>
                            <th>User Old Balance</th>
                            <th>Amount</th>
                            <th>User New Balance</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                  
                    <tbody>
                        <?php for ($i = 0; $i < $row_wallet; $i++) { ?>
                            <tr >
                                <td><?= ($i+1) ?></td>
                                
                                <td> <?= format_date($res_wallet[$i]['transaction_date']); ?></td>
                                <td> <?= ($res_wallet[$i]['user_1_name']); ?></td>
                                <td> <?= ($res_wallet[$i]['user_name']); ?></td>
                                <td> <?= ($res_wallet[$i]['ref_number']); ?></td>
                                <td> <?= ($res_wallet[$i]['user_old_balance']); ?></td>
                                <td> <?= ($res_wallet[$i]['amount']); ?></td>
                                <td> <?= ($res_wallet[$i]['user_new_balance']); ?></td>
                                <td>  <?php if($res_wallet[$i]['transaction_type'] == "Recieve Money" && $res_wallet[$i]['send_type'] == "Admin"){?>
                                    <span class="green"> Send Money </span> <br/><small> <?= $res_wallet[$i]['user_1_name']?> has send Rs. <?= $res_wallet[$i]['amount']; ?> to <?= ($res_wallet[$i]['user_name']); ?> </small>
                                <?php } else if($res_wallet[$i]['transaction_type'] == "Reverse" && $res_wallet[$i]['send_type'] == "Admin"){?>
                                    <span class="red">   Reverse Money </span> <br/><small> <?= $res_wallet[$i]['user_1_name']?> has reversed Rs. <?= $res_wallet[$i]['amount']; ?> from <?= ($res_wallet[$i]['user_name']); ?> </small>
                                <?php } else if($res_wallet[$i]['transaction_type'] == "Recieve Money" && $res_wallet[$i]['send_type'] != "Admin"){?>
                                    Send Money <small>(Request Money)</small>
                                <?php }   ?>

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