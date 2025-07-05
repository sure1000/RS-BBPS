<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="../img/<?=$res_site[0]['logo'];?>">
    <title><?=$res_site[0]['site_name'];?></title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <?php if ($o->white_label_id > 0 and $res_css[0][white_label_user_id] > 0) { ?>
     <link href="css/<?= $res_css[0]['color']; ?>" rel="stylesheet">
       <?php } else { ?>

    <link href="css/sb-admin-2.css" rel="stylesheet">
    <?php }?>
    <link href="vendor/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <?php if ($tables == 1) {?>
        <!--Datatables condition. These are used to install and implement datatables -->
        <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="vendor/datatables/buttons.dataTables.min.css" rel="stylesheet">
    <?php }?>

</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
            <!-- Sidebar - Brand -->

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->

            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">
                <?php if ($o->user_type == "Distributor" || $o->user_type == "Master Distributor"|| $o->user_type == "White Label") {?>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-users fa-sm fa-fw mr-2 white"></i>
                            <span class="white"> My Team</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="team_details.php">Add Member</a>
                                <?php if ($o->user_type == "White Label") {?>
                                <a class="collapse-item" href="team.php">Master Distributors</a>
                                <?php }?>
                                <?php if ($o->user_type == "Master Distributor") {?>
                                <a class="collapse-item" href="team.php">Distributors</a>
                                <?php }?>
                                <?php if ($o->user_type == "Distributor") {?>
                                <a class="collapse-item" href="team.php">Reatilers</a>
                                <?php }?>
                                
                            </div>
                        </div>

                        <a class="nav-link collapsed" href="all_transaction_history.php">
                            <i class="fas fa-fw fa-list white"></i></i>
                            <span class="white"> History </span>
                        </a>
                        <a class="nav-link collapsed " href="wallet_history.php"  >
                            <i class="fas fa-2x fa-wallet white"></i>
                            <span class="white">Wallet History</span>
                        </a>
                        <a class="nav-link collapsed " href="ledger.php"  >
                            <i class="fas fa-2x fa fa-list-alt white"></i>
                            <span class="white">Ledger</span>
                        </a>
                        
                    </li>

                <?php }?>
                    
                <li class="nav-item">
                    <?php if ($o->user_type == "Retailer") {?>
                        <a class="nav-link collapsed " href="recharge.php#mobile" <?php if ($recharge_page == 1) {?> onclick="refresh_service('mobile')" <?php }?> >
                            <i class="fas fas-4x fa-mobile white"></i>
                            <span class="white">Mobile</span>
                        </a>
                        <a class="nav-link collapsed " href="recharge.php#dth" <?php if ($recharge_page == 1) {?> onclick="refresh_service('dth')" <?php }?> >
                            <i class="fas fa-2x fa-rss white"></i>
                            <span class="white">DTH</span>
                        </a>
                        <a class="nav-link collapsed " href="recharge.php#utilities" <?php if ($recharge_page == 1) {?> onclick="refresh_service('utilities')" <?php }?> >
                            <i class="fas fa-2x fa-lightbulb white"></i>
                            <span class="white">Utilities</span>
                        </a>
                        <a class="nav-link collapsed " href="recharge.php#dmr_pay" <?php if ($recharge_page == 1) {?> onclick="refresh_service('dmr_pay')" <?php }?> >
                            <i class="fas fa-2x fa-rupee-sign white"></i>
                            <span class="white">Money Transfer</span>
                        </a>
                        <!--a class="nav-link collapsed " href="recharge.php#dmr_pz" <?php if ($recharge_page == 1) {?> onclick="refresh_service('dmr_pz')" <?php }?> >
                            <i class="fas fa-2x fa-rupee-sign white"></i>
                            <span class="white">APP DMR </span>
                        </a-->
                        <a class="nav-link collapsed " href="request_money.php"  >
                            <i class="fas fa-2x fa-hand-holding-usd white"></i>
                            <span class="white">Request Money</span>
                        </a> 
                        <a class="nav-link collapsed " href="all_transaction_history.php"  >
                            <i class="fas fa-2x fa-list-ul white"></i>
                            <span class="white">History</span>
                        </a>
                        <a class="nav-link collapsed " href="disputes.php"  >
                            <i class="fas fa-2x fa-cogs white"></i>
                            <span class="white">Disputes</span>
                        </a>
                        <a class="nav-link collapsed " href="wallet_history.php"  >
                            <i class="fas fa-2x fa-wallet white"></i>
                            <span class="white">Wallet History</span>
                        </a>
                        
                        <a class="nav-link collapsed " href="ledger.php"  >
                            <i class="fas fa-2x fa fa-list-alt white"></i>
                            <span class="white">Ledger</span>
                        </a>

                    <?php }?>
                   
                    <li class="nav-item">
                    <?php if ($o->user_type == "API User") {?>
                       
                        <a class="nav-link collapsed " href="request_money.php"  >
                            <i class="fas fa-2x fa-hand-holding-usd white"></i>
                            <span class="white">Request Money</span>
                        </a> 
                        <a class="nav-link collapsed " href="all_transaction_history.php"  >
                            <i class="fas fa-2x fa-list-ul white"></i>
                            <span class="white">History</span>
                        </a>
                        <a class="nav-link collapsed " href="disputes.php"  >
                            <i class="fas fa-2x fa-cogs white"></i>
                            <span class="white">Disputes</span>
                        </a>
                        <a class="nav-link collapsed " href="wallet_history.php"  >
                            <i class="fas fa-2x fa-wallet white"></i>
                            <span class="white">Wallet History</span>
                        </a>
                        
                        <a class="nav-link collapsed " href="ledger.php"  >
                            <i class="fas fa-2x fa fa-list-alt white"></i>
                            <span class="white">Ledger</span>
                        </a>

                    <?php }?>
                   
                    <?php if ($o->user_type == "Distributor" || $o->user_type == "Master Distributor"|| $o->user_type == "White Label") {?>
                        <a class="nav-link collapsed " href="request_money.php" <?php if ($recharge_page == 1) {?> onclick="refresh_service('mobile')" <?php }?> >
                            <i class="fas fas-4x fa-hand-holding-usd white"></i>
                            <span class="white">Request Money</span>
                        </a>
                    <?php }?>
                    <?php if ($o->user_type == "Distributor" || $o->user_type == "Master Distributor"|| $o->user_type == "White Label") {?>
                        <a class="nav-link collapsed " href="send_money.php" >
                            <i class="fas fas-4x fa-hand-holding-usd white"></i>
                            <span class="white">Send Money</span>
                        </a>
                    <?php }?>
                </li>

                <?php if ($o->user_type == "Distributor" || $o->user_type == "Master Distributor"|| $o->user_type == "White Label") {?>
                  <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse90" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fa fa-fw fa-cart-plus white"></i>
                            <span class="white">Money Requests</span>
                        </a>
                        <div id="collapse90" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="pending_requests.php">Pending Request</a>
                                <a class="collapse-item" href="reject_money.php">Reject Request </a>

                            </div>

                        </div>

                    </li>


                <?php }?>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Search -->
                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                             <?php if ($res_css[0]['white_label_id'] == $_SESSION['user_id']  ) { ?>
                             <img src = "./img/logo/<?=$res_css[0]['img_logo'];?>" style=" height:60px;" alt="Logo" class="img-responsive" />
                           <?php } else { ?>
                              <img src="./img/<?=$res_site[0]['logo'];?>" style=" height:60px;" alt="Logo" class="img-responsive" />
                          <?php } ?>
                        </div>

                    </div>
                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            Welcome To * <span style="color:#000">  <?=$o->name?>  </span>   * <?=$o->user_type?> Panel
                        </div>

                    </div>
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <img src="../img/<?=$res_site[0]['logo'];?>" style="width:160px; height:80px;" alt="Logo" class="img-responsive" />
                        </li>
                        <!-- Nav Item - Alerts -->

