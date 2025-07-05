<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="row" style="width:100%;">
            <div class="col-md-6">
                <h1 class="h3 mb-0 text-gray-800">Reports <span class="small">(<?=$delivery_note;?>)</span></h1>
                <a class="btn btn-success text-white" href="ledger.php?from=<?=$start_date;?>&to=<?=$end_date;?>">Wallet Balance: <i class="fa fa-rupee-sign"></i> <?=$o->amount_balance;?></a>
                <a class="btn btn-warning text-white" href="credit_history.php">Credit Pending: <i class="fa fa-rupee-sign"></i> <?=$o->credit_amount;?></a>
            </div>
            <div class="col-md-6 text-right">
                <form name="reports" id="reports" method="post" action="reports.php">
                    <div class="row">
                        <div class="col-md-4 text-left">
                            <label>From Date</label>
                            <input type="date" name="from_date" id="from_date" class="form-control" value="<?=$from_date;?>" placeholder="From Date" />
                        </div>
                        <div class="col-md-4 text-left">
                            <label>To Date</label>
                            <input type="date" name="to_date" id="to_date" class="form-control" value="<?=$to_date;?>" placeholder="To Date" />
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="fa fa-rupee-sign"></i> <?=round($money_input, 2);?></div>
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
    <!-- Content Row -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-7 col-lg-7">
            <div class="card shadow mb-4 hand" onclick="window.location.href='turnover.php'">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Turnover</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pie Chart -->
        <div class="col-xl-5 col-lg-5">
            <div class="card shadow mb-4 hand" onclick="window.location.href='turnover_operator.php'">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Turnover Service Wise</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <?php for ($i = 0; $i < $row_turnover_operator; $i++) {?>
                            <span class="mr-2">
                                <i style = "color: <?=$res_turnover_operator[$i]['color'];?>;" class="fas fa-circle"></i> <?=$res_turnover_operator[$i]['provider_type'];?>
                            </span>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-lg-7">
            <div class="card shadow mb-4 hand" onclick="window.location.href='commission.php'">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart_revenue"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-5 col-lg-5">
            <div class="card shadow mb-4 hand" onclick="window.location.href='revenue_operator.php'">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Service Wise</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart_revenue"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <?php for ($i = 0; $i < $row_turnover_operator; $i++) {?>
                            <span class="mr-2">
                                <i style = "color: <?=$res_turnover_operator[$i]['color'];?>;" class="fas fa-circle"></i> <?=$res_turnover_operator[$i]['provider_type'];?>
                            </span>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Turnover Operator Wise</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped" width="100%">
                                <tr>
                                    <th>Operator</th>
                                    <th>Transactions</th>
                                    <th>Service</th>
                                    <th>Amount</th>
                                    <th>Percentage</th>
                                </tr>
                                <?php for ($i = 0; $i < $row_operators; $i++) {?>
                                    <?php $link = "transaction.php?provider_type=" . $res_operators[$i]['provider_type'] . "&provider_id=" . $res_operators[$i]['provider_id'] . "&transaction_type=Recharge&from=" . $start_date . "&to=" . $end_date;?>
                                    <tr>
                                        <td><a href="<?=$link;?>"><?=$res_operators[$i]['provider_name'];?></a></td>
                                        <td><a href="<?=$link;?>"><?=$res_operators[$i]['quantity'];?></a></td>
                                        <td><a href="<?=$link;?>"><?=$res_operators[$i]['provider_type'];?></a></td>
                                        <td><a href="<?=$link;?>"><i class="fa fa-rupee-sign"></i> <?=$res_operators[$i]['turnover'];?></a></td>
                                        <td><a href="<?=$link;?>"><?=$res_operators[$i]['percentage'];?>%</a></td>
                                    </tr>
                                <?php }?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Operator Wise</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped" width="100%">
                                <tr>
                                    <th>Operator</th>
                                    <th>Transactions</th>
                                    <th>Service</th>
                                    <th>Amount</th>
                                    <th>Percentage</th>
                                </tr>
                                <?php for ($i = 0; $i < $row_operators_profit; $i++) {?>
                                    <?php $link = "transaction.php?provider_type=" . $res_operators_profit[$i]['provider_type'] . "&provider_id=" . $res_operators_profit[$i]['provider_id'] . "&transaction_type=Commission&from=" . $start_date . "&to=" . $end_date;?>
                                    <tr>
                                        <td><a href="<?=$link;?>"><?=$res_operators_profit[$i]['provider_name'];?></a></td>
                                        <td><a href="<?=$link;?>"><?=$res_operators_profit[$i]['quantity'];?></a></td>
                                        <td><a href="<?=$link;?>"><?=$res_operators_profit[$i]['provider_type'];?></a></td>
                                        <td><a href="<?=$link;?>"><i class="fa fa-rupee-sign"></i> <?=round($res_operators_profit[$i]['turnover'], 2);?></a></td>
                                        <td><a href="<?=$link;?>"><?=$res_operators_profit[$i]['percentage'];?>%</a></td>
                                    </tr>
                                <?php }?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
