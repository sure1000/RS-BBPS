<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Report Commission Wise</h1>
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
                        <label>Operator Name</label>
                        <select name="plan_id" id="plan_id" class="form-control">
                            <option value="0">Select Operator </option>

                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Type</label>
                        <select name="plan_id" id="plan_id" class="form-control">
                            <option value="0">Select Type </option>

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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>User id</th>
                            <th>Order Id </th>
                            <th>Date</th>
                            <th>Distributor Id</th>
                            <th>Service Name</th>
                            <th>Mobile Number</th>
                            <th>Type </th>
                            <th>Amount</th>
                            <th>Commission %</th>
                            <th>System Referance</th>
                            <th>Opertor Id</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.No</th>
                            <th>User id</th>
                            <th>Order Id </th>
                            <th>Date</th>
                            <th>Distributor Id</th>
                            <th>Service Name</th>
                            <th>Mobile Number</th>
                            <th>Type </th>
                            <th>Amount</th>
                            <th>Commission %</th>
                            <th>System Referance</th>
                            <th>Opertor Id</th>

                        </tr>
                    </tfoot>
                    <tbody>
                        <?php for ($i = 0; $i < 5; $i++) { ?>

                            <tr>
                                <td><?= $i + 1; ?></td>
                                <td>Navdeep</td>
                                <td>2343453545</td>
                                <td>17th june 2019 12:00:00</td>
                                <td>Mitesh</td>
                                <td>Airtel </td>
                                <td>8283025371</td>
                                <td>Prepaid</td>
                                <td>250</td>
                                <td>3%</td>
                                <td>2345678876</td>
                                <td>dhf834783747</td>

                            </tr>
                        <?php } ?>
                    </tbody>
                    <tr class="total_amount_tr">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td>25000</td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->