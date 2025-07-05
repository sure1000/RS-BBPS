<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Money Requests</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
        </div>
        <div class="card-body">
            <form name="search_txn" id="search_txn" method="post"  action="money_requests.php" onsubmit="return false;" >
                <div class="row">
                    <div class="col-md-3">
                        <label>User Name / Email / Mobile </label>
                        <input type="text" name="user_name" id="user_name" class="form-control" value="<?=$user_name;?>" placeholder="User Name/Email/Mobile" />
                    </div>
                    <div class="col-md-3">
                        <label>Cash / Credit</label>
                        <select name="cash_credit" id="cash_credit" class="form-control">
                            <option value="">Select Cash / Credit</option>
                            <option value="Cash" <?php if ($cash_credit == "Cash") {?> selected = "selected" <?php }?>>Cash</option>
                            <option value="Credit" <?php if ($cash_credit == "Credit") {?> selected = "selected" <?php }?>>Credit</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>From</label>
                        <input type="date" class="form-control" name="from_date" id="from_date" placeholder="From Date" value="<?=$from_date;?>" />
                    </div>
                    <div class="col-md-3">
                        <label>To</label>
                        <input type="date" class="form-control" name="to_date" id="to_date" placeholder="To Date" value="<?=$to_date;?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="Pending" <?php if ($status == "Pending") {?> selected = "selected" <?php }?>>Pending</option>
                            <option value="Transferred" <?php if ($status == "Transferred") {?> selected = "selected" <?php }?>>Transferred</option>
                            <option value="Rejected" <?php if ($status == "Rejected") {?> selected = "selected" <?php }?>>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Transfer Mode</label>
                        <input type="text" class="form-control" name="transfer_mode" id="transfer_mode" placeholder="Transfer Mode" value="<?=$transfer_mode;?>"   />
                    </div>
                    <div class="col-md-3">
                        <label>Transaction Number</label>
                        <input type="text" class="form-control" name="transaction_number" id="transaction_number" placeholder="Transaction Number" value="<?=$transaction_number;?>"   />
                    </div>
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <input type="submit" name="search_result" id="search_result" class="form-control btn btn-primary" value="Search Records" />
                        <input type="hidden" name="updte" id="updte" value="1" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <div class="col-md-12 text-left ">
                Money Requests
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="recharge_history">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>User</th>
                                <th>Cash / Credit</th>
                                <th>Mode</th>
                                <th>Transaction No.</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<div class="modal fade" id="request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">What is your Decision?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="request_status" id="request_status" method="post" action="request_money.php" >
                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="decision" id="decision" class="form-control" rows="5" placeholder="Your Decision"></textarea>
                        </div>
                        <div class="col-md-12 top_margin_10">
                            <input type="hidden" name="updte_request" id="updte_request" value="1" />
                            <input type="hidden" name="request_money_id" id="request_money_id" value="0" />
                            <input type="submit" name="process_it" id="process_it" class="btn btn-success" value="Transfer Payment" />
                            <input type="submit" name="reject_it" id="reject_it" class="btn btn-danger" value="Decline Payment" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>