<?php if ($o->user_type == "API User") {?>
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <a class="nav-link dropdown-toggle green_wallet " href="#" id="apis" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        APIs
                                        <!-- Counter - Messages -->

                                    </a>
                                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                        <h6 class="dropdown-header">
                                            API Configuration
                                        </h6>
                                        <a class="dropdown-item d-flex align-items-center" href="api_ip_key.php">
                                            IP & Key Configuration
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="api_recharge.php">
                                            Recharge API
                                        </a>
                                        
                                        <a class="dropdown-item d-flex align-items-center" href="api_call_back.php">
                                            Call Back URL & Response
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="api_recharge_status.php">
                                            Recharge Status Check
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="api_operator_codes.php">
                                            Operator / Circle Code
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="api_balance_check.php">
                                            Balance Check
                                        </a>
                                    </div>
                                </li>
<?php } ?>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="show_notifications()">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter" id="notifications"></span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <div id="my_notifications">

                                </div>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle green_wallet " href="#" >
                                <i class="fas fa-rupee-sign fa-fw"></i> <span id="amount_balance"><?=round($o->amount_balance, 3);?> </span>
                                <!-- Counter - Messages -->

                            </a>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$o->employee_name;?></span>
                                <div id="header_profile_pic">
                                    <img class="img-profile rounded-circle" src="<?=$my_profile_pic;?>" style="width:100px;height:80px;"  />
                                </div>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="change_password.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    My Profile
                                </a>
                                <?php if ($o->user_type != "DSE") {?>
                                    <a class="dropdown-item" href="commission_structure.php">
                                        <i class="fas fa-rupee-sign fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Commission Structure
                                    </a>
                                <?php }?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <?php if ($row_notice == 1) {?>
                    <div class="container-fluid" style="margin-top:10px;margin-bottom: 10px;">
                        <div class="row">
                            <div class="col-md-12 text-danger text-white">
                                <marquee width="75%"><?=$res_notice[0]['notice_details'];?></marquee>
                            </div>
                        </div>
                    </div>
                <?php }?>
                    <!-- End of Topbar -->
