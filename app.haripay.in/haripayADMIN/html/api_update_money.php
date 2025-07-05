<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800"><?= $o1->api_name; ?> API Balance Update</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cash / Credit to API's   <button class="btn btn-primary" style="float: right;" onclick="check_balance(<?= $o1->api_id?>)" >Check Balance</button> </h6>
          
        </div>
        <div class="card-body">
            <form name="ra" id="ra" method="post" action="api_update_money.php?aid=<?= $o1->api_id; ?>" >
                <div class="row">
                    <div class="col-md-6">
                        <label>Payment Type</label>
                        <select name="cash_credit" id="cash_credit" class="form-control" required="required">
                            <option value="">Select Cash / Credit </option>
                            <option value="Cash">Cash</option>
                            <option value="Credit">Credit</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Payment Mode</label>
                        <input type="text" class="form-control" name="payment_mode" id="payment_mode" placeholder="Payment Mode" value="<?= $o1->payment_mode; ?>"  />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Amount</label>
                        <input type="text" name="amount" id="amount" class="form-control" required="required" placeholder="Amount" value="" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Transaction Details</label>
                        <textarea name="transaction_details" id="transaction_details" class="form-control" cols="5" placeholder="Transaction Details"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Update Wallet (You can choose update API Amount or not. If the earlier payment was credit, and you are making a payment for the same. Then Select No</label>
                        <input type="radio" name="update_wallet"  id="update_wallet_yes" required="required" value="Yes"> Yes
                        <input type="radio" name="update_wallet" id="update_wallet_no" required="required" value="No"> No
                    </div>
                </div>
                <div class="row top_margin_10">
                    <div class="col-md-6">
                        <input type="hidden" name="updte" id="updte" value="1" />
                        <input type="hidden" name="api_id" id="api_id" value="<?= $o1->api_id; ?>" />
                        <input type="submit" name="save" id="save" value="Save" class="btn btn-primary" />
                        <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-secondary" onclick="history.back(-1)" />

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->