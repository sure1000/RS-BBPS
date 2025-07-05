<?php include("include/header.php"); $page='pin'; ?>
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
                        <h5 class="mb-0">Change Pin</h5>
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
                            <input type="number"  id="oldp" maxlength="4" autocomplete="off" class="form-control" autofocus="">
                           <label class="form-control-label">Old Pin</label>
                        </div>
						<div class="form-group float-label mb-0">
                           <input type="number"  id="oldn" maxlength="4" autocomplete="off" class="form-control">
                            <label class="form-control-label">New Pin</label>
                        </div>
						
						<div class="form-group float-label mb-0">
                            <input type="number"  id="oldc"  maxlength="4"  autocomplete="off" class="form-control">
                            <label class="form-control-label">Confirm Pin</label>
                        </div>
						
                    </div>
                    <div class="card-footer">
                        <input type="button" id="submit" value="Change Pin" class="btn btn-primary btn-block rounded">
                    </div>
                </div>
            </div>
        </div>

		<!-- page content end -->
       
    </main>
<?php include("include/footer.php"); ?> 