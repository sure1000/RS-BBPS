<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Operator history</h1>
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
                        <label>Api Name</label>
                        <select name="plan_id" id="plan_id" class="form-control">
                            <option value="0">Select Operator </option>

                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Status</label>
                        <select name="plan_id" id="plan_id" class="form-control">
                            <option value="0">Select Status </option>

                        </select>
                    </div>

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
                <table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
                    <thead style="color:#fff;background-color:#034ea1">
                        <tr>
                            <th>S.No</th>
                            <th>Operator Name</th>
                            <th>success</th>
                            <th>Failed</th>
                            <th>Pending</th>
                            <th>Total</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                              <th>S.No</th>
                            <th>Operator Name</th>
                            <th>success</th>
                            <th>Failed</th>
                            <th>Pending</th>
                            <th>Total</th>


                        </tr>
                    </tfoot>
                    <tbody>
                       
                            <tr>
                                <td>1</td>
                                <td>Airtel(Prepaid)</td>
                                <td>50</td>
                                <td>30</td>
                                <td>10</td>
                                <td>20</td><br/>
                                    
                            </tr>
                        
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->