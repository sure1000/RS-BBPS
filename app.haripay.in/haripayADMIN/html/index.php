
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="row" style="width:100%;">
            <div class="col-md-6">
                <h1 class="h3 mb-0 text-gray-800">Reports <span class="small">(<?=$delivery_note;?>)</span></h1>
                <a class="btn btn-success text-white" href="apis.php">API Balance: <i class="fa fa-rupee-sign"></i> <?=round($res_api_balance[0]['api_balance'], 2);?></a>
                <a class="btn btn-warning text-white" href="user_balance.php">User Balance: <i class="fa fa-rupee-sign"></i> <?=round($res_user_balance[0]['user_balance'], 2);?></a>
            </div>
            <div class="col-md-6 text-right">
                <form name="reports" id="reports" method="post" action="index.php">
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
    <!-- Content Row 
    <div class="row">
        
     

        <!-- user dashboard start
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info text-white bg-info shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='team.php?<?=$url_date;?>'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray-000 text-uppercase mb-1">Master Distributors</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-000"> <?=$rtres_users_total['Master Distributor'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Earnings (Monthly) Card Example
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary bg-primary shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='admin_distributers_list.php?<?=$url_date;?>'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold white text-uppercase mb-1">Distributors</div>
                            <div class="h5 mb-0 font-weight-bold white"> <?=$rtres_users_total['Distributor'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary bg-primary shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='admin_retailer_list.php?<?=$url_date;?>'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold white text-uppercase mb-1">Retailers</div>
                            <div class="h5 mb-0 font-weight-bold white"> <?=$rtres_users_total['Retailer'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary bg-primary shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='admin_apiuser_list.php?<?=$url_date;?>'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold white text-uppercase mb-1">Api Users</div>
                            <div class="h5 mb-0 font-weight-bold white"><?=$rtres_users_total['API User'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- user dashboard end-->
      <!--div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info text-white bg-info shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='turnover.php?<?=$url_date;?>'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray-000 text-uppercase mb-1">Turnover</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-000"><i class="fa fa-rupee-sign"></i> <?=$turnover;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Earnings (Monthly) Card Example 
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success bg-success shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='commission.php?<?=$url_date;?>'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold white text-uppercase mb-1">Commission</div>
                            <div class="h5 mb-0 font-weight-bold white"><i class="fa fa-rupee-sign"></i> <?=$revenue;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-university fa-2x white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example 
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary bg-primary shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='api_commission.php?<?=$url_date;?>'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold white text-uppercase mb-1">Api Commission</div>
                            <div class="h5 mb-0 font-weight-bold white"><i class="fa fa-rupee-sign"></i> <?=round($res_api_commission_total[0]['api_amount'], 2);?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-plug fa-2x white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-<?=$bg_pl;?> bg-<?=$bg_pl;?> shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='profit_loss.php?<?=$url_date;?>'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold white text-uppercase mb-1">Profit / Loss</div>
                            <div class="h5 mb-0 font-weight-bold white"><i class="fa fa-rupee-sign"></i> <?=$profit_loss;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-database fa-2x white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div-->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='recharge_history.php?status=Success&<?=$url_date;?>'">
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
                <div class="card-body hand" onclick="window.location.href='recharge_history.php?status=Pending&<?=$url_date;?>'">
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
                <div class="card-body hand" onclick="window.location.href='recharge_history.php?status=Failed&<?=$url_date;?>'">
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
                <div class="card-body hand" onclick="window.location.href='recharge_history.php?status=Success&transaction_type=Refund&<?=$url_date;?>'">
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

    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info text-white bg-info shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='money_requests.php'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray-000 text-uppercase mb-1">Money Requests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-000"><i class="fa fa-rupee-sign"></i> <?=$res_requests[0]['request_amount'];?></div>
                            <div class="mb-0 font-weight-bold white">Total Requests: <?=$res_requests[0]['qty'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary bg-primary shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='user_balance.php'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold white text-uppercase mb-1">Users</div>
                            <div class="h5 mb-0 font-weight-bold white"><i class="fa fa-rupee-sign"></i> <?= round($res_user_balance[0]['user_balance'],2);?></div>
                            <div class="mb-0 font-weight-bold white">Total Balance:  <?=$res_users[0]['qty'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger bg-danger shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='disputes.php'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold white text-uppercase mb-1">Disputes</div>
                            <div class="h5 mb-0 font-weight-bold white"><i class="fa fa-rupee-sign"></i> <?=$res_disputes[0]['amount'];?></div>
                            <div class="mb-0 font-weight-bold white">Total Disputes: <?=$res_disputes[0]['qty'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-question-circle fa-2x white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary bg-primary shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='admin_apiuser_list.php'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold white text-uppercase mb-1">Api users</div>
                            <div class="h5 mb-0 font-weight-bold white"><i class="fa fa-rupee-sign"></i> <?= round($rtres_users_amount['API User'],2);?></div>
                            <div class="mb-0 font-weight-bold white">Total Users: <?=$rtres_users_total['API User'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info text-white bg-info shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='admin_md_list.php'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray-000 text-uppercase mb-1"> MASTER DISTRIBUTORS</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-000"><i class="fa fa-rupee-sign"></i> <?= round($rtres_users_amount['Master Distributor'],2);?></div>
                            <div class="mb-0 font-weight-bold white">Total Users: <?=$rtres_users_total['Master Distributor'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary bg-primary shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='admin_distributers_list.php'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold white text-uppercase mb-1">DISTRIBUTORS</div>
                            <div class="h5 mb-0 font-weight-bold white"><i class="fa fa-rupee-sign"></i> <?= round($rtres_users_amount['Distributor'],2);?></div>
                            <div class="mb-0 font-weight-bold white">Total Users: <?=$rtres_users_total['Distributor'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger bg-danger shadow h-100 py-2">
                <div class="card-body hand" onclick="window.location.href='admin_retailer_list.php'">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold white text-uppercase mb-1">Retailers</div>
                            <div class="h5 mb-0 font-weight-bold white"><i class="fa fa-rupee-sign"></i> <?= round($rtres_users_amount['Retailer'],2);?></div>
                            <div class="mb-0 font-weight-bold white">Total Users: <?=$rtres_users_total['Retailer'];?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
              

    </div>

 
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
