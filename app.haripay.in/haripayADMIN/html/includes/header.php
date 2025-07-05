<!DOCTYPE html>
<html lang="en">
    <head><meta charset="gb18030">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" href="../img/<?= $res_site[0]['logo']; ?>">
        <title><?= $res_site[0]['site_name']; ?></title>
        <link href="../vendor/bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <!-- Custom fonts for this template-->
        <link href="../vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="../css/sb-admin-2.css" rel="stylesheet">
        <script src="../vendor/sweetalert/sweetalert.js"></script>
        <?php if ($tables == 1) { ?>
            <!--Datatables condition. These are used to install and implement datatables -->
            <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
            <link href="../vendor/datatables/buttons.dataTables.min.css" rel="stylesheet">
        <?php } ?>
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                <!-- Sidebar - Brand -->

                <!-- Divider -->
                <hr class="sidebar-divider my-0">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="index">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-users white"></i>
                        <span class="white">Members</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="team">Members List</a>
                            <a class="collapse-item" href="team_details">Add Member</a>
                            <!--a class="collapse-item" href="admin_md_list">White Label</a-->
                            <a class="collapse-item" href="admin_md_list"> Master Distributor</a>
                            <a class="collapse-item" href="admin_distributers_list"> Distributers</a>
                            <a class="collapse-item" href="admin_retailer_list"> Retailers</a>
                            <a class="collapse-item" href="admin_apiuser_list"> Api Users</a>
                            
                            
                        </div>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse90" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fa fa-fw fa-cart-plus white"></i>
                        <span class="white">Money Requests</span>
                    </a>
                    <div id="collapse90" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="pending_requests">Pending Request</a>
                            <a class="collapse-item" href="reject_money">Reject Request </a>
                            <a class="collapse-item" href="approved_money">Approved Request </a>


                        </div>

                    </div>

                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fa fa-list-alt white"></i>
                        <span class="white">History</span>
                    </a>
                    <div id="collapse4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="recharge_history">Recharge</a>
                            <a class="collapse-item" href="all_history">All History</a>
                            <a class="collapse-item" href="wallet_history">Wallet History</a>
                            <a class="collapse-item" href="admin_fund">Admin Fund Transfer </a>
                            <a class="collapse-item" href="disputes">Disputes </a>
                            
                        </div>

                    </div>
                </li>
                             <li class="nav-item">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
                                        <i class="fas fa-fw fa-file white"></i>
                                        <span class="white">Reports</span>
                                    </a>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                        <div class="bg-white py-2 collapse-inner rounded">
                                            <a class="collapse-item" target="_shiba" href="live_report">Live Reports</a>
                                            <a class="collapse-item" href="recharges">Txn Wise</a>
                                            <a class="collapse-item" href="top_up">Topup Wise</a>
                                            <a class="collapse-item" href="business_user">User Wise</a>
                                            <a class="collapse-item" href="business_operator">Operator Wise</a>
                                            <a class="collapse-item" href="business_api">Api Wise</a>
                                            <a class="collapse-item" href="disputes">Complain history </a>
                                            <a class="collapse-item" href="report_new_user">New user </a>
                
                
                
                                        </div>
                                    </div>
                                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cogs white"></i>
                        <span class="white">Settings</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="services">Services</a>
                            <a class="collapse-item" href="providers">Providers</a>
                            <a class="collapse-item" href="apis">API(s)</a>
                            <a class="collapse-item" href="plans">User Plans</a>
                            <a class="collapse-item" href="dmr_commission">DMR Commission</a>
                            <a class="collapse-item" href="payment_options">Payment Options</a>
                            <a class="collapse-item" href="website_settings?aid=1">Website Setting</a>
                            <a class="collapse-item" href="upi_settings">UPI Setting</a>
                            <a class="collapse-item" href="banner_setting">Benner Setting</a>
                            <!--a class="collapse-item" href="upi_options">UPI App Options</a-->
                            <!--a class="collapse-item" href="email_settings">Email Setting</a-->
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-bell white"></i>
                        <span class="white">Notice Board</span>
                    </a>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="notice_board">Notice Board </a>
                            <a class="collapse-item" href="notification">Notifications</a>

                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseROUTES" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-space-shuttle white"></i>
                        <span class="white">Routes</span>
                    </a>
                    <div id="collapseROUTES" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="routes">Priority</a>
                            <a class="collapse-item" href="route_members">Members</a>
                            <a class="collapse-item" href="route_per_service">Service</a>
                            <a class="collapse-item" href="route_per_operator">Operators</a>
                            <a class="collapse-item" href="route_per_amount">Amount</a>
                            <a class="collapse-item" href="route_per_plan">Plans</a>
                        </div>
                    </div>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="send_sms">
                        <i class="fas fa-fw fa-envelope white"></i>
                        <span>Send SMS </span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fa fa-file  white"></i>
                        <span class="white">Report</span>
                    </a>
                    <div id="collapse7" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="excel_report">Report</a>

                        </div>

                    </div>
                </li>
                <!-- Nav Item - Utilities Collapse Menu -->

                <!-- Heading -->


                <!-- Divider -->
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
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <img src="../img/<?= $res_site[0]['logo']; ?>" style=" height:60px;" alt="Logo" class="img-responsive" />
                            </div>
                        </form>
                        
                         <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <a href="team_details" class="swiper-slide text-white">
                            <div class="input-group">
                                <img src="../img/addmember.png" style=" height:45px;" alt="Logo" class="img-responsive" />
                            </div>
                        </form>
                        
                        
                           <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <a href="team" class="swiper-slide text-white">
                            <div class="input-group">
                                <img src="../img/memberlist.png" style=" height:45px;" alt="Logo" class="img-responsive" />
                            </div>
                        </form>
                        
                        
                        
                         <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <a href="approved_money" class="swiper-slide text-white">
                            <div class="input-group">
                                <img src="../img/account.png" style=" height:45px;" alt="Logo" class="img-responsive" />
                            </div>
                        </form>
                        
                        
                        
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <a href="api_details.php" class="swiper-slide text-white">
                            <div class="input-group">
                                <img src="../img/addapi.png" style=" height:45px;" alt="Logo" class="img-responsive" />
                            </div>
                        </form>
                        
                           
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <a href="recharge_history" class="swiper-slide text-white">
                            <div class="input-group">
                                <img src="../img/rechargehistory.png" style=" height:50px;" alt="Logo" class="img-responsive" />
                            </div>
                        </form>
                        
                        
                        
                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <img src="../img/<?= $res_site[0]['logo']; ?>" style="width:160px; height:70px;" alt="Logo" class="img-responsive" />
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="show_admin_notifications()">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter" id="admin_notifications"></span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" style="overflow: scroll; height: 400px;">
                                    <h6 class="dropdown-header">
                                        Alerts Center
                                    </h6>
                                    <div id="my_admin_notifications">

                                    </div>
                                    <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 12, 2019</div>
                                            <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                        </div>
                                    </a> -->
                                    <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-success">
                                                <i class="fas fa-donate text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 7, 2019</div>
                                            $290.29 has been deposited into your account!
                                        </div>
                                    </a> -->
                                    <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-warning">
                                                <i class="fas fa-exclamation-triangle text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">December 2, 2019</div>
                                            Spending Alert: We've noticed unusually high spending for your account.
                                        </div>
                                    </a> -->
                                    <a class="dropdown-item text-center small text-gray-500" href="notification">Show All Alerts</a>
                                </div>
                            </li>
                            <!-- Nav Item - Messages -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="show_notifications()">
                                    <i class="fas fa-envelope fa-fw"></i>
                                    <!-- Counter - Messages -->
                                    <span class="badge badge-danger badge-counter" id="notifications"></span>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" id="alerts" aria-labelledby="messagesDropdown" >
                                    <h6 class="dropdown-header">
                                        Message Center
                                    </h6>
                                    <div id="my_notifications">

                                    </div>
                                    <!-- <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="../img/avatar.svg" alt="">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                            <div class="small text-gray-500">Emily Fowler · 58m</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="../img/avatar.svg" alt="">
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                                            <div class="small text-gray-500">Jae Chun · 1d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="../img/avatar.svg" alt="">
                                            <div class="status-indicator bg-warning"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                                            <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="../img/avatar.svg" alt="">
                                            <div class="status-indicator bg-success"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                                            <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                        </div>
                                    </a>-->
                                    <a class="dropdown-item text-center small text-gray-500" href="disputes">Read More Messages</a>
                                </div>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $o->employee_name; ?></span>
                                    <img class="img-profile rounded-circle" src="<?= $o->profile_pic; ?>" style=" height: 60px;">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="change_password">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Change Password

                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <!-- End of Topbar -->