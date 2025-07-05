<?php 
session_start();
if($_SESSION['user_id']) {
	header('location:home');
	exit;
}
$page = 'forget';

?>
<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Forgot</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/favicon180.png" sizes="180x180">
    <link rel="icon" href="img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="img/favicon16.png" sizes="16x16" type="image/png">

    <!-- Material icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&amp;display=swap" rel="stylesheet">

    <!-- swiper CSS -->
    <link href="HTML/vendor/swiper/css/swiper.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="HTML/css/style.css" rel="stylesheet" id="style">
</head>
<body class="body-scroll d-flex flex-column h-100 menu-overlay">
    <!-- screen loader -->
    <?php include("include/loder.php"); ?>
	 <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        <header class="header">
            <div class="row">
                <div class="col-auto px-0">
                    <button class="btn btn-40 btn-link back-btn" type="button">
                        <span class="material-icons">keyboard_arrow_left</span>
                    </button>
                </div>
                <div class="text-left col align-self-center">
                   
                </div>
                <div class="ml-auto col-auto align-self-center">
                    <a href="login" class="text-white">
                        Sign In
                    </a>
                </div>
            </div>
        </header>
        
        
        <div class="container h-100 text-white">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-3">Forgot<br>your password?</h2>
                            <p class="mb-5">Provide your registered email & mobile number to change password & pin.</p>
                            <div class="form-group float-label active">
                                <input type="number" name="number" id="number" class="form-control text-white" value="maxart@maxartkiller.com">
                                <label class="form-control-label text-white">Email/Mobile Number</label>
                            </div>
                          
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>

    <!-- footer-->
    <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
			<input type="button" value="Submit" id="login_forget" class="btn btn-default rounded btn-block">
                
            </div>
        </div>
    </div>
<?php include("include/footer.php"); ?> 