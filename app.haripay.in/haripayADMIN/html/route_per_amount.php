<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Operators / Providers</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Routes Per Amount</h6>
        </div>

        <div class="card-body">
            <div class="row top_margin_10">
                <div class="col-md-12 text-right">
                    <input type="button" name="add_route" id="add_route" class="btn btn-primary" value="Add New Amount Route" onclick="open_modal(0, 0, 0, 0)" />
                </div>
            </div>
            <div class="table-responsive top_margin_10">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Amount From</th>
                            <th>Amount To</th>
                            <th >Route</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.No</th>
                            <th>Amount From</th>
                            <th>Amount To</th>
                            <th>Route</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php for ($i = 0; $i < $rows; $i++) { ?>
                            <tr >
                                <td><?= $i + 1; ?></td>
                                <td><i class="fa fa-rupee-sign"></i> <?= $res[$i]['amount_from']; ?></td>
                                <td><i class="fa fa-rupee-sign"></i> <?= $res[$i]['amount_to']; ?></td>
                                <td><?= $res[$i]['api_name']; ?></td>
                                <td><a href="#" onclick="open_modal('<?= $res[$i]['route_detail_id']; ?>', '<?= $res[$i]['amount_from']; ?>', '<?= $res[$i]['amount_to']; ?>', '<?= $res[$i]['api_id']; ?>')"><i class="fa fa-edit"></i> | 
                                 <a href="delete_route.php?aid=<?= $res[$i]['route_detail_id'];?>&type=amount"><i class="fa fa-times"></i></a></td>
                           
</tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal large fade" id="amountMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Route Per Amount</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="member_service" id="member_service" method="post" action = "route_per_amount_save.php" onsubmit="return check_values();">
                    <div class="row">
                        <div class="col-md-3">
                            <label>From Amount</label>
                            <input type="number" name="amount_from" id="amount_from" class="form-control" value="" step="0.01" placeholder="From Amount " />
                        </div>
                        <div class="col-md-3">
                            <label>To Amount</label>
                            <input type="number" name="amount_to" id="amount_to" class="form-control" value="" step="0.01" placeholder="To Amount / For Single amount leave it blank"  />
                        </div>
                        <div class="col-md-3">
                            <label>Select Api</label>
                            <select name="api_id" id="api_id" class="form-control">
                                <option value="0">Any Api</option>
                                <?= api_list(0); ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>&nbsp;</label>
                            <input type="hidden" name="updte" id="updte" value="1" />
                            <input type="hidden" name="user_id" id="user_id" value="<?= $o1->user_id; ?>" />
                            <input type="hidden" name="route_detail_id" id="route_detail_id" value="0" />
                            <input type="submit" name="save" id="save" value="Save Route" class="btn btn-primary form-control" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->