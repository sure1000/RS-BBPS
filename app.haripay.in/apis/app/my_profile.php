<?php include("include/header.php"); $page = 'profile'; ?>
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
                        <h5 class="mb-0">My Profile</h5>
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
		<form id="loginform" method="post" >
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group float-label mb-0">
                            <input type="text" name="name" id="name" placeholder="Name" autocomplete="off" class="form-control" autofocus="">
                        </div>
                         <div class="form-group float-label mb-0">
                            <input type="number" name="mobile" id="mobile"  placeholder="Mobile" autocomplete="off" class="form-control" >
                            
                        </div>
						 <div class="form-group float-label mb-0">
                            <input type="email" name="email" id="email"  placeholder="Email" autocomplete="off" class="form-control" >
                           
                        </div>
						 <div class="form-group float-label mb-0">
                            <input type="text" name="user_address" id="user_address"  placeholder="Address" autocomplete="off" class="form-control" >
                            
                        </div>
						 <div class="form-group float-label mb-0">
                            <input type="text" name="company_name" id="company_name"  placeholder="Company/Shop" autocomplete="off" class="form-control" >
                           
                        </div>
						 <div class="form-group float-label mb-0">
                            <input type="text" name="gst_no" id="gst_no" autocomplete="off" placeholder="GST No." class="form-control" >
                            
                        </div>
						 <div class="form-group float-label mb-0">
                            <input type="text" name="pancard" id="pancard"  autocomplete="off" placeholder="Pancard" class="form-control" >
                          
                        </div>
						 <div class="form-group float-label mb-0">
                            <input type="text" name="adhaar_card" id="adhaar_card"  autocomplete="off" placeholder="Adhaar No." class="form-control" >
                           
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="button" id="Update" value="Update" class="btn btn-primary btn-block rounded">
                    </div>
                </div>
            </div>
			</form>
        </div>
		<!-- page content end -->
       
    </main>
<?php include("include/footer.php"); ?> 