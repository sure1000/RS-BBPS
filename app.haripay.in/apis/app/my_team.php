<?php include("include/header.php"); $page = 'my_team'; ?>
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
                        <h5 class="mb-0">My Team</h5>
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
                <div class="card mb-4">
                    <div class="card-header border-0 bg-none">
                        <div class="row">
                            <div class="col align-self-center">
                                <h6 class="mb-0">My Team</h6>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="all font-weight-medium">ID</th>
                                    <th class="min-tablet font-weight-medium">Details</th>
                                    <th class=" font-weight-medium">Status</th>
                                </tr>
                            </thead>
                            <tbody id="results">
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
		<!-- page content end -->
       
    </main>
<?php include("include/footer.php"); ?> 