<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Add Teams</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php if ($o1->user_id > 0) { ?> Edit <?php } else { ?> Add <?php } ?> Team Details</h6>
        </div>
        <div class="card-body">
            <form name="ra" id="ra" method="post" action="team_details.php?aid=<?= $o1->user_id; ?>" enctype="multipart/form-data" >
                <div class="row">
                    <div class="col-md-4">
                        <label>Name of Client</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name of Client" value="<?= $o1->name; ?>" required="required" />
                    </div>

                    <div class="col-md-4">
                        <label>Email</label>
                        <input type="text" name="email" id="email" class="form-control" required="required" value="<?= $o1->email; ?>" placeholder="Enter Email" />
                    </div>
                    <div class="col-md-4">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile" id="mobile" class="form-control" required="required" value="<?= $o1->mobile; ?>" placeholder="Enter Mobile No" />
                    </div>

                    <div class="col-md-4">
                        <label>Password</label>
                        <?php if ($o1->user_id > 0) { ?>
                            <input type="button" name="change_password" id="change_password" class="btn btn-primary form-control" value="Change Password" onclick="change_password()" />
                        <?php } else { ?>
                            <input type="text" name="password" required="" minlength="6"id="password" class="form-control" value="<?= substr(md5(rand(1000, 10000)), 0, 8); ?>" />
                        <?php } ?>
                    </div>
                    <div class="col-md-4">
                        <label>Address</label>
                        <input type="text" name="user_address" id="user_address" class="form-control" placeholder="User Address" value="<?= $o1->user_address; ?>" />
                    </div>

                    <div class="col-md-4">
                        <label>Shop Name</label>
                        <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Shop Name" value="<?= $o1->company_name; ?>" />
                    </div>

                    <div class="col-md-4">
                        <label>GST</label>
                        <input type="text" name="gst_no" id="gst_no" class="form-control" value="<?= $o1->gst_no; ?>" placeholder="GST Number" />
                    </div>
                    <div class="col-md-4">
                        <label>Pancard</label>
                        <input type="text" name="pancard" id="pancard" class="form-control" value="<?= $o1->pancard; ?>" placeholder="Pancard Number" />
                    </div>
                    <div class="col-md-4">
                        <label>Adhaar Card</label>
                        <input type="text" name="adhaar_card" id="adhaar_card" class="form-control" value="<?= $o1->adhaar_card; ?>" placeholder="Adhaar Card Number" />
                    </div>
                    <div class="col-md-4">
                        <label>User Type</label>
                        <select name="user_type" id="user_type" class="form-control" required="required">
                            <option value="">Select User Type</option>
                            <?php if ($o->user_type == "White Label") { ?>
                                <option value = "Master Distributor" <?php if ($o1->user_type == "Master Distributor") { ?> selected <?php } ?>>Master Distributor</option>
                            <?php } ?>
                            <?php if ($o->user_type == "Master Distributor") { ?>
                                <option value = "Distributor" <?php if ($o1->user_type == "Distributor") { ?> selected <?php } ?>>Distributor</option>
                            <?php } ?>
                            <?php if ($o->user_type == "Distributor") { ?>
                                <option value = "Retailer" <?php if ($o1->user_type == "Retailer") { ?> selected <?php } ?>>Retailer</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Status</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1" <?php if ($o1->is_active == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if ($o1->is_active == 0) { ?> selected="selected" <?php } ?>>Blocked</option>
                        </select>
                    </div>
                </div>
                <div class="row top_margin_10">
                    <div class="col-md-12">
                        <input type="hidden" name="user_id" id="user_id" value="<?= $o1->user_id; ?>" />
                        <input type="hidden" name="updte" id="updte" value="1" />
                        <input type="submit" name="save" id="save" value="Save" class="btn btn-primary" />
                        <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-secondary" onclick="history.back(-1)" />

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->