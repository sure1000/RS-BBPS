<?php include("include/header.php"); $page = 'w_history2'; ?>
<style>
.example_auto{
    height: 100%;
    overflow: auto;
    width: 100%; /*  just for demo */
    display: inline-block; /*  just for demo */
    vertical-align: top; /*  just for demo */
 
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
			
			<div class="all_page">
							<div class="header_wrap"style="height: 50px;">
					<div class="header">
						<a href="home" id="history_back_btn" class="back_btn">
							<span class="material-icons">
								keyboard_backspace
							</span>
						</a>
						<p class="title" style="font-size: 18px;">
							Wallet History
						</p>
					</div>
				</div>
					<div class="form">
						<div class="form_wrap" style="margin: 15px;">
							<form id="prepaid"  class="form">
								<div class="input_container">
								
									<div class="input_wrap">
											<div class="input_field">
											<input type="date" class="input" value="<?php echo date('Y-m-d');?>" id="date_from" style="height: 40px;width: 33.1%;font-weight: bold;font-size: 12px;padding-left: 10px;padding: 20px;">
						
											<input type="date" class="input" value="<?php echo date('Y-m-d');?>" id="date_to" style="height: 40px;width: 33.1%;font-weight: bold;font-size: 12px;padding-left: 10px;padding: 20px;">
                                               
                                                <select class="input" id="trtype" style="height: 40px;width: 30.1%;font-weight: bold;font-size: 12px;padding-left: 10px;padding: 5px;">
														<option value="">Select Type</option>
														<?php if($_SESSION['user_type']=='Retailer'){ ?>
														<option value="Recieve Money">Recieve Money</option>
														<option value="Reverse">Reverse</option>
														<?php } else if($_SESSION['user_type']!='Retailer'){ ?> 
														<option value="Send Money">Send Money</option>
														<?php } ?>
                                                </select>
										</div>
									
									</div>
	
								<div class="input_wrap">
										<div class="input_field" >
									<input type="text" id="mobile" class="input" placeholder="Ref Number" style="height: 40px;font-size: 15px;font-weight: bold;">
										</div>
										<div class="icon">
										<span class="material-icons">
												search
											</span>
										</div>
									</div>
								<div class="btn_forgot_pass">
									<div class="login_btn">
										<input type="button" id="input_submit" value="Search Records" class="input_submit" style="font-size: 16px;width: 100%;border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
									</div>
									
									</div>
								</div>	
							</form>
						</div>
						<div class="history_item_wrap">
		           <div class="example_auto">
                      
					<div id="results">
					
				</div>
					
	</div>
	</div>
<?php include("include/footer.php"); ?> 