<?php include("include/header.php"); ?>
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
                        <h5 class="mb-0">Recharge Failed</h5>
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
       <div class="main-container h-100">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-12 col-md-6 col-lg-4 align-self-center text-center my-3 mx-auto">
                        <div class="icon icon-120 bg-danger-light text-danger rounded-circle mb-3">
                            <i class="material-icons display-4">clear</i>
                        </div>
                        <h2 class="display-2">Failed</h2>
                       
                        <br>
                        <a href="home" class="btn btn-default rounded">Go back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include("include/footer.php"); ?> 