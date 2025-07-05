<?php include("include/header.php"); $page ='support'; ?>
<body class="body-scroll d-flex flex-column h-100 menu-overlay">
    <!-- screen loader -->
     <?php include("include/loder.php"); ?>
    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <header class="header">
            <div class="row">
                <div class="col-auto px-0">
                    <button class="btn btn-40 btn-link back-btn" type="button">
                        <span class="material-icons">keyboard_arrow_left</span>
                    </button>
                </div>
                <div class="text-left col align-self-center">
                    <a class="navbar-brand" href="#">
                        <h5 class="mb-0">Support & Bank</h5>
                    </a>
                </div>
                <div class="ml-auto col-auto">
                    <a href="my_profile" class="avatar avatar-30 shadow-sm rounded-circle ml-2">
                        <figure class="m-0 background">
                            <img src="HTML/img/user1.png" alt="">
                        </figure>
                    </a>
                </div>
            </div>
        </header>

        <!-- page content start -->
	<div class="main-container">
            <div class="container">
                <div class="card">
                    <div class="card-body px-0">
                        <ul class="list-group list-group-flush">
						<li class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto pr-0">
                                        
                                    </div>
                                    <div class="col align-self-center pr-0">
                                        <h6 class="font-weight-normal mb-1">Phone: <?php echo $phone ?></h6>
										
                                        <p class="small text-secondary">Email: <?php echo $email ?></p>
                                    </div>
                                    <div class="col-auto">
                                        <a href="tel:<?php echo $phone ?>" class="text-success"></a>
                                    </div>
                                </div>
                            </li>
                            <a id="results">
							 </ul>
                    </div>
                </div>
            </div>
        </div>
		<!-- page content end -->
       
    </main>
<?php include("include/footer.php"); ?> 