<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Recharge Report </h1>
        </div>
    </div>
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <!--div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 success_couter">
                <div class="card-body card-body_new">
                    <div class="row no-gutters align-items-center">
                        <div class="col ">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 success_couter_header">Success Count</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" > <i class="fas fa-fw fa-tachometer-alt"></i> <span id="recharge_s_count"> 0 </span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 success_couter">
                <div class="card-body card-body_new">
                    <div class="row no-gutters align-items-center">
                        <div class="col ">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 success_couter_header">Success Amount</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" > <i class="fas fa-fw fa-rupee-sign"></i> <span id="recharge_s_amt"> 0 </span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 pending_couter">
                <div class="card-body card-body_new">
                    <div class="row no-gutters align-items-center">
                        <div class="col ">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 pending_couter_header">Pending Count</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" > <i class="fas fa-fw fa-tachometer-alt"> </i> <span id="recharge_p_count"> 0 </span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 pending_couter">
                <div class="card-body card-body_new">
                    <div class="row no-gutters align-items-center">
                        <div class="col ">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 pending_couter_header">Pending Amount</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" > <i class="fas fa-fw fa-rupee-sign"></i> <span id="recharge_p_amt"> 0 </span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-primary shadow  py-2">
                <div class="card-body card-body_new">
                    <div class="row no-gutters align-items-center">
                        <div class="col ">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Failed Count</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" > <i class="fas fa-fw fa-tachometer-alt"></i> <span id="recharge_f_count"> 0 </span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-6 mb-4">
            <div class="card border-left-primary shadow  py-2">
                <div class="card-body card-body_new">
                    <div class="row no-gutters align-items-center">
                        <div class="col ">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Failed Amount</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" > <i class="fas fa-fw fa-rupee-sign"></i> <span id="recharge_f_amt"> 0 </span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div-->
    </div>
    <!-- DataTales Example -->
    <!--div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
        </div>
        <div class="card-body">
          <?php  if($o->user_type == "Master Distributor"){ ?>
            <form name="search_txn" id="search_txn" method="post"  action="search_filters.php" onsubmit="return false;" >
            <?php } else if($o->user_type == "Distributor"){ ?>
                <form name="search_txn_dt" id="search_txn_dt" method="post"  action="search_filters.php" onsubmit="return false;" >

                <?php } if($o->user_type == "Retailer" || $o->user_type =="API User"){ ?>
                    <form name="search_txn_dt" id="search_txn_dt" method="post"  action="search_filters.php" onsubmit="return false;" >

                    <?php } ?>

                    <div class="row">
                        <div class="col-md-3">
                            <label>From</label>
                            <input type="text" class="form-control" id="from_date" placeholder="From" name="from_date" value="<?= $dd ?>" readonly="" aria-describedby="inputSuccess2Status">
                        </div>
                        <div class="col-md-3">
                            <label>To</label>
                            <input type="text" class="form-control" id="to_date" placeholder="To" name="to_date" readonly="" value="<?= $dd ?>" aria-describedby="inputSuccess2Status">
                        </div>
                        <div class="col-md-3">
                            <label>Choose Status</label>
                            <select name="status_filter" id="status_filter" class="select2_single form-control" >
                                <option value="0">Choose Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Success">Success</option>
                                <option value="Failed">Failed</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>Choose Operator</label>
                            <select name="operator_filter" id="operator_filter" class="select2_single form-control" >
                                <option value="0">Choose Operator</option>
                                <?= service_list(0) ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Search ( Mobile / Ref.no. / Opid )</label>
                            <input type="text" class="form-control" id="search_filter" placeholder="Search ( Mobile / Ref.no. / Opid )" name="search_filter"  aria-describedby="inputSuccess2Status">
                        </div>

                        <div class="col-md-3">
                            <label>&nbsp;</label>
                            <input type="submit" name="search_result" id="search_result" class="form-control btn btn-primary" value="Search Records" />
                        </div>
                    </div>
                </form>
            </div>
        </div-->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="col-md-12 text-left ">
                    List of Recharge Report
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 ">
                        <div id="tabled_data">
                           <?php  if($o->user_type == "Master Distributor"){ ?>
                            <table class="table table-responsive-lg table-striped table-bordered fixedHeader dt-responsive " width="100%" id="admin_fund_history">
                            <?php } else if($o->user_type == "Distributor"){ ?>
                                <table class="table table-responsive-lg table-striped table-bordered fixedHeader  dt-responsive " width="100%" id="recharge_history">
                                <?php }else if($o->user_type == "Retailer" ){ ?>

                                    <table class="table table-responsive-lg table-striped table-bordered fixedHeader  dt-responsive " width="100%" id="admin_fund_history_rt">
                                    <?php }else if($o->user_type == "API User"){ ?>
                                         <table class="table table-responsive-lg table-striped table-bordered fixedHeader  dt-responsive " width="100%" id="admin_fund_history_api">
                                    <?php } ?>
                                    <thead style="background-color:#205f56; color:#fff;">
                                        <tr>

                                            <th>Txn Id </th>
                                            <?php  if($o->user_type == "Master Distributor"){ ?>
                                                <th>Distributor Id</th>
                                            <?php } ?>
                                           <?php if($o->user_type != "Retailer"){ ?>
                                            <th>Retailer ID</th>
                                           
                                        <?php } ?>
                                        <?php if($o->user_type == "API User"){ ?>
                                            <th>API User ID</th>
                                           
                                        <?php } ?>
                                            <th>Recharge Number</th>
                                            <th>Status</th>
                                            <th>Recharge Amount</th>
                                            <th>Commission</th>
                                            <th>Debited Amount</th>
                                            <th>Current Amount</th>
                                            <th>Operator Id</th>
                                             <th>Request-Response <br/> Date & Time</th>
                                            <!--th>Print</th-->
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
        <div class="modal fade" id="show_response_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 75%" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Response Url : <span id="show_wallet_id"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12" style='word-break: break-all;'>
                            <div id="url_response_div">
                            </div>
                            <div id="processing_response" style="display: none;" class="col-md-12 text-center">
                                <?php include "processing.php"; ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="show_update_opid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog"  role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Opid: <span id="opid_wallet_id"></span></h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form name="update_form" id="update_form" method="post"  action="save_opid.php" onsubmit="return false;" >
                        <div class="modal-body">
                            <div class="col-md-12" >
                                <label>Operator Id</label>
                                <input type='text' name="modal_opid" id="modal_opid" required="" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <input type="submit" name="save" id="save" class=" btn btn-primary" value="Save" />
                            <input type="hidden" name="updte" id="updte" class="form-control btn btn-primary" value="1" />
                            <input type="hidden" name="opid_wallet_id" id="opid_wallet_id" class="form-control btn btn-primary" value="0" />
                        </div>
                    </form>
                    <div id="processing_opid" style="display: none;" class="col-md-12 text-center">
                        <?php include "processing.php"; ?>
                    </div>
                </div>
            </div>
        </div>
<!-- /.container-fluid -->