<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Change Password</h6>
                </div>
                <div class="card-body">
                    <div id="cpassword">
                        <form name="change_password" id="change_password" method="post" action="save_change_password.php" onsubmit="return false;">
                            <div class="row">
                                <div class="col-md-12 top_margin_10">
                                    <label><i class="fa fa-lock"></i> Old Password</label>
                                    <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Old Password" required="required" />
                                </div>
                                <div class="col-md-12 top_margin_10">
                                    <label><i class="fa fa-lock"></i> New Password</label>
                                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required="required" />
                                </div>
                                <div class="col-md-12 top_margin_10">
                                    <label><i class="fa fa-lock"></i> Confrim New Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confrim New Password" required="required" />
                                </div>
                                <div class="col-md-12 top_margin_10">
                                    <label>&nbsp;</label>
                                    <input type="hidden" name="change_passowrd_updte" id="change_passowrd_updte" value="1" />
                                    <input type="submit" name="change_passowrd_submit" id="change_passowrd_submit" class="btn btn-primary form-control btn-large" value="Submit" />
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="c_processing" style="display:none;" class="col-md-12 text-center">
                        <?php include "html/processing.php";?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>