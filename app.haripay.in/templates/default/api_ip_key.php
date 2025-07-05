<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">KEY & IP Configuration for API's</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">5 IP ADDRESS Are Only Allowed</h6>
        </div>
        <div class="card-body">
            <form name="rapp" id="rapp" method="post"  action="api_ip_key.php">
                <div class="row">
                    <?php if ($rows < 5) {?>
                        <div class="col-md-3">
                            <label>IP Address</label>
                            <input type="text" name="ip_address" id="ip_address" class="form-control" value="" placeholder="Enter IP Address" />
                        </div>
                        <div class="col-md-3">
                            <label>&nbsp;</label>
                            <input type="submit" name="generat_key" id="generat_key" class="btn btn-primary form-control" value="Generate Key"  />
                            <input type="hidden" name="updte" id="updte" value="1" />
                        </div>
                    <?php } else {?>
                        <div class="col-md-12 text-danger">
                            You Are Using All 5 IP Addresses. You Can Delete Any 1 To Add Another One
                        </div>
                    <?php }?>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">IP & KEY DETAILS</h6>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                         <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="recharge_history">
                            <tr>
                                <th>IP ADDRESS</th>
                                <th>KEY</th>
                                <th>Action</th>
                            </tr>
                            <?php for ($i = 0; $i < $rows; $i++) {?>
                                <tr>
                                    <td><?=$res[$i]['ip_address'];?></td>
                                    <td><?=$res[$i]['authorization_key'];?></td>
                                    <td>
                                        <a href="api_update_key.php?aid=<?=$res[$i]['api_ip_key_id'];?>"><i class="fa fa-pen-square" title="Regenerate Key"></i></a>
                                        <a href="api_ip_key_delete.php?aid=<?=$res[$i]['api_ip_key_id'];?>"><i class="fa fa-times" title="Delete Key" />
                                    </td>
                                </tr>
                            <?php }?>
                         </table>
                    </div>
                </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->