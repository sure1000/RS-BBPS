<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Operator Codes</h1>
        </div>
    </div>

    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Operator Codes</h6>
        </div>
        <div class="card-body">

                <div class="row">
                   <div class="col-md-12">
                        <table class="table table-responsive-lg table-striped table-bordered" width="100%" >
                            <tr>
                                <th>Service</th>
                                <th>Operator</th>
                                <th>Code</th>
                            </tr>
                            <?php for ($i = 0; $i < $rows; $i++) {?>
                                <tr>
                                    <td><?=$res[$i]['service'];?></td>
                                    <td><?=$res[$i]['provider'];?></td>
                                    <td><?=$res[$i]['provider_id'];?></td>
                                </tr>

                            <?php }?>

                        </table>
                    </div>
                </div>

        </div>
    </div>
</div>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Operator Codes</h1>
        </div>
    </div>

    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Circle Codes</h6>
        </div>
        <div class="card-body">

                <div class="row">
                   <div class="col-md-12">
                        <table class="table table-responsive-lg table-striped table-bordered" width="100%" >
                            <tr>
                                <th>Circle</th>
                                <th>Code</th>
                            </tr>
                            <?php for ($i = 0; $i < $row_circle; $i++) {?>
                                <tr>
                                    <td><?=$res_circle[$i]['circle_name'];?></td>
                                    <td><?=$res_circle[$i]['service_circle_id'];?></td>
                                </tr>

                            <?php }?>

                        </table>
                    </div>
                </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->