<?php include("include/header.php"); $page = 'password'; ?>
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
			
	               <div class="all_page">
							<div class="header_wrap"style="height: 50px;">
					<div class="header">
						<a href="home" id="history_back_btn" class="back_btn">
							<span class="material-icons">
								keyboard_backspace
							</span>
						</a>
						<p class="title" style="font-size: 18px;">
							Change Password
						</p>
					</div>
				</div>
					<div class="form">               
						
						<div class="form_wrap">
							<form id="prepaid"  class="form">
								<div class="input_container">
									<div class="input_wrap">
										<div class="input_field">
							        <input type="password"  id="oldp" class="input" maxlength="8" placeholder="Old Password" style="height: 60px;font-size: 25px;font-weight: bold;">
										</div>
										<div class="icon">
											<span class="material-icons">
												vpn_key
											</span>
										</div>
									</div>
		                                  <div class="input_wrap">
										<div class="input_field">
							        <input type="password"  id="oldn" class="input" maxlength="8" placeholder="New Password" style="height: 60px;font-size: 25px;font-weight: bold;">
										</div>
										<div class="icon">
											<span class="material-icons">
												vpn_key
											</span>
										</div>
									</div>
										<div class="input_wrap">
										<div class="input_field">
							        <input type="password"  id="oldc" class="input" maxlength="8" placeholder="Confirm Password" style="height: 60px;font-size: 25px;font-weight: bold;">
										</div>
										<div class="icon">
											<span class="material-icons">
												vpn_key
											</span>
										</div>
									</div>
								<div class="btn_forgot_pass">
									<div class="login_btn">
										<input type="button" id="c_submit" value="Change Password" class="input_submit" style="margin-top: 10%;font-size: 16px;width: 100%;border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
									</div>
									
									</div>
								</div>	
							</form>
						</div>
	
<?php include("include/footer.php"); ?> 