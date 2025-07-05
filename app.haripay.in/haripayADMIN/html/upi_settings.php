<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">UPI Setting</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> UPI Setting</h6>
        </div>
        <div class="card-body">
            <form name="upi_set" id="upi_set" action="update_upi_details.php" method="post" enctype="multipart/form-data" >
                <div class="row">
                
                    <div class="col-md-4">
                        <label>VPA</label>
                        <input type="text" name="payeeVPA" id="payeeVPA" class="form-control" required="required" value="<?= $o1->payeeVPA; ?>" placeholder="Enter VPA" />
                    </div>
                    <div class="col-md-4">
                        <label>Name</label>
                        <input type="text" name="payeeName" id="payeeName" class="form-control" required="required" value="<?= $o1->payeeName; ?>" placeholder="Enter Name" />
                    </div>
                    <div class="col-md-4">
                        <label>Merchant Code</label>
                        <input type="text" name="payeeMerchantCode" id="payeeMerchantCode" class="form-control" placeholder="Merchant Code" value="<?= $o1->payeeMerchantCode; ?>" />
                    </div>
                    <div class="col-md-4">
                        <label>Minimum Amount</label>
                        <input type="text" name="minimumAmount" id="minimumAmount" class="form-control" placeholder="Minimum Amount" value="<?= $o1->minimumAmount; ?>" />
                    </div>

                    <div class="col-md-4">
                        <label>Transaction Url</label>
                        <input type="text" name="transactionRefUrl" id="transactionRefUrl" class="form-control" value="<?= $o1->transactionRefUrl; ?>" placeholder="Transaction Url" />
                    </div>
                    <div class="col-md-4">
                        <label>aid</label>
                        <input type="text" name="aid" value="<?= $o1->aid; ?>" id="aid" class="form-control" placeholder="Enter aid" />
                    </div>
                </div>
                <div class="row top_margin_10">
                    <div class="col-md-12">
                        <input type="hidden" name="user_id" id="user_id" value="<?= $o1->upi_setup_id; ?>" />
                        <input type="hidden" name="updte" id="updte" value="1" />
                        <input type="submit" name="save" id="upi_save" value="Save" class="btn btn-primary" />
                        <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-secondary" onclick="history.back(-1)" />

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
