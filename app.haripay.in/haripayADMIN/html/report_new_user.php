<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">New User</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Search</h6>
        </div>
        <div class="card-body">
            <form name="search_new_user" id="search_new_user" method="post"  action="list_new_user.php" onsubmit="return false;" >
                <div class="row">
                    <div class="col-md-3">
                        <label>User Type</label>
                        <select name="user_type" id="user_type" class="form-control">
                            <option value="0">Select User Type </option>
                            <?= user_types($o1->user_type); ?>

                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>From</label>
                        <input type="date" class="form-control" name="from_date" id="from_date"  value="<?= $o1->name; ?>" required="required" />
                    </div>                
                    <div class="col-md-3">
                        <label>To</label>
                        <input type="date" class="form-control" name="to_date" id="to_date"  value="<?= $o1->user_name; ?>" required="required"  />
                    </div>
                </div>
                <div class="row top_margin_10">
                    <div class="col-md-12">
                        <input type="hidden" name="updte" id="updte" value="1" />
                        <input type="submit" name="save" id="save" value="Search" class="btn btn-primary" />
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
            <div class="row">
                <div class="col-md-12 ">
                    <div id="tabled_data">
                        <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="recharge_history">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>User detail</th>
                                    <th>User Type</th>
                                    <th>Verified</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="processing" style="display: none;" class="col-md-12 text-center">
                        <?php include "processing.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->