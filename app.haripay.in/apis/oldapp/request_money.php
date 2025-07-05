<?php 

include("include/header.php"); $page = 'r_money';

?>
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
							Request Money
						</p>
					</div>
				</div>
					<div class="form">               
						
						<div class="form_wrap" style="margin: 15px;">
							<form id="prepaid"  class="form" method="post">
								<div class="input_container" style="margin: 0 auto 2px;">
									<div class="input_wrap">
										<div class="input_field">
							         <select  class="input" name="request_user" id="request_user" style="font-weight: bold;width: 49%;height: 45px;padding-left: 15px;">
							             <option value="<?php echo $_SESSION['parent_id'];?>">My Parent</option>
                                                <option value="1">Super Admin</option>
                                                
                                     </select>
                                     <select  class="input" name="payment_mode" id="payment_mode" style="font-weight: bold;width: 49%;height: 45px;padding-left: 15px;">
                                                <option value="">Mode Type</option>
                                                <option value="IMPS">IMPS</option>
                                                <option value="NEFT">NEFT</option>
                                                <option value="RTGS">RTGS</option>
                                                <option value="UPI">UPI</option>
                                                
                                     </select>
										</div>
										
									</div>
									 <div class="input_wrap">
										<div class="input_field">
											<select  class="input" name="bank_list" id="bank_list" style="font-weight: bold;height: 45px;">
                                                <option value=""></value>
                                                
                                     </select>
										</div>
										<div class="icon">
											<span class="material-icons">
												account_balance
											</span>
										</div>
									</div>
									
		                                  <div class="input_wrap">
										<div class="input_field">
							        <input type="number" name="request_money"  id="request_money" class="input" maxlength="8" placeholder="Amount" style="height: 45px;font-size: 25px;font-weight: bold;">
										</div>
										<div class="icon">
											<span class="material-icons">
												account_balance
											</span>
										</div>
									</div>
									
										<div class="input_wrap">
										<div class="input_field">
							        <input type="text"  name="remark" id="transaction_number" class="input" placeholder="Remark" style="height: 60px;font-size: 25px;font-weight: bold;height: 45px;">
										</div>
										<div class="icon">
											<span class="material-icons">
												note
											</span>
										</div>
									</div>
								<div class="input_wrap">
										<div class="input_field">
										<input type="button" id="submit" value="Send Request"  class="input_submit" style="margin-top: 0%;font-size: 16px;width: 100%;border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
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