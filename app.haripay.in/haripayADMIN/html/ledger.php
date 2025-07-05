
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Complete Ledger</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
        </div>
        <div class="card-body">
            <form name="search_txn" id="search_txn" method="post"  action="recharge_history_list.php" onsubmit="return false;" >
                <div class="row">
                    <div class="col-md-3">
                        <label>User Name</label>
                        <select name="user_id" id="user_id" class="form-control" required="">
                            <option value="0">Select User </option>
                            <?=user_list_dropdown(0);?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Api Name</label>
                        <select name="api_id" id="api_id" class="form-control">
                            <option value="0">Select Api</option>
                            <?=api_list(0);?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Service</label>
                        <select name="service_id" id="service_id" class="form-control">
                            <option value="0">Select Service</option>
                            <?=service_list(0);?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Provider</label>
                        <div id="provider_list">
                            <select name="provider_id" id="provider_id" class="form-control" disabled="disabled">
                                <option value="0">Select Provider</option>
                                <?=get_provider_list_by_service($provider_id, 0);?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Transaction Type</label>
                        <select name="transaction_type" id="transaction_type" class="form-control">
                            <option value="0">Select Transaction Type</option>
                            <option value="Commission">Commission</option>
                            <option value="Recharge">Recharge</option>
                            <option value="Recieve Money">Recieve Money</option>
                            <option value="Refund">Refund</option>
                            <option value="Reverse">Reverse</option>
                            <option value="R Offer Check">R Offer Check</option>
                            <option value="Send Money">Send Money</option>
                            <option value="User Info Check">User Info Check</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0">Select Status</option>
                            <option value="Failed">Failed</option>
                            <option value="Pending">Pending</option>
                            <option value="Success">Success</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>From</label>
                        <input type="date" class="form-control" name="from_date" id="from_date" placeholder="From Date" value="<?=format_date_without_time($_GET['from']);?>" />
                    </div>
                    <div class="col-md-3">
                        <label>To</label>
                        <input type="date" class="form-control" name="to_date" id="to_date" placeholder="To Date" value="<?=format_date_without_time($_GET['to']);?>"  />
                    </div>
               
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <input type="submit" name="search_result" id="search_result" class="form-control btn btn-primary" value="Search Records" />
                    </div>

                </div>
            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <div class="col-md-12 text-left ">
                Complete Ledger
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="recharge_history">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Transaction Details</th>
                                <th>Credit</th>
                                <th>Debit</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->