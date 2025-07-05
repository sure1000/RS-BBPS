<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Turnover Service Wise</h1>
        </div>
    </div>
    <!-- DataTales Example -->

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
                                <th>Service</th>
                                <th>Success (Qty)</th>
                                <th>Pending (Qty)</th>
                                <th>Total (Qty)</th>
                                <th>Failed (Qty)</th>
                                <th>Refund (Qty)</th>
                                <th>Revenue (Qty)</th>

                            </tr>
                        </thead>
                        <?php for ($i = 0; $i < $rows; $i++) {
	?>

                            <?php
$total_success = $total_success + $data[$i]['success']['amount'] + $data[$i]['success1']['amount'] + $data[$i]['success2']['amount'];
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
                                <td><?=$data[$i]['provider_type'];?></td>
                                <td><?=($data[$i]['success']['amount'] + $data[$i]['success1']['amount'] + $data[$i]['success2']['amount']);?> (<?=($data[$i]['success']['qty'] + $data[$i]['success1']['qty'] + $data[$i]['success2']['qty']);?>)</td>
                                <td>
                                    <?php if ($data[$i]['pending']['amount'] > 0) {?>
                                        <?=$data[$i]['pending']['amount'];?> (<?=$data[$i]['pending']['qty'];?>)
                                    <?php }?>
                                </td>
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
                                <td>
                                    <?php if ($data[$i]['revenue']['amount'] > 0) {?>
                                        <?=round($data[$i]['revenue']['amount'], 2);?> (<?=$data[$i]['revenue']['qty'];?>)
                                    <?php }?>
                                </td>
                            </tr>
                        <?php }?>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th><?=$total_success;?> (<?=$total_success_qty;?>)</th>
                                <th><?=$total_pending;?> (<?=$total_pending_qty;?>)</th>
                                <th><?=$total;?> (<?=$total_qty;?>)</th>
                                <th><?=$total_failed;?> (<?=$total_failed_qty;?>)</th>
                                <th><?=$total_refund;?> (<?=$total_refund_qty;?>)</th>
                                <th><?=$total_revenue;?> (<?=$total_revenue_qty;?>)</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->