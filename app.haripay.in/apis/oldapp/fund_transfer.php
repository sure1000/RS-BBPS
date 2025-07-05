<?php include("include/header.php"); $page = 'fund';?>
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
						
						<p class="title" style="font-size: 20px;text-align: center;padding-left: 28%;">
							Fund Transfer
						</p>
					</div>
				</div>
					<div class="form">
						
						<div class="form_wrap">
							<form id="prepaid"  class="form">
								<div class="input_container">
									
									<div class="input_wrap">
										<div class="input_field">
											<select class="input" id="user_list" style="font-weight: bold;font-size: 15px;">
                                                </select>
										</div>
										<div class="icon">
											<span class="material-icons">
												check_circle
											</span>
										</div>
									</div>
								
								<div class="input_wrap">
										<div class="input_field" >
									<input type="number" id="amount" class="input" placeholder="Amount" style="height: 50px;font-size: 25px;font-weight: bold;">
										</div>
										<div class="icon">
										<span class="material-icons">
												account_balance
											</span>
										</div>
									</div>
									<div class="input_wrap">
										<div class="input_field" >
									<input type="password" id="pin"  maxlength="4" class="input" autocomplete="off" placeholder="Pin" style="height: 50px;font-size: 25px;font-weight: bold;">
										</div>
										<div class="icon">
										<span class="material-icons">
												account_balance
											</span>
										</div>
									</div>
									
									
								<div class="btn_forgot_pass">
									<div class="login_btn">
										<input type="button" value="Send Now" id="input_submit" class="input_submit" style="margin-top: 10%;font-size: 16px;width: 100%;border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
									</div>
									
									</div>
								</div>	
							</form>
						</div>
	
	
<?php include("include/footer.php"); ?> 