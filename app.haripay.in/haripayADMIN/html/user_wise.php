<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Users List</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
        </div>
        <div class="card-body">
            <form name="search_txn" id="search_txn" method="post"  action="turnover_list.php" onsubmit="return false;" >
                <div class="row">
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
                        <label>User Name</label>
                        <input type="text" name="user_name" id="user_name" placeholder="Name / Username" class="form-control" />
                    </div>
                    <div class="col-md-3">
                        <label>User Plan</label>
                        <select name="plan_id" id="plan_id" class="form-control">
                            <option value="" selected="selected">Select User Plan</option>
                            <?=user_plans_dropdown(0);?>
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
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="" selected="selected">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Blocked</option>
                            <option value="2">New</option>
                        </select>
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
                User List
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="recharge_history">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Balance Amount</th>
                                <th>Credit Amount</th>
                                <th>Success</th>
                                <th>Pending</th>
                                <th>Total</th>
                                <th>Failed</th>
                                <th>Refund</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->