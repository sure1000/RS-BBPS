<?php include("include/header.php"); $page='home'; 
?>

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    <!-- screen loader -->
    <?php include("include/loder.php"); ?>



    <!-- menu main -->
    <div class="main-menu">
        <div class="row mb-4 no-gutters">
            <div class="col-auto"><button class="btn btn-link btn-40 btn-close text-white"><span class="material-icons">chevron_left</span></button></div>
            <div class="col-auto">
                
            </div>
            <div class="col pl-3 text-left align-self-center">
                <h6 class="mb-1" id="name1" >Shiba Technology</h6>
                <p class="small text-default-secondary" id="user_type">Shiba Technology</p>
            </div>
        </div>
        <div class="menu-container">
            <div class="row mb-4">
                <div class="col">
                    <h4 class="mb-1 font-weight-normal" id="amount_balance" ></h4>
                    <p class="text-default-secondary">My Balance</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-default btn-40 rounded-circle" id="addmoney"><i class="material-icons">add</i></button>
                </div>
            </div>

            <ul class="nav nav-pills flex-column ">
                <li class="nav-item">
                    <a class="nav-link active" href="home">
                        <div>
                            <span class="material-icons icon">account_balance</span>
                            Home
                        </div>
                        <span class="arrow material-icons">chevron_right</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="transaction_history">
                        <div>
                            <span class="material-icons icon">insert_chart</span>
                            Transaction
                        </div>
                        <span class="arrow material-icons">chevron_right</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="wallet_history">
                        <div>
                            <span class="material-icons icon">perm_contact_calendar</span>
                            Wallet History
                        </div>
                        <span class="arrow material-icons">chevron_right</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ledger_reports">
                        <div>
                            <span class="material-icons icon">book</span>
                            Ledger History
                        </div>
                        <span class="arrow material-icons">chevron_right</span>
                    </a>
                </li>
				<li class="nav-item">
                    <a class="nav-link" href="my_commission">
                        <div>
                            <span class="material-icons icon">card_giftcard</span>
                            My Commission
                        </div>
                        <span class="arrow material-icons">chevron_right</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my_profile">
                        <div>
                            <span class="material-icons icon">account_circle</span>
                            My Profile
                        </div>
                        <span class="arrow material-icons">chevron_right</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="support_bank">
                        <div>
                            <span class="material-icons icon">help</span>
                            Support & Bank
                        </div>
                        <span class="arrow material-icons">chevron_right</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="change_pin">
                        <div>
                            <span class="material-icons icon">vpn_key</span>
                            Change Pin
                        </div>
                        <span class="arrow material-icons">chevron_right</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="change_password">
                        <div>
                            <span class="material-icons icon">vpn_key</span>
                            Change Password
                        </div>
                        <span class="arrow material-icons">chevron_right</span>
                    </a>
                </li>
            </ul>
            <div class="text-center">
                <a href="logout" class="btn btn-outline-danger text-white rounded my-3 mx-auto">Sign out</a>
            </div>
        </div>
    </div>
    <div class="backdrop"></div>
    

    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        <header class="header">
            <div class="row">
                <div class="col-auto px-0">
                    <button class="menu-btn btn btn-40 btn-link" type="button">
                        <span class="material-icons">menu</span>
                    </button>
                </div>
                <div class="text-left col align-self-center">
                    <a class="navbar-brand" href="#">
                        <h5 style="font-size: 20px;font-weight: bold;font-family: 'Proxima Nova';" id="amount_balance2"></h5>
                    </a>
                </div>
                <div class="ml-auto col-auto pl-0">
                    
                    
                    <a href="my_profile" class="avatar avatar-30 shadow-sm rounded-circle ml-2">
                        <figure class="m-0 background">
                            <img src="HTML/img/user1.png" alt="">
                        </figure>
                    </a>
                </div>
            </div>
        </header>

       

        <div class="main-container">
            <!-- page content start 
