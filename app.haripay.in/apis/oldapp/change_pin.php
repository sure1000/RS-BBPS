<?php include("include/header.php"); $page='pin'; ?>
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
							Change Pin
						</p>
					</div>
				</div>
					<div class="form">               
						
						<div class="form_wrap">
							<form id="prepaid"  class="form" method="post">
								<div class="input_container">
									<div class="input_wrap">
										<div class="input_field">
							        <input type="number"  id="oldp" class="input" maxlength="4" placeholder="Old Pin" style="height: 60px;font-size: 25px;font-weight: bold;">
										</div>
										<div class="icon">
											<span class="material-icons">
												vpn_key
											</span>
										</div>
									</div>
		                                  <div class="input_wrap">
										<div class="input_field">
							        <input type="number"  id="oldn" class="input" maxlength="4" placeholder="New Pin" style="height: 60px;font-size: 25px;font-weight: bold;">
										</div>
										<div class="icon">
											<span class="material-icons">
												vpn_key
											</span>
										</div>
									</div>
										<!--div class="input_wrap">
										<div class="input_field">
							        <input type="number"  id="oldc" class="input" maxlength="4" placeholder="Confirm Pin" style="height: 60px;font-size: 25px;font-weight: bold;">
										</div>
										<div class="icon">
											<span class="material-icons">
												vpn_key
											</span>
										</div>
									</div-->
								<div class="btn_forgot_pass">
									<div class="login_btn">
										<input type="button" id="submit" value="Change Pin" class="input_submit" style="margin-top: 10%;font-size: 16px;width: 100%;border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
									</div>
									
									</div>
								</div>	
							</form>
						</div>
	
<?php include("include/footer.php"); ?> 