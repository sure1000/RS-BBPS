<?php 
session_start();
if($_SESSION['user_id']) {
	header('location:home');
	exit;
}
$page = 'forget';

?>
<html lang="en"><head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="include/asstes/styles.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<style>
body {
 background: #308c7f;
}
.main_conatiner {
    background: #308c7f;
}
</style>
<body>
	 	<div class="main_wrapper">
		<div class="main_conatiner">
			<!-- Starting of the Loader -->
			<div class="loader">
				<div class="loader_inner">
					<img src="include/asstes/Spin-loader.gif" alt="loader">
				</div>
			</div>
			<!-- Ending of the Loader -->
	<div class="main_wrapper">
		<div class="main_conatiner">
			<div class="login_page">
				<div class="login_wrap">
					<div class="header_wrap_login">
						<!--div class="header">
							<img src="logo.png" alt="">
						</div-->
					</div>
					<div class="form">
						<div class="form_top">
							<div class="title">
							<img style="width: 200px;height: 120px;" src="../../img/kwikpaylogo.png" alt="">
							</div>
						</div>
						<div class="form_wrap">
							<form id="loginform" action="home" class="form">
								<div class="input_container">
									<div class="input_wrap">
										<div class="input_field">
											<input type="text" name="number" id="number" value="" class="input" placeholder="Mobile Number" style="height: 60px;font-size: 20px;font-weight: bold;">
										</div>
										<div class="icon">
											<span class="material-icons">
												smartphone
											</span>
										</div>
									</div>
									
								</div>
								<div class="btn_forgot_pass">
									<div class="login_btn">
										<input type="button" value="Submit" id="login_forget" class="input_submit" style="height: 50px;width:155px;font-size: 20px;">
									</div>
									
								</div>	
									
							</form>
						</div>
						<div class="signup_link_wrap">
							<div class="signup_link">
								
								<span style="font-size: 18px;color: white;">
									<a href="./login">Login</a>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>	
<?php include("include/footer.php"); ?> 