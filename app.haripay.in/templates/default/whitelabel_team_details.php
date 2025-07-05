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
            <form name="whitelabel" id="whitelabel" method="post" action="addwhite_label.php" enctype="multipart/form-data" >
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
                        <input type="text" name="address" id="address" class="form-control" placeholder="User Address" value="<?= $o1->address; ?>" />
                    </div>

                    <div class="col-md-4">
                        <label>website</label>
                        <input type="text" name="website" id="website" class="form-control" placeholder="Website Name" value="<?= $o1->website; ?>" />
                    </div>

                    <div class="col-md-4">
                        <label>weburl</label>
                        <input type="text" name="web_url" id="web_url" class="form-control" value="<?= $o1->web_url; ?>" placeholder="Web url" />
                    </div>

                    <div class="col-md-4">
                        <label>Color Combination</label>
                           <select name="color_combinations" id="color_combinations" class="form-control" required="required" >
                            <option value="" <?php {?>selected="selected" <?php }?> >Select Color Combination</option>
                            <?=color_combinations($o1->color_combinations);?>
                        </select>
                    </div>
<!--                    <div class="col-md-4">
                        <label>Status</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1" <?php if ($o1->is_active == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if ($o1->is_active == 0) { ?> selected="selected" <?php } ?>>Blocked</option>
                        </select>
                    </div>-->
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
