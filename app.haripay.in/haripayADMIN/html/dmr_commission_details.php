<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Commission Details</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php if ($o1->user_id > 0) { ?> Edit <?php } else { ?> Add <?php } ?> Commission Details</h6>
        </div>
        <div class="card-body">
            <form name="ra" id="ra" method="post" enctype="multipart/form-data" onsubmit="return false">

                <div class="row">
                    <div class="col-md-4">
                        <label>Start Amount</label>
                        <input type="text" class="form-control" name="start_amount" id="name" placeholder="Start Amount" value="<?= $o1->start_amount ?>" required="required" />
                    </div>
                    <div class="col-md-4">
                        <label>End Amount</label>
                        <input type="text" class="form-control" name="end_amount" id="name" placeholder="End Amount" value="<?= $o1->end_amount ?>" required="required" />
                    </div>


                    <div class="col-md-4">
                        <label>DMR Type</label>
                        <select name="dmr_type" id="dmr_type" class="form-control" required="required">
                            <option value=" ">Select Type</option>
                            <option value="Instant Pay" <?php if ($o1->dmr_type == 'Instant Pay') { ?> selected <?php } ?> >Instant Pay</option>
                            <option value="Recharge Pay" <?php if ($o1->dmr_type == 'Recharge Pay') { ?> selected <?php } ?> >Recharge Pay</option>
                            <option value="Recharge Pay" <?php if ($o1->dmr_type == 'Electricity') { ?> selected <?php } ?> >Electricity</option>
                        </select>
                    </div>
                     <div class="col-md-4">
                        <label>User Plan</label>
                        <select name="plan_id" id="plan_id" class="form-control" required="required">
                            <option value=" ">Select Plan</option>
                            <?=user_plans_dropdown($o1->plan_id) ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Commission Value</label>
                        <input type="number" name="commission_value" id="commission_value" class="form-control" required="required" step="0.01" value="<?= $o1->commission_value ?>" placeholder="Commission Value Value" />
                    </div> 

                    <div class="col-md-4">
                        <label>Status</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1" <?php if ($o1->is_active == 1) { ?> selected <?php } ?>>Active</option>
                            <option value="0" <?php if ($o1->is_active == 1) { ?> selected <?php } ?> >Blocked</option>
                        </select>
                    </div>

                </div>

                <div class="row top_margin_10">
                    <div class="col-md-12">
                        <input type="hidden" name="dmr_commission_id" id="dmr_commission_id" value="<?= $o1->dmr_commission_id; ?>" />
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