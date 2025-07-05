<?php 
session_start();
if($_SESSION['user_id']) {
	header('location:home');
	exit;
}

//$page = 'home';
?>
<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Login</title>

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
                    
                </div>
                <div class="text-left col align-self-center">
                   
                </div>
                <div class="ml-auto col-auto align-self-center">
                    <!--a href="signup.html" class="text-white">
                        Sign up
                    </a-->
                </div>
            </div>
        </header>
        
        
        <div class="container h-100 text-white">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-5">Login into<br>your account</h2>
                            <div class="form-group float-label active">
                                <input type="text" class="form-control text-white" name="username" id="username" value="<?php echo $_COOKIE['rem_me']==1?$_COOKIE['username']:''; ?>">
                                <label class="form-control-label text-white">Mobile/Email</label>
                            </div>
                            <div class="form-group float-label position-relative">
                                <input type="password" class="form-control text-white" name="password" id="password" value="<?php echo $_COOKIE['rem_me']==1?$_COOKIE['password']:''; ?>">
                                <label class="form-control-label text-white">Password</label>
                            </div>  
							<div class="form-group float-label position-relative">
							<p class="text-left"><input type="checkbox" name="rem_me" id="rem_me" <?php echo $_COOKIE['rem_me']==1?'checked':''; ?> value="1"> Remember Me</p>
							</div>
                            <p class="text-right"><a href="forget" class="text-white">Forgot Password/Pin?</a></p>
							
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
                <a value="Login Now" id="login" class="btn btn-default rounded btn-block">Login</a>
            </div>
        </div>
    </div>


    <!-- Required jquery and libraries -->
    <script src="HTML/js/jquery-3.3.1.min.js"></script>
    <script src="HTML/js/popper.min.js"></script>
    <script src="HTML/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- cookie js -->
    <script src="HTML/js/jquery.cookie.js"></script>

    <!-- Swiper slider  js-->
    <script src="HTML/vendor/swiper/js/swiper.min.js"></script>

    <!-- Customized jquery file  -->
    <script src="HTML/js/main.js"></script>
    <script src="HTML/js/color-scheme-demo.js"></script>


    <!-- page level custom script -->
    <script src="HTML/js/app.js"></script>
    
</body>
<?php include("include/footer.php"); ?> 