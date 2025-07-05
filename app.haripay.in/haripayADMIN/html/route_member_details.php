<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800"> Route Preference Members</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Route Selection</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 text-right">
                    <input type="button" name="new_route" id="new_route" class="btn btn-primary" value="New Route" />
                </div>
            </div>
            <form name="ra" id="ra" method="post" action="route_members_details.php" onsubmit="return check_priority();"  >
                <div class="row top_margin_10">
                    <div class="col-md-12">
                        <table width="100%" cellpadding="2" cellspacing="2" border="0" class="table table-bordered table-stripped">
                            <tr>
                                <th>Service</th>
                                <th>Provider</th>
                                <th>Amount Check</th>
                                <th>Api</th>
                                <th width="10%">Priority</th>
                                <th>Action</th>
                            </tr>
                            <?php for ($i = 0; $i < $row_routes; $i++) {?>
                                <tr>
                                    <td><?=$res_routes[$i]['service_name'];?></td>
                                    <td><?=$res_routes[$i]['provider'];?></td>
                                    <td>
                                        <?=$res_routes[$i]['amount_check'];?>
                                        <?php if ($res_routes[$i]['amount_check'] == "Yes") {?>
                                            <br />
                                            <i class="fa fa-rupee-sign"></i> <?=$res_routes[$i]['amount_from'];?>
                                            <?php if ($res_routes[$i]['amount_to'] > 0) {?>
                                                 - <i class="fa fa-rupee-sign"></i> <?=$res_routes[$i]['amount_to'];?>
                                            <?php }?>
                                        <?php }?>
                                    </td>
                                    <td><?=$res_routes[$i]['api_name'];?></td>
                                    <td>
                                        <?php if ($res_routes[$i]['route_detail_id'] > 0) {?>
                                            <input type="number" name="priority_<?=$res_routes[$i]['route_detail_id'];?>" id="priority_<?=$i;?>" class="form-control" value = "<?=$res_routes[$i]['priority'];?>" />
                                        <?php } else {?>
                                            0
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php if ($res_routes[$i]['route_detail_id'] > 0) {?>
                                            <a href="#" onclick="select_route('<?=$res_routes[$i]['route_detail_id'];?>')"><i class="fa fa-edit"></i></a> |
                                            <a href="delete_route.php?aid=<?=$res_routes[$i]['route_detail_id'];?>"><i class="fa fa-times"></i></a>
                                        <?php } else {?>
                                            N/a
                                        <?php }?>
                                    </td>
                                </tr>
                            <?php }?>
                        </table>
                    </div>
                    <div class="col-md-12 text-right">
                        <input type="hidden" name="updte1" id="updte1" value="1" />
                        <input type="hidden" name="total_routes" id="total_routes" value="<?=$row_routes;?>" />
                        <input type="hidden" name="user_id" id="user_id" value="<?=$o1->user_id;?>" />
                        <input type="submit" name="save_priority" id="save_priority" class="btn btn-primary" value="Update Priority" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal large fade" id="serviceMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Route Plans</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="member_service" id="member_service" method="post" action = "route_services.php" onsubmit="return check_values();">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Select Service</label>
                            <select name="service_id" id="service_id" class="form-control">
                                <option value="0">All Services</option>
                                <?=service_list(0);?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Select Provider</label>
                            <div id="provider_list">
                                <select name="provider_id" id="provider_id" class="form-control" disabled="disabled">
                                    <option value="0">All Providers</option>
                                    <?=get_provider_list_by_service(0, 0);?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label>Select Amount</label>
                            <select name="amount_check" id="amount_check" class="form-control">
                                <option value="No">Any Amount</option>
                                <option value="Yes">Specific Amount</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Select Api</label>
                            <select name="api_id" id="api_id" class="form-control">
                                <option value="0">Any Api</option>
                                <?=api_list(0);?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>From Amount</label>
                            <input type="number" name="amount_from" id="amount_from" class="form-control" value="" step="0.01" placeholder="From Amount " disabled="disabled" />
                        </div>
                        <div class="col-md-4">
                            <label>To Amount</label>
                            <input type="number" name="amount_to" id="amount_to" class="form-control" value="" step="0.01" placeholder="To Amount / For Single amount leave it blank" disabled="disabled" />
                        </div>
                        <div class="col-md-4">
                            <label>&nbsp;</label>
                            <input type="hidden" name="updte" id="updte" value="1" />
                            <input type="hidden" name="user_id" id="user_id" value="<?=$o1->user_id;?>" />
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