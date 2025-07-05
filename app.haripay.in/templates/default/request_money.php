<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Request Money</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Request Money </h6>
                </div>
                <div class="card-body">
                    <form name="ra" id="ra" method="post" action="send_request.php" onsubmit="return false;">
                        <div class="row">
                            <div class="col-md-12" id="rmoney">
                                <div class="row">
                                    <div class="col-md-12" id="t_mode">
                                            <label>Select User Type</label>
                                            <select name="request_user" id="request_user" class="form-control">

                                                <option value="1" >ADMIN</option>
                                                <?= get_request_users_list(1) ?>
                                            </select>


                                    </div>
                                    <div class="col-md-12">
                                        <label>Request Amount</label>
                                        <input type="number" name="request_money" id="request_money" class="form-control" value="" placeholder="Request Money" step="0.01" min="1" required="required" />
                                    </div>

                                    <div class="col-md-12" id="t_mode">
                                        <label>Transfer Mode</label>
                                        <select name="transfer_mode" id="transfer_mode" class="form-control">
                                            <option value="">Select Transfer Mode</option> 
                                            <?= payment_mode_list($o1->transfer_mode); ?> 
                                        </select>
                                    </div>
                                    <div class="col-md-12" id="payment_info" style="display: none;margin:10px 0 10px 0;">

                                    </div>

                                    <div class="col-md-12" id="t_number" style="display: none;">
                                        <label>Transaction Number <small>(Leave it Blank for Cash Transaction)</small></label>
                                        <input type="text" name="transaction_number" id="transaction_number" class="form-control" value="" placeholder="Transaction Number with Wallet / Bank Name" />
                                    </div>

                                    <div class="col-md-12 top_margin_10">

                                        <input type="hidden" name="updte" id="updte" value="1" />
                                        <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Send Request" />
                                        <input type="button" name="back" id="back" class="btn btn-secondary" value="Back" onclick="history.back(-1)" />
                                    </div>
                                </div>
                            </div>
                            <div id="processing" style="display:none;" class="col-md-12 text-center top_margin_10">
                                <?php include $path . "processing.php"; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Your Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table-striped table-bordered" width="100%" cellspacing="4" cellpadding="4">
                                <tr>
                                    <td width="35%">Name</td>
                                    <th width="65%" id="t_name"><?= $o->name; ?></th>
                                </tr>
                                <tr>
                                    <td width="35%">User Name</td>
                                    <th width="65%" id="t_username"><?= $o->user_name; ?></th>
                                </tr>
                                <tr>
                                    <td width="35%">Mobile</td>
                                    <th width="65%" id="t_mobile"><?= $o->mobile; ?></th>
                                </tr>
                                <tr>
                                    <td width="35%">Email</td>
                                    <th width="65%" id="t_email"><?= $o->email; ?></th>
                                </tr>
                                <tr>
                                    <td width="35%">Balance Amount</td>
                                    <th width="65%" ><i class="fa fa-rupee-sign"></i> <span id="t_balance"><?= round($o->amount_balance,3); ?></span></th>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- DataTales Example -->
</div>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Request Money List</h1>
        </div>
    </div>
    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <div class="col-md-12 text-left ">
                List of Request Money
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="dataTable">
                        <thead>
                            <tr style="background-color:#205f56 !important; color:white !important; ">
                                <th>Request Date</th>
                                <th>Request To</th>
                                <th>Amount</th>
                                <th>Details</th> 
                                <th>Status</th>
                            </tr>
                        </thead>
                        <?php for ($i = 0; $i < $rows; $i++) { ?>
                            <tr>
                                <td><?= format_date1($res[$i]['request_date']); ?></td>
                                <td><?= get_username_from_id($res[$i]['request_to']); ?></td>
                                <td> <i class="fa fa-rupee-sign"></i> <?= $res[$i]['amount'] ?></td>
                                 <?php if($res[$i]['decision_date'] == "0000-00-00 00:00:00") { ?>
                                <?php $res[$i]['decision_date'] = ""; ?>
                                 <?php } ?>
                                <td><?= $res[$i]['transfer_mode'] ?> <?= $res[$i]['transaction_number'] ?> <br/> <?= $res[$i]['decision'] ?><br/> <?= $res[$i]['decision_date'] ?></td>
                                <td> <?php if ($res[$i]['status'] == "Pending") { ?> 
                                        <span class="fa_pending">Pending</span>
                                    <?php } else if ($res[$i]['status'] == "Rejected") { ?> 
                                        <span class="fa_reject">Rejected</span>
                                    <?php } else if ($res[$i]['status'] == "Transferred") { ?> 
                                        <span class="fa_approve">Transferred</span>
                                    <?php } ?></td>
                            </tr>
                        <?php } ?>     
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>