<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Wallet History</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
        </div>
        <div class="card-body">
            <form name="search_txn" id="search_txn" method="post"  action="list_recharge_history.php" onsubmit="return false;" >
                <div class="row">
                   

                 
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
                        <label>Transaction Type</label>
                        <select name="transaction_type" id="transaction_type" class="form-control">
                            <option value="0">Select Transaction Type</option>
                            <option value="Send Money">Send Money</option>
                            <option value="Recieve Money">Recieve Money</option>
                            <option value="Reverse">Reverse Money</option>
                            <option value="Payment Gateway">Payment Gateway</option>
                     
                        </select>
                    </div>
                   
                    <div class="col-md-3">
                        <label>From</label>
                        <input type="date" class="form-control" name="from_date" id="from_date" placeholder="From Date" />
                    </div>
                    <div class="col-md-3">
                        <label>To</label>
                        <input type="date" class="form-control" name="to_date" id="to_date" placeholder="To Date"   />
                    </div>
                  
                      <div class="col-md-3">
                        <label>User</label>
                        <select name="user_id_search" id="user_id_search" class="form-control">
                            <option value="0">Select User</option>
                            <?= user_list_dropdown_retailer(0); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Ref Number</label>
                        <input type="text" class="form-control" name="search_val" id="search_val" placeholder="Mobile / DTH / Reference Number"   />
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
                Wallet History 
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <div id="tabled_data">
                        <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="recharge_history1">
                            <thead style="color:#fff;background-color:#034ea1">
                                <tr>
                                    <th>Date</th>
                                    <th>User Detail</th>
                                    <th>Type</th>
                                    <th>To / From</th>
                                    <th>Ref. Number</th>
                                    <th>Amount</th>
                                    <th>User New Balance</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="processing" style="display: none;" class="col-md-12 text-center">
                        <?php include "processing.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
