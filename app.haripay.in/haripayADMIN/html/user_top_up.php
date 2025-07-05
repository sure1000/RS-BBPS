<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">API Top Up History</h1>
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
                    <div class="col-md-2">
                        <label>From</label>
                        <input type="date" class="form-control" name="from_date" id="from_date" placeholder="From Date" value="<?=$from_date;?>" />
                    </div>
                    <div class="col-md-2">
                        <label>To</label>
                        <input type="date" class="form-control" name="to_date" id="to_date" placeholder="To Date" value="<?=$to_date;?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Ref Number</label>
                        <input type="text" class="form-control" name="search_val" id="search_val" placeholder="Reference Number"   />
                    </div>
                    <div class="col-md-3">
                        <label>User name</label>
                        <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name"   />
                    </div>
                    <div class="col-md-2">
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
                API Top Up
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="recharge_history">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>User Name</th>
                                <th>Transaction Details</th>
                                <th>Old Amount</th>
                                <th>Amount</th>
                                <th>New Amount</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->