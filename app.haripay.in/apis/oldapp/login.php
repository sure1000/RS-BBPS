<?php 
session_start();
if($_SESSION['user_id']) {
	header('location:home');
	exit;
}

//$page = 'home';
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
							<img style="width: 380px;height: 100px;" src="../../img/abhipay.png" alt="">
							</div>
						</div>
						<div class="form_wrap">
							<form id="loginform" action="home" class="form">
								<div class="input_container">
									<div class="input_wrap">
										<div class="input_field">
											<input type="text" name="username" id="username" value="<?php echo $_COOKIE['rem_me']==1?$_COOKIE['username']:''; ?>" class="input" placeholder="Mobile Number" style="height: 60px;font-size: 20px;font-weight: bold;">
										</div>
										<div class="icon">
											<span class="material-icons">
												smartphone
											</span>
										</div>
									</div>
									<div class="input_wrap">
										<div class="input_field">
											<input type="password" name="password" id="password" value="<?php echo $_COOKIE['rem_me']==1?$_COOKIE['password']:''; ?>" class="input" placeholder="Password" style="height: 60px;font-size: 20px;font-weight: bold;">
										</div>
										<div class="icon">
											<span class="material-icons">
												vpn_key
												</span>
										</div>
									</div>
								</div>
								<div class="btn_forgot_pass">
									<div class="login_btn">
										<input type="button" value="Login Now" id="login" class="input_submit" style="height: 50px;width:155px;font-size: 20px;">
									</div>
									<div class="forgot_pwd_wrap">
										<div class="forgot_pwd">
											<!--p>Forgot Password?</p-->
											<br />
											<p style="height: px;padding-bottom: 10px;font-size: 18px;color: white;"><input type="checkbox" name="rem_me" id="rem_me" <?php echo $_COOKIE['rem_me']==1?'checked':''; ?> value="1"> Remember Me</p>
										</div>
									</div>
								</div>	
									
							</form>
						</div>
						<div class="signup_link_wrap">
							<div class="signup_link">
								
								<span style="font-size: 18px;color: white;">
									<a href="./forget">Forget Password</a>
								</span>
							</div>
						</div>
						<!--div class="signup_link_wrap">
							<div class="signup_link">
								<span class="text">
									Create New Account?
								</span>
								<span class="lsignup_btn">
									Sign Up
								</span>
							</div>
						</div-->
					</div>
				</div>
			</div>
			<div class="main_slider">
				<div id="signup_page" class="signup_page">
				<div class="sp_wrap">
					<div class="header_wrap_login">
						<!--div class="header">
							<img src="logo.png" alt="">
						</div-->
					</div>
					<div class="signup_body">
						<div class="form">
							<div class="form_top">
								<div class="title">
									<img style="width: 100px;height: 90px;" src="../../img/kwikpaylogo.png" alt="">
								</div>
							</div>
							<div class="form_wrap">
								<form id="signup">
									<div class="input_container">
									<div class="input_wrap">
										<div class="input_field">
											<input type="text" class="input" placeholder="Username">
										</div>
										<div class="icon">
											<span class="material-icons">
												person
											</span>
										</div>
									</div>
									<div class="input_wrap">
										<div class="input_field">
											<input type="text" class="input" placeholder="Email Address">
										</div>
										<div class="icon">
											<span class="material-icons">
												local_post_office
											</span>
										</div>
									</div>
									<div class="input_wrap">
										<div class="input_field">
											<input type="password" class="input" placeholder="Password">
										</div>
										<div class="icon">
											<span class="material-icons">
												vpn_key
												</span>
										</div>
									</div>
									<div class="input_wrap">
										<div class="input_field">
											<input type="password" class="input" placeholder="Confirm password">
										</div>
										<div class="icon">
											<span class="material-icons">
												vpn_key
												</span>
										</div>
									</div>
									</div>
									<div class="signup_btn_wrap">
										<div class="signup_btn">
											<input type="submit" value="Signup" class="input_submit">
										</div>
									</div>
								</form>
							</div>
							<div class="login_link_wrap">
								<div class="login_link">
									<span class="text">
										Have an account.
									</span>
									<span class="slogin_btn">
										Login 
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>	
<?php include("include/footer.php"); ?> 