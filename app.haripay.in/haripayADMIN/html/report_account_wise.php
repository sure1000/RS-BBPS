<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Account Ledger</h1>
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
                            <th>Date</th>
                            <th>Transaction Details</th>
                            <th>Withdrawal</th>
                            <th>Deposit</th>
                            <th>Running Balance</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.No</th>
                            <th>Date</th>
                            <th>Transaction Details</th>
                            <th>Withdrawal</th>
                            <th>Deposit</th>
                            <th>Running Balance</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php for ($i = 0; $i < 5; $i++) { ?>
                            <tr>
                                <td><?= $i + 1; ?></td>
                                <td>17th june 2019 12:00:00</td>
                                <td>Recharge Status : Success - Airtel - OPID23323</td>
                                <td>2033 </td>
                                <td>0</td>
                                <td>2033.00</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tr class="total_amount_tr">
                       
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td>25000</td>
                        <td>0</td>
                        <td></td>
                      

                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->