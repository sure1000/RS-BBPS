<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="All In One Recharge Api">
        <meta name="author" content="<?=$res_site[0]['site_name'];?>">
        <link rel="icon" type="image/png" href="../img/<?=$res_site[0]['logo'];?>">
        <title><?=$res_site[0]['site_name'];?></title>
        <!-- Custom fonts for this template-->
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="../css/sb-admin-2.css" rel="stylesheet">
        <script src="../vendor/sweetalert/sweetalert.js"></script>
    </head>
    <body class="bg-gradient-primary">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <img src="../img/<?=$res_site[0]['logo'];?>" width="200" alt="logo" />
                                        </div>
                                        <div id="form_login">
                                            <form class="user" name="bz" id="bz" method="post" action="login_check.php" onsubmit="return false;">
                                                
                                                <div class="text-center">
                                                    <br>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address..." required="required" />
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password" />
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" name="login" id="login" class="btn btn-primary btn-user btn-block" value="Login" />
                                                    <input type="hidden" name="updte" id="updte" value="1" />
                                                    <input type="hidden" name="msg_id" id="msg_id" value="<?=$msg_id;?>" />
                                                </div>
                                                
                                                
                                                
                                                <hr>
                                                
                                            </form>
                                            
                                            <div class="text-center">
                                                <a class="small" href="#" onclick="forgot_password()">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <?php include "html/forgot_password.php"; ?>
                                        <?php include "html/reset_password.php"; ?>
                                        <?php include "html/opt_verify.php"; ?>
                                        <div id="processing" style="display:none;width:100%;text-align: center;">
                                            <?php include "html/processing.php"; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="../js/sb-admin-2.min.js"></script>
    </body>
</html>