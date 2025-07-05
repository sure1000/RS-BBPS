<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Provider Details</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php if ($o1->provider_id > 0) { ?> Edit <?php } else { ?> Add <?php } ?> Provider Details</h6>
        </div>
        <div class="card-body">
            <form name="ra" id="ra" method="post" action="provider_details.php?aid=<?= $o1->provider_id; ?>" enctype= multipart/form-data>
                <div class="row">
                    <div class="col-md-6">
                        <label>Provider Name</label>
                        <input type="text" class="form-control" name="provider" id="provider" placeholder="Provider Name" value="<?= $o1->provider; ?>" required="required" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Service Name</label>
                        <select name="service_id" id="service_id" class="form-control" required="required" >
                            <option value="">Select Service</option>
                            <?= service_list($o1->service_id); ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Api</label>
                        <select name="api_id" id="api_id" class="form-control" >
                            <option value="0" <?php if ($o1->api_id == "0") { ?> selected="selected" <?php } ?>>Any</option>
                            <?= api_list($o1->api_id); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Beckup Api</label>
                        <select name="beckup_api" id="beckup_api" class="form-control" >
                            <option value="0" <?php if ($o1->beckup_api == "0") { ?> selected="selected" <?php } ?>>Any</option>
                            <?= api_list($o1->beckup_api); ?>
                        </select>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>State</label>
                        <select name="state" id="state" class="form-control" >
                            <option value="">Select State</option>
                            <?=  get_circle_list($o1->state)?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Status</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1" <?php if ($o1->is_active == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if ($o1->is_active == 0) { ?> selected="selected" <?php } ?>>Blocked</option>
                        </select>
                    </div>
                </div>
                <!--div class="row">
                    <div class="col-md-2">
                        <label>Commission Amount</label>
                        <input type="text" name="commission_amount" id="commission_amount" placeholder="Commission Amount" value="<?=$o1->commission_amount;?>" class="form-control" />
                    </div>
                    <div class="col-md-1">
                        <label>&nbsp;</label>
                        <span >Or</span>    
                    </div>
                    <div class="col-md-2">
                        <label>Percentage</label>
                        <input type="text" name="commission_percentage" id="commission_percentage" placeholder="Commission Percentage (Donot put %)" value="<?=$o1->commission_percentage;?>" class="form-control" />
                    </div>
                </div-->
                <div class="row">
                    <div class="col-md-6">
                        <label>Provider Logo</label>
                        <input type="file" name="logo" id="logo" class="form-control" placeholder="Select Logo" />
                    </div>
                </div>
                <?php if($o1->logo != ""){ ?>
                <div class="row">
                    <div class="col-md-6">
                        <img src="../provider_logos/<?=$o1->logo;?>" class="img-rounded" style="width:100px;" alt="Provider Logo" />
                    </div>
                </div>
                <?php } ?>
                
                
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