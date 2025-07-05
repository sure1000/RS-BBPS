<!-- Begin Page Content -->
<form name="rap" id="rap" method="post" action="routes.php" onsubmit="return check_priority()">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-md-6">
                <h1 class="h3 mb-2 text-gray-800">Recharge Route Priority</h1>
            </div>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Routing List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="apiTABLE" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Route Type</th>
                                <th>Route For</th>
                                <th>Api 1</th>
                                <th>Api 2</th>
                                <th>Api 3</th>
                                <th>Priority</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < $rows; $i++) {?>
                            <tr >
                                <td><?=$i + 1;?></td>
                                <td>
                                    <?=$res[$i]['route_type'];?>
                                </td>
                                <td>
                                    <select name="route_for_<?=$res[$i]['route_id'];?>" id="route_for_<?=$i;?>" class="form-control" required="required">
                                        <option value="All" <?php if ($res[$i]['route_for'] == "All") {?> selected = "selected" <?php }?>>All</option>
                                        <option value="Specific" <?php if ($res[$i]['route_for'] == "Specific") {?> selected = "selected" <?php }?>>Specific</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="api_id_1_<?=$res[$i]['route_id'];?>" id="api_id_1_<?=$i;?>" class="form-control" required="required">
                                        <?=api_list($res[$i]['api_1']);?>
                                    </select>
                                </td>
                                <td>
                                    <select name="api_id_2_<?=$res[$i]['route_id'];?>" id="api_id_2_<?=$i;?>" class="form-control" required="required">
                                        <?=api_list($res[$i]['api_2']);?>
                                    </select>
                                </td>
                                <td>
                                    <select name="api_id_3_<?=$res[$i]['route_id'];?>" id="api_id_2_<?=$i;?>" class="form-control" required="required">
                                        <?=api_list($res[$i]['api_3']);?>
                                    </select>
                                </td>
                                <td>
                                    <select name="priority_<?=$res[$i]['route_id'];?>" id="priority_<?=$i;?>" required="required" class="form-control" >
                                        <?php for ($j = 1; $j < 6; $j++) {?>
                                        <option value="<?=$j;?>" <?php if ($j == $res[$i]['priority']) {?> selected = "selected" <?php }?>><?=$j;?></option>
                                        <?php }?>
                                    </select>
                                    <input type="hidden" name="route_id_<?=$i;?>" id="route_id_<?=$i;?>" value="<?=$res[$i]['route_id'];?>" />
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <input type="hidden" name="updte" id="updte" value="1" />
                        <input type="button" name="back" id="back" class="btn btn-secondary" value="Back" onclick = "history.back(-1)" />
                        <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- /.container-fluid -->