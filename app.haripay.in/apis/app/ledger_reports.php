<?php include("include/header.php"); $page = 'ledger_reports'; ?>
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
                        <h5 class="mb-0">Ledger Reports</h5>
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
                    <div class="card-body">
                        <div class="form-group float-label mb-0">
                            <input type="date" value="<?php echo date('Y-m-d');?>" id="date_from" class="form-control">
                           
                        </div>
						<div class="form-group float-label mb-0">
                           <input type="date" value="<?php echo date('Y-m-d');?>" id="date_to" class="form-control">
                            
                        </div>
						
						<div class="form-group float-label mb-0">
                            <input type="number" id="mobile"  autocomplete="off" class="form-control" autofocus="">
                            <label class="form-control-label">Ref Number</label>
                        </div>
						
                    </div>
                    <div class="card-footer">
                        <input type="button" id="input_submit" value="Search Records" class="btn btn-primary btn-block rounded">
                    </div>
                </div>
				<br>
              <div id="results">
					
				</div>
            </div>
        </div>
		<!-- page content end -->
       
    </main>
<?php include("include/footer.php"); ?> 