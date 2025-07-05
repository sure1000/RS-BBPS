<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Route Details</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php if ($o1->route_id > 0) {?> Edit <?php } else {?> Add <?php }?> Route Details</h6>
        </div>
        <div class="card-body">
            <form name="ra" id="ra" method="post" action="provider_details.php?aid=<?=$o1->provider_id;?>" enctype= multipart/form-data>
                <div class="row">
                    <div class="col-md-3">
                        <label>Route Type</label>
                        <select name="route_type" id="route_type" class="form-control" required="required">
                            <option value="">Select Route Type</option>
                            <option value="Amount" <?php if ($o1->route_type == "Amount") {?> selected = "selected" <?php }?>>Amount</option>
                            <option value="Member" <?php if ($o1->route_type == "Member") {?> selected = "selected" <?php }?>>Member</option>
                            <option value="Operator" <?php if ($o1->route_type == "Operator") {?> selected = "selected" <?php }?>>Operator</option>
                            <option value="Plan" <?php if ($o1->route_type == "Plan") {?> selected = "selected" <?php }?>>Plan</option>
                            <option value="Service" <?php if ($o1->route_type == "Service") {?> selected = "selected" <?php }?>>Service</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Route For</label>
                        <select name="route_for" id="route_for" class="form-control" required="required" >
                            <option value="">Select Route For</option>
                            <option value="All" <?php if ($o1->route_for == "All") {?> selected="selected" <?php }?>>All</option>
                            <option value="Specific" <?php if ($o1->route_for == "Specific") {?> selected="selected" <?php }?>>Specific</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <label>Api 1</label>
                        <select name="api_1" id="api_1" class="form-control" >
                            <option value="0" <?php if ($o1->api_1 == "0") {?> selected="selected" <?php }?>>Any</option>
                            <?=api_list($o1->api_1);?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Api 2</label>
                        <select name="api_2" id="api_2" class="form-control" >
                            <option value="0" <?php if ($o1->api_2 == "0") {?> selected="selected" <?php }?>>Any</option>
                            <?=api_list($o1->api_2);?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Api 3</label>
                        <select name="api_3" id="api_3" class="form-control" >
                            <option value="0" <?php if ($o1->api_3 == "0") {?> selected="selected" <?php }?>>Any</option>
                            <?=api_list($o1->api_3);?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>From Amount</label>
                        <input type="number" name="from_amount" id="from_amount" class="form-control" step="0.01" placeholder="Amount Starting From" value="<?=$o1->amount_from;?>" <?php if ($o1->route_type != "Amount") {?> disabled = "disabled" <?php }?> />
                    </div>
                    <div class="col-md-3">
                        <label>To Amount</label>
                        <input type="number" name="to_amount" id="to_amount" class="form-control" step="0.01" placeholder="Amount Ending at" value="<?=$o1->amount_to;?>" <?php if ($o1->route_type != "Amount") {?> disabled = "disabled" <?php }?> />
                    </div>
                </div>
                <?php if ($o1->logo != "") {?>
                <div class="row">
                    <div class="col-md-6">
                        <img src="../provider_logos/<?=$o1->logo;?>" class="img-rounded" style="width:100px;" alt="Provider Logo" />
                    </div>
                </div>
                <?php }?>
                <div class="row">
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1" <?php if ($o1->is_active == 1) {?> selected="selected" <?php }?>>Active</option>
                            <option value="0" <?php if ($o1->is_active == 0) {?> selected="selected" <?php }?>>Blocked</option>
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