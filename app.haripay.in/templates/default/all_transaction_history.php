<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Recharge History</h1>
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
                              <option value="Recharge">Recharge</option>
                            <option value="Refund">Refund</option>
                            <option value="Commission">Commission</option>
<!--                            <option value="Recieve Money">Recieve Money</option>
                            <option value="Send Money"> Send Money</option>
                            <option value="Reverse"> Reverse Money</option>-->
                           
                        </select>
                    </div>
                       <div class="col-md-3">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0">Select Status</option>
                            <option value="Failed">Failed</option>
                            <option value="Pending">Pending</option>
                            <option value="Success">Success</option>
                            <option value="Refund">Refund</option>
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
                        <label>Mobile / DTH / Ref Number</label>
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
                Transaction History (Only Recharges / Commissions)
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <div id="tabled_data"> <?php if($o->user_type == "Retailer") { ?>
                        <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="recharge_history">
                    <?php } else { ?>
                            <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="recharge_history_dt_ds">
                    <?php } ?><thead style="color:#fff;background-color:#205f56">
                                <tr>
                                    <th>Date</th>
                                    <?php if($o->user_type != "Retailer") { ?>
                                    <th>User Details</th>
                                    <?php } ?>
                                    <th>Transaction Details</th>
                                    <th>Ref. Number</th>
                                    <th>Opid</th>
                                     <th> Amount</th>
                                    <th>Debit / Credit <br/> <small>Comm. / Sur.</small></th>
                                    <th>New Balance</th>
                                   
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="processing" style="display: none;" class="col-md-12 text-center">
                        <?php include "templates/" . $res_template[0]['template_name'] . "/processing.php";?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->