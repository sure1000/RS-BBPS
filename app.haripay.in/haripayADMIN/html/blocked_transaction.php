<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Block Transactions Details</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php if ($o1->blocked_transaction_id > 0) { ?> Edit <?php } else { ?> Add <?php } ?> Blocked Transaction Details</h6>
        </div>
        <div class="card-body">
            <form name="ra" id="ra" method="post" action="block_transaction.php?aid=<?= $o1->blocked_transaction_id; ?>" >
                <div class="row">
                    <div class="col-md-6">
                        <label>Provider Name</label>
                        <select name="provider_id" id="provider_id" class="form-control">
                            <option value="0" <?php if($o1->provider_id == 0){ ?> selected="selected" <?php } ?>>All Providers</option>
                            <?=service_provider_list($o1->provider_id);?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Amount</label>
                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount" value="<?=$o1->amount;?>" />
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