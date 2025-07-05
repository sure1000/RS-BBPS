<?php include("include/header.php"); $page ='prepaid'; ?>
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
						
						<p class="title" style="font-size: 20px;text-align: center;padding-left: 28%;">
							Prepaid Recharge
						</p>
					</div>
				</div>
					<div class="form">
						
						<div class="form_wrap">
							<form id="prepaid"  class="form">
								<div class="input_container">
									<div class="input_wrap">
										<div class="input_field">
							<input type="number"  id="number" class="input" maxlength="10" placeholder="Mobile Number" style="height: 60px;font-size: 25px;font-weight: bold;">
										</div>
										<div class="icon">
											<span class="material-icons">
												charging_station
											</span>
										</div>
									</div>
									<div class="input_wrap">
										<div class="input_field">
											<select class="input" id="opertor"  style="font-weight: bold;font-size: 15px;">
                                                </select>
										</div>
										<div class="icon">
											<span class="material-icons">
												check_circle
											</span>
										</div>
									</div>
									<div class="input_wrap">
										<div class="input_field">
											<select class="input" id="circle" style="font-weight: bold;font-size: 15px;">
                                                 
                                                </select>
										</div>
										<div class="icon">
											<span class="material-icons">
												location_city
											</span>
										</div>
									</div>
								<div class="input_wrap">
										<div class="input_field" >
									<input type="number" id="amount" min="5" max="3000" maxlength="4" autocomplete="off" class="input" placeholder="Amount" style="height: 50px;font-size: 25px;font-weight: bold;">
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
									
									<div class="input_wrap">
										<div class="input_field" style="padding-top: 35px;">
								
									<div class="login_btn" style="padding-bottom: 10px;">
										<input class="input_submit" type="button" id="roffer" value="Roffer" style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
									&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
										<input class="input_submit" type="button" id="plan" value="View Plans" style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
										</div>
										
									</div>
								</div>
								<div class="btn_forgot_pass">
									<div class="login_btn">
										<input type="button" id="input_submit" value="Pay Now" class="input_submit" style="margin-top: 0%;font-size: 16px;width:100%;border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
									</div>
									
									</div>
								</div>	
							</form>
						</div>
	
	<div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2 style="text-align:center">Rechrage Details</h2>
      </header>
      <div class="w3-container">
       <table align="center" style="margin-left: 63px;text-align: initial;">
			<tr class="msg1">
				<td>Status</td>
				<td> : </td>
				<td id="res_status"></td>
			</tr>
			<tr class="msg1">
				<td>Amount</td>
				<td> : </td>
				<td id="res_amount"></td>
			</tr>
			<tr class="msg1">
				<td>OP ID</td>
				<td> : </td>
				<td id="res_opid"></td>
			</tr>
			
			<tr class="msg2">
				<td>Message</td>
				<td> : </td>
				<td id="res_msg"></td>
			</tr>
		</table>
      </div>
      <footer class="w3-container w3-teal" style="text-align: center;">
        <input type="button" value="OK" onclick="document.getElementById('id01').style.display='none'" style="color: #f1f1f1;background: #dd5555;padding: 5px 50px;border: 0px;">
      </footer>
    </div>
  </div>
  
  
  <div id="roffer_div" class="w3-modal">
    <div class="w3-modal-content">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('roffer_div').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2 style="text-align:center">Roffer Details</h2>
      </header>
      <div class="example_auto">
      <div class="w3-container" id="roffer_result">			
      </div>
      </div>
      <footer class="w3-container w3-teal" style="text-align: center;">
        <input type="button" value="OK" onclick="document.getElementById('roffer_div').style.display='none'">
      </footer>
    </div>
  </div>
    
    
  <div id="plan_div" class="w3-modal">
    <div class="w3-modal-content">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('plan_div').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2 style="text-align:center">Plan Details</h2>
      </header>
      <div class="example_auto">
      <div class="w3-container" id="plan_result">			
      </div>
      </div>
      <footer class="w3-container w3-teal" style="text-align: center;">
        <input type="button" value="OK" onclick="document.getElementById('plan_div').style.display='none'">
      </footer>
    </div>
  </div>
  
  <style>
#roffer_div table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

#roffer_div table {
  border-collapse: collapse;
  width: 100%;
}

#roffer_div th, td {
  padding: 11px;
}
</style>

<?php include("include/footer.php"); ?> 