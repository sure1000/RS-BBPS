<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Add Details</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php if ($o1->site_info_id > 0) { ?> Edit <?php } else { ?> Add <?php } ?> Team Details</h6>
        </div>
        <div class="card-body">
            <form name="whitelabel" id="whitelabel" action="add_label.php" method="post" enctype="multipart/form-data" >
                <div class="row">
                
                    <div class="col-md-4">
                        <label>Email</label>
                        <input type="text" name="email" id="email" class="form-control" required="required" value="<?= $o1->email; ?>" placeholder="Enter Email" />
                    </div>
                    <div class="col-md-4">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile" id="mobile" class="form-control" required="required" value="<?= $o1->mobile; ?>" placeholder="Enter Mobile No" />
                    </div>
                    <div class="col-md-4">
                        <label>Address</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="User Address" value="<?= $o1->loction; ?>" />
                    </div>
                    <div class="col-md-4">
                        <label>Website</label>
                        <input type="text" name="website" id="website" class="form-control" placeholder="Website Name" value="<?= $o1->site_name; ?>" />
                    </div>

                    <div class="col-md-4">
                        <label>Web url(dominname.com)</label>
                        <input type="text" name="web_url" id="web_url" class="form-control" value="<?= $o1->site_url; ?>" placeholder="Web url" />
                    </div>
                    <div class="col-md-4">
                        <label>Upload App</label>
                        <input type="file" name="app_link" id="app_link" class="form-control" placeholder="Web url" />
                    </div>
                    <div class="col-md-4">
                        <label>Upload Logo</label>
                        <input type="file" name="logo" id="logo" class="form-control"  placeholder="Web url" />
                        <?php if($o1->logo){ ?>
                            <img src="../img/<?php echo  $o1->logo;?>" width="100px;" height="100px;">
                        <?php } ?>
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
                        <input type="hidden" name="user_id" id="user_id" value="<?= $o1->site_info_id; ?>" />
                        <input type="hidden" name="updte" id="updte" value="1" />
                        <input type="hidden" name="aid" id="aid" value="<?php echo $_GET['aid']; ?>" />
                        <input type="submit" name="save" id="save2" value="Save" class="btn btn-primary" />
                        <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-secondary" onclick="history.back(-1)" />

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
