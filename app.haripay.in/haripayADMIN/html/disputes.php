<!--Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Disputes History</h1>
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
                        <label>Transaction Type</label>
                        <select name="transaction_type" id="transaction_type" class="form-control">
                            <option value="0" <?php if ($transaction_type == "") {?> selected = 'selected' <?php }?>>Select Transaction Type</option>
                            <option value="Recharge" selected = 'selected' >Recharge</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0">Select Status</option>
                            <option value="Pending">Open</option>
                            <option value="Success">Resolved</option>
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
                        <label>Mobile / DTH / Ref Number</label>
                        <input type="text" class="form-control" name="search_val" id="search_val" placeholder="Mobile / DTH / Reference Number"   />
                    </div>
                    <div class="col-md-3">
                        <label>OP ID/ API Code</label>
                        <input type="text" class="form-control" name="opid" id="opid" placeholder="OP ID"   />
                    </div>
                    <div class="col-md-3">
                        <label>API</label>
                        <select name="api_id" id="api_id" class="form-control">
                            <option value="0">Select API</option>
                            <?=api_list(0);?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>User Name</label>
                        <input type="text" name="user_name" id="user_name" placeholder="Name / Username" class="form-control" />
                    </div>
                    <div class="col-md-3">
                        <label>IP Address</label>
                        <input type="text" name="ip_address" id="ip_address" placeholder="IP Address" class="form-control" />
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
                Disputes History
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
                                <th>Transaction Details</th>
                                <th>Api</th>
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
<div class="modal fade" id="pending_info" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel"> Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times;</button>
            </div>
             <form id="approve_form"  method='POST' onsubmit= "return false">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" id="dispute_reply">
                       
                             <textarea name="dispute_issue" id="dispute_issue" rows="5" class="form-control" placeholder="Dispute Resolution" required="required"></textarea>
                        
                        <!-- <button type="button" class="btn btn-success">Approve</button>
                        <button type="button" class="btn btn-danger">Reject</button> -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="updte" id="approve" value="1" />
                <input type="hidden" name="dis_approve" id="dis_approve" value="" />
                <input type="button" name="dispute_resolution" id="dispute_resolution"  onclick="update_dispute('Approve')" class="btn btn-primary" value="Approve" />
                <input type="button" name="reject_dispute" id="reject_dispute" onclick="update_dispute('Reject')" class="btn btn-primary" value="Reject" />
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid