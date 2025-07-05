<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Payment Modes</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php if ($o1->payment_mode_id > 0) { ?> Edit <?php } else { ?> Add <?php } ?> Payment Mode(s)</h6>
        </div>
        <div class="card-body">
            <form name="ra" id="ra" method="post" action="payment_modes.php?aid=<?= $o1->payment_mode_id; ?>" enctype= multipart/form-data>
                <div class="row">
                    <div class="col-md-6">
                        <label>Payment Mode</label>
                        <input type="text" class="form-control" name="payment_mode" id="payment_mode" placeholder="Name of Payment Mode" value="<?= $o1->payment_mode; ?>" required="required" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Account Name</label>
                        <input type="text" name="account_name" id="account_name" class="form-control" value="<?=$o1->account_name;?>" placeholder="Account Name" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Account Number</label>
                        <input type="text" name="account_number" id="account_number" class="form-control" value="<?=$o1->account_number;?>" placeholder="Account Number" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>IFSC Code</label>
                        <input type="text" name="ifsc_code" id="ifsc_code" class="form-control" value="<?=$o1->ifsc_code;?>" placeholder="IFSC Code" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Logo</label>
                        <input type="file" name="logo" id="logo" class="form-control" placeholder="Select Logo" />
                    </div>
                </div>
                <?php if($o1->logo != ""){ ?>
                <div class="row">
                    <div class="col-md-6">
                        <img src="../provider_logos/<?=$o1->logo;?>" class="img-rounded" style="width:100px;" alt="Payment Logo Detail" />
                    </div>
                </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1" <?php if ($o1->is_active == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if ($o1->is_active == 0) { ?> selected="selected" <?php } ?>>Blocked</option>
                        </select>
                    </div>
                </div>
                <div class="row top_margin_10">
                    <div class="col-md-6">
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