<div class="container mb-4" >
                <!-- Swiper 
                <div class="swiper-container offerslidetab1">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="card overflow-hidden">
                                <div class="background opacity-30">
                                    <img src="HTML/img/image8.jpg" alt="">
                                </div>
                                <div class="card-body text-white">
                                    <h3 class="font-weight-normal">50% off<br>Winter Collection</h3>
                                    <p class="text-mute">Best product and collections</p>
                                    <div class="text-right">
                                        <a href="#" class="btn btn-sm btn-default rounded">Show Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card overflow-hidden">
                                <div class="background opacity-30">
                                    <img src="HTML/img/image9.jpg" alt="">
                                </div>
                                <div class="card-body text-white">
                                    <h3 class="font-weight-normal">10% Instant<br>on Credit Cards</h3>
                                    <p class="text-mute">Best product and collections</p>
                                    <div class="text-right">
                                        <a href="#" class="btn btn-sm btn-default rounded">Show Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card overflow-hidden">
                                <div class="background opacity-30">
                                    <img src="HTML/img/image8.jpg" alt="">
                                </div>
                                <div class="card-body text-white">
                                    <h3 class="font-weight-normal">40% Flat<br>Off on Addidaas </h3>
                                    <p class="text-mute">Best product and collections</p>
                                    <div class="text-right">
                                        <a href="#" class="btn btn-sm btn-default rounded">Show Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Add Pagination 
                    <div class="swiper-pagination white-pagination text-left pl-2 mb-3"></div>
                </div>
            </div>-->
            <div class="container mb-4 text-center">
                <div class="card bg-default-secondary shadow-default">
                    <div class="card-body">
                        <!-- Swiper -->
                        <div class="swiper-container addsendcarousel text-center">
                            <div class="swiper-wrapper mb-4">
                                <a href="request_money" class="swiper-slide text-white">
                                    <div class="icon icon-50 rounded-circle mb-2 bg-white-light" style="background-color: #e8dd76 !important;"><img src="include/sicon/addfund.svg" style="width: 30px;height: 30px;"></div>
                                    <p><small>Add Fund</small></p>
                                </a>
                                <a href="wallet_history" class="swiper-slide text-white">
                                    <div class="icon icon-50 rounded-circle mb-2 bg-white-light" style="background-color: #ff52a1 !important;"><img src="include/sicon/wallet.svg" style="width: 30px;height: 30px;"></div>
                                    <p><small>Wallet</small></p>
                                </a>
                                <a href="transaction_history" class="swiper-slide text-white">
                                    <div class="icon icon-50 rounded-circle mb-2 bg-white-light" style="background-color: #f37f1f !important;"><img src="include/sicon/history.svg" style="width: 30px;height: 30px;"></div>
                                    <p><small>History</small></p>
                                </a>
								<a href="add_money" class="swiper-slide text-white">
                                    <div class="icon icon-50 rounded-circle mb-2 bg-white-light" style="background-color: #20c796 !important;"><img src="include/sicon/upi.png" style="width: 30px;height: 30px;"></div>
                                    <p><small>AdMoney</small></p>
                                </a>
                                <a href="ledger_reports" class="swiper-slide text-white">
                                    <div class="icon icon-50 rounded-circle mb-2 bg-white-light" style="background-color: #20c796 !important;"><img src="include/sicon/ledger.svg" style="width: 30px;height: 30px;"></div>
                                    <p><small>Ledger</small></p>
                                </a>
                                
                            </div>
                            <!-- Add Pagination 
                            <div class="swiper-pagination"></div>-->
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="container mb-4">
			<div class="card">
			<marquee style="color: red;font-size: 17px;" id="welcome">
                    Welcome 
					</marquee>
                </div><br>
                <div class="card">
                    <div class="card-body text-center ">
                        <div class="row justify-content-equal no-gutters">
						<?php if($_SESSION['user_type']=='Retailer'){ ?>
                            <div class="col-4 col-md-2 mb-3">
                                <a href="prepaid" class="icon icon-50 rounded-circle mb-1 bg-default-light text-default" style="background-color: #ff52a1 !important;">
								<img src="include/sicon/mobile.svg" style="width: 30px;height: 30px;">
								</a>
                                <p class="text-secondary"><small>Mobile</small></p>
                            </div>
                            <div class="col-4 col-md-2 mb-3">
                                <a href="dth" class="icon icon-50 rounded-circle mb-1 bg-default-light text-default" style="background-color: #20c796 !important;"><img src="include/sicon/tv.svg" style="width: 30px;height: 30px;"></a>
                                <p class="text-secondary"><small>DTH</small></p>
                            </div>
                            <div class="col-4 col-md-2 mb-3">
                                <a href="comming" class="icon icon-50 rounded-circle mb-1 bg-default-light text-default" style="background-color: #f37f1f !important;"><img src="include/sicon/postpaid.svg" style="width: 30px;height: 30px;"></a>
                                <p class="text-secondary"><small>Postpaid</small></p>
                            </div>
                            <div class="col-4 col-md-2 mb-3">
                                <a href="comming" class="icon icon-50 rounded-circle mb-1 bg-default-light text-default" style="background-color: #e8dd76 !important;"><img src="include/sicon/datacard.svg" style="width: 30px;height: 30px;"></a>
                                <p class="text-secondary"><small>Datacard</small></p>
                            </div>
                            <div class="col-4 col-md-2 mb-3">
                                <a  href="comming" class="icon icon-50 rounded-circle mb-1 bg-default-light text-default" style="background-color: #32ce56 !important;"><img src="include/sicon/electri.svg" style="width: 30px;height: 30px;"></a>
                                <p class="text-secondary"><small>Electricity</small></p>
                            </div>
                            <div class="col-4 col-md-2 mb-3">
                                <a href="comming" class="icon icon-50 rounded-circle mb-1 bg-default-light text-default" style="background-color: #20c997 !important;"><img src="include/sicon/dmt.svg" style="width: 30px;height: 30px;"></a>
                                <p class="text-secondary"><small>Money Transfer</small></p>
                            </div>
							<div class="col-4 col-md-2 mb-3">
                                <a href="comming" class="icon icon-50 rounded-circle mb-1 bg-default-light text-default" style="background-color: #fd7e14 !important;"><img src="include/sicon/aeps.svg" style="width: 30px;height: 30px;"></a>
                                <p class="text-secondary"><small>Aeps</small></p>
                            </div>
							<div class="col-4 col-md-2 mb-3">
                                <a href="comming" class="icon icon-50 rounded-circle mb-1 bg-default-light text-default" style="background-color: #20c997 !important;"><img src="include/sicon/insurence.svg" style="width: 30px;height: 30px;"></a>
                                <p class="text-secondary"><small>Insurance</small></p>
                            </div>
							<div class="col-4 col-md-2 mb-3">
                                <a href="comming" class="icon icon-50 rounded-circle mb-1 bg-default-light text-default" style="background-color: #40bace !important;"><img src="include/sicon/landline.svg" style="width: 30px;height: 30px;"></a>
                                <p class="text-secondary"><small>Landline</small></p>
                            </div>
                        </div>
                        
							<?php } ?>
							<?php if($_SESSION['user_type']=='Master Distributor' || $_SESSION['user_type']=='Distributor'){ ?>
							<div class="col-4 col-md-2 mb-3">
                                <a href="add_member" class="icon icon-50 rounded-circle mb-1 bg-default-light text-default" style="background-color: #fdb114 !important;"><img src="include/sicon/adduser.svg" style="width: 30px;height: 30px;"></a>
                                <p class="text-secondary"><small>Add Member</small></p>
                            </div>
							<div class="col-4 col-md-2 mb-3">
                                <a href="my_team" class="icon icon-50 rounded-circle mb-1 bg-default-light text-default" style="background-color: #20c796 !important;"><img src="include/sicon/userlist.svg" style="width: 30px;height: 30px;"></a>
                                <p class="text-secondary"><small>My Team</small></p>
                            </div>
							<div class="col-4 col-md-2 mb-3">
                                <a href="fund_transfer" class="icon icon-50 rounded-circle mb-1 bg-default-light text-default" style="background-color: #f79d51 !important;"><img src="include/sicon/fund.svg" style="width: 30px;height: 30px;"></a>
                                <p class="text-secondary"><small>Fund Transfer</small></p>
                            </div>
							<?php } ?>
                        </div>
						
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- footer
    <div class="footer">
        <div class="row no-gutters justify-content-center">
            <div class="col-auto">
                <a href="home" class="active">
                    <i class="material-icons">home</i>
                    <p>Home</p>
                </a>
            </div>
            <div class="col-auto">
                <a href="ledger_reports" class="">
                    <i class="material-icons">insert_chart_outline</i>
                    <p>Ledger</p>
                </a>
            </div>
            <div class="col-auto">
                <a href="wallet_history" class="">
                    <i class="material-icons">account_balance_wallet</i>
                    <p>Wallet</p>
                </a>
            </div>
            
            <div class="col-auto">
                <a href="my_profile" class="">
                    <i class="material-icons">account_circle</i>
                    <p>Profile</p>
                </a>
            </div>
        </div>
    </div>-->


    

<?php include("include/footer.php"); ?> 
