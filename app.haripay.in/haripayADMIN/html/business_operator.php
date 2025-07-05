<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Turnover Operator Wise</h1>
        </div>
    </div>
    <!-- DataTales Example -->
<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
        </div>
        <div class="card-body">
            <form name="search_txn" id="search_txn2" method="post"  action="business_operator.php" >
                <div class="row">
                    <div class="col-md-2">
                        <label>From</label>
                        <input type="date" class="form-control" name="from_date" id="from_date" placeholder="From Date" value="<?=$from;?>" />
                    </div>
                    <div class="col-md-2">
                        <label>To</label>
                        <input type="date" class="form-control" name="to_date" id="to_date" placeholder="To Date" value="<?=$to;?>"  />
                    </div>
                    
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <input type="submit" name="search_result" id="search_result" class="form-control btn btn-primary" value="Search Records" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <div class="col-md-12 text-left ">
                Turnover from <?=format_date_without_br($from);?> to <?=format_date_without_br($to);?>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="recharge_history">
                        <thead>
                            <tr>
                                <th>Operator</th>
                                <th>Service</th>
                                <th>Success (Qty)</th>
                                <th>Pending (Qty)</th>
                                <th>Total Amount</th>
                                <th>Total (Qty)</th>
                                <th>Failed (Qty)</th>
                                <th>Refund (Qty)</th>
                                

                            </tr>
                        </thead>
                        <?php for ($i = 0; $i < $rows; $i++) {
	?>
                            <?php
$total_success = $total_success + $data[$i]['success']['amount'] + $data[$i]['success1']['amount'] + $data[$i]['success2']['amount'];
$total_amount = $total_amount + $data[$i]['success']['total_amount'] + $data[$i]['success1']['total_amount'] + $data[$i]['success2']['total_amount'];
	$total_success_qty = $total_success_qty + $data[$i]['success']['qty'] + $data[$i]['success1']['qty'] + $data[$i]['success2']['qty'];
	$total_pending = $total_pending + $data[$i]['pending']['amount'];
	$total_pending_qty = $total_pending_qty + $data[$i]['pending']['qty'];
	$total = $total + $data[$i]['success']['amount'] + $data[$i]['success1']['amount'] + $data[$i]['success2']['amount'] + $data[$i]['pending']['amount'];
	$total_qty = $total_qty + $data[$i]['success']['qty'] + $data[$i]['success1']['qty'] + $data[$i]['success2']['qty'] + $data[$i]['pending']['qty'];
	$total_failed = $total_failed + $data[$i]['failed']['amount'];
	$total_failed_qty = $total_failed_qty + $data[$i]['failed']['qty'];
	$total_refund = $total_refund + $data[$i]['refund']['amount'];
	$total_refund_qty = $total_revenue_qty + $data[$i]['refund']['qty'];
	$total_revenue = $total_revenue + $data[$i]['revenue']['amount'];
	$total_revenue_qty = $total_revenue_qty + $data[$i]['revenue']['qty'];

	?>
                            <tr>
                                <td><?=$data[$i]['provider_name'];?></td>
                                <td><?=$data[$i]['provider_type'];?></td>
                                <td><?=($data[$i]['success']['amount'] + $data[$i]['success1']['amount'] + $data[$i]['success2']['amount']);?> (<?=($data[$i]['success']['qty'] + $data[$i]['success1']['qty'] + $data[$i]['success2']['qty']);?>)</td>
                                <td>
                                    <?php if ($data[$i]['pending']['amount'] > 0) {?>
                                        <?=$data[$i]['pending']['amount'];?> (<?=$data[$i]['pending']['qty'];?>)
                                    <?php }?>
                                </td>
<td><?=($data[$i]['success']['total_amount'] + $data[$i]['success1']['total_amount'] + $data[$i]['success2']['total_amount']);?> </td>

                                <td>
                                    <?=($data[$i]['success']['amount'] + $data[$i]['success1']['amount'] + $data[$i]['success2']['amount'] + $data[$i]['pending']['amount']);?> (<?=($data[$i]['success']['qty'] + $data[$i]['success1']['qty'] + $data[$i]['success2']['qty'] + $data[$i]['pending']['qty']);?>)
                                </td>
                                <td>
                                    <?php if ($data[$i]['failed']['amount'] > 0) {?>
                                        <?=$data[$i]['failed']['amount'];?> (<?=$data[$i]['failed']['qty'];?>)
                                    <?php }?>
                                </td>
                                <td>
                                    <?php if ($data[$i]['refund']['amount'] > 0) {?>
                                        <?=$data[$i]['refund']['amount'];?> (<?=$data[$i]['failed']['qty'];?>)
                                    <?php }?>
                                </td>
                               
                            </tr>
                        <?php }?>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th></th>
                                <th><?=$total_success;?> (<?=$total_success_qty;?>)</th>
                                <th><?=$total_pending;?> (<?=$total_pending_qty;?>)</th>
                                <th><?=$total_amount;?> </th>
                                <th><?=$total;?> (<?=$total_qty;?>)</th>
                                <th><?=$total_failed;?> (<?=$total_failed_qty;?>)</th>
                                <th><?=$total_refund;?> (<?=$total_refund_qty;?>)</th>
                                
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->