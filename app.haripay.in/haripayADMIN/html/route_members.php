<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Route For Members</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Routing Algorithm For Member(s)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>User</th>
                            <th>Api</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $rows; $i++) {?>
                            <tr >
                                <td>
                                    <?=$res[$i]['user_name'];?>
                                </td>
                                <td>
                                    <?=$res[$i]['name'];?>
                                </td>
                                <td>
                                    <?php if ($res[$i]['api_name'] == "") {?>
                                        Any
                                    <?php } else {?>
                                        <?=$res[$i]['api_name'];?>
                                    <?php }?>

                                </td>
                                <td>
                                    <a href="route_member_details.php?aid=<?=$res[$i]['user_id'];?>" ><i class="fa fa-pen-square fa-fw" title="Edit Route"></i></a>
                                </td>
                            </tr>
                        <?php }?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->