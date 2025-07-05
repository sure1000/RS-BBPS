<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Complain History</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Search</h6>
        </div>
        <div class="card-body">
            <form name="" id="" method="post"  enctype="multipart/form-data" >
                <div class="row">
                
                               
                    <div class="col-md-3">
                        <label>From</label>
                        <input type="date" class="form-control" name="name" id="name" placeholder="Name of Client" value="<?= $o1->name; ?>" required="required" />
                    </div>                
                    <div class="col-md-3">
                        <label>To</label>
                        <input type="date" class="form-control" name="user_name" id="user_name" placeholder="Username of Client" value="<?= $o1->user_name; ?>" required="required"  />
                    </div>

                </div>

                <div class="row top_margin_10">
                    <div class="col-md-12">
                        <input type="hidden" name="updte" id="updte" value="1" />
                        <input type="submit" name="save" id="save" value="Save" class="btn btn-primary" />
                        <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-secondary" onclick="history.back(-1)" />

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>User detail</th>
                            <th>Complain Number</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Remarks</th>
                          
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                          <th>S.No</th>
                            <th>User detail</th>
                            <th>Complain Number</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Remarks</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php for ($i = 0; $i < 5; $i++) { ?>
                            <tr>
                                <td><?= $i + 1; ?></td>
                                <td>Navdeep Kaur <br> Email@gmail.com <br/> 9876543210</td>
                                <td>XXXXXXX</td>
                                <td>Login</td>
                                <td>17th june 2019 12:00:00</td>
                                <td>Open </td>
                                <td>dghddhsd  sdshdjs dkjd kdfjsd </td>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
             

                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->