<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="row" style="width:100%;">
            <div class="col-md-6">
                <h1 class="h3 mb-0 text-gray-800">Reports <span class="small">(<?=$delivery_note;?>)</span></h1>
                </div>
            <div class="col-md-6 text-right">
                <form name="reports" id="reports" method="post" action="index.php">
                    <div class="row">
                        <div class="col-md-4 text-left">
                            <label>From Date</label>
                            <input type="date" name="from_date" id="from_date" class="form-control" value="<?=format_date_without_time($from_date);?>" placeholder="From Date" />
                        </div>
                        <div class="col-md-4 text-left">
                            <label>To Date</label>
                            <input type="date" name="to_date" id="to_date" class="form-control" value="<?=format_date_without_time($to_date);?>" placeholder="To Date" />
                        </div>
                        <div class="col-md-4">
                            <label>&nbsp;</label>
                            <input type="submit" name="search_report" id="search_report" class="btn btn-primary form-control" value="Search" />
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='turnover.php'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tournover</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="fa fa-rupee-sign"></i> <?=$turnover;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='commission.php'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Commission</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="fa fa-rupee-sign"></i> <?=$revenue;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-university fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='investment.php'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Capital Invested</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="fa fa-rupee-sign"></i> <?=$money_input;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='disputes.php'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Disputes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="fa fa-rupee-sign"></i> <?=$res_disputes[0]['amount'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-gavel fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='transaction.php?status=Success&transaction_type=Recharge&from=<?=$start_date;?>&to=<?=$end_date;?>'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Successful</div>
                            <div class="h5 mb-0 font-weight-bold text-success"><i class="fa fa-rupee-sign"></i> <?=$success['amount'];?></div>
                            <div class="mb-0 text-success">Total Recharges: <?=$success['quantity'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='transaction.php?status=Pending&transaction_type=Recharge&from=<?=$start_date;?>&to=<?=$end_date;?>'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending</div>
                           <div class="h5 mb-0 font-weight-bold text-warning"><i class="fa fa-rupee-sign"></i> <?=$pending['amount'];?></div>
                            <div class="mb-0 text-warning">Total Recharges: <?=$pending['quantity'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hourglass-start fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='transaction.php?status=Failed&transaction_type=Recharge&from=<?=$start_date;?>&to=<?=$end_date;?>'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Failed</div>
                            <div class="h5 mb-0 font-weight-bold text-danger"><i class="fa fa-rupee-sign"></i> <?=$failed['amount'];?></div>
                            <div class="mb-0 font-weight-bold text-danger">Total Failed: <?=$failed['quantity'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-window-close fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='transaction.php?transaction_type=Refund&from=<?=$start_date;?>&to=<?=$end_date;?>'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Refund</div>
                            <div class="h5 mb-0 font-weight-bold text-info"><i class="fa fa-rupee-sign"></i> <?=$res_refunds[0]['amount'];?></div>
                            <div class="mb-0 font-weight-bold text-info">Total Refunds: <?=$res_refunds[0]['quantity'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-university fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<div class="modal fade" id="kyc_modal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content" style="width: 600px;">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Pending Kyc </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-danger">
                        <small>Please Complete Your KYC or your Account will autoblock on <?=format_date_without_time($o->kyc_date);?>.</small>
                    </div>
                </div>
                <form name="kyc_form" id="kyc_form" method="post" action="kyc.php" enctype='multipart/form-data'>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Pan No</label>
                            <input type="text" name="reg_pan_no" id="reg_pan_no" value="<?=$o->pancard;?>" class="form-control" required="required" />
                        </div>
                        <div class="col-md-6">
                            <label>Pan File</label>
                            <input type="file" name="pan_file" id="pan_file" value="" class="form-control" required="required" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Document Type</label>
                            <select name="kyc_doc" id="kyc_doc" class="form-control" required="required">
                                <option value="">Select Document Type</option>
                                <option value="Adhaar">Adhaar Card</option>
                                <option value="Passport">Passport</option>
                                <option value="Driving Licence">Driving Licence</option>
                                <option value="Voter Card">Voter Card</option>
                                <option value="Udhyog Adhaar">Udhyog Adhaar</option>
                                <option value="Electricity Bill">Electricity Bill</option>
                                <option value="Telephone Bill">Telephone Bill</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Document File</label>
                            <input type="file" name="kyc_file" id="kyc_file" class="form-control" value="" required="required" />
                        </div>
                    </div>
                    <div class="row top_margin_10">
                        <div class="col-md-8">
                            <input type="hidden" name="kyc_updte" id="kyc_updte" value="1" />
                            <input type="submit" name="save_kyc" id="save_kyc" value="Upload Document" class="btn btn-primary" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>