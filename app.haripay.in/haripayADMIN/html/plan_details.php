<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Plan Details</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php if ($o1->user_plan_id > 0) {?> Edit <?php } else {?> Add <?php }?> User Plan</h6>
        </div>
        <div class="card-body">
            <form name="ra" id="ra" method="post" action="plan_details.php?aid=<?=$o1->user_plan_id;?>" >
                <div class="row">
                    <div class="col-md-6">
                        <label>Plan Name</label>
                        <input type="text" class="form-control" name="plan_name" id="plan_name" placeholder="Name of the Plan" value="<?=$o1->plan_name;?>" required="required" />
                    </div>
                </div>
<!--                <div class="row">
                    <div class="col-md-3">
                        <label>Validity (in months)<small class="red"> (Leave blank for lifetime)</small></label>
                        <input type="number" class="form-control" name="validity" id="validity" placeholder="Validity in Months" value="<?=$o1->validity;?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Amount (<i class="fa fa-rupee-sign"></i>)</label>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Price of Membership" value="<?=$o1->amount;?>" step="0.1"  />
                    </div>
                </div>-->
                <div class="row">
                    <div class="col-md-6">
                        <label>Plan Type</label>
                        <select name="plan_type" id="plan_type" class="form-control">
                            <option value="Normal" <?php if ($o1->plan_type == 'Normal') {?> selected="selected" <?php }?>>Normal</option>
                            <option value="API" <?php if ($o1->plan_type == 'API') {?> selected="selected" <?php }?>>API</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1" <?php if ($o1->is_active == 1) {?> selected="selected" <?php }?>>Active</option>
                            <option value="0" <?php if ($o1->is_active == 0) {?> selected="selected" <?php }?>>Blocked</option>
                        </select>
                    </div>
                </div>
                <hr />

                <div class="row top_margin_10">
                    <div class="col-md-6">
                        <input type="hidden" name="updte" id="updte" value="1" />
                        <input type="submit" name="save" id="save" value="Save" class="btn btn-primary" />
                        <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-secondary" onclick="window.location.href='plans.php'" />

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->