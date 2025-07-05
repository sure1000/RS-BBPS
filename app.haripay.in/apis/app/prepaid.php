<?php include("include/header.php"); $page ='prepaid'; ?>
<body class="body-scroll d-flex flex-column h-100 menu-overlay">
    <!-- screen loader -->
     <?php include("include/loder.php"); ?>
    <!-- Begin page content -->
    <main class="flex-shrink-0 main">
        <!-- Fixed navbar -->
        <header class="header">
            <div class="row">
                <div class="col-auto px-0">
                    <button class="btn btn-40 btn-link back-btn" type="button">
                        <span class="material-icons">keyboard_arrow_left</span>
                    </button>
                </div>
                <div class="text-left col align-self-center">
                    <a class="navbar-brand" href="#">
                        <h5 class="mb-0">Mobile Recharge</h5>
                    </a>
                </div>
                <div class="ml-auto col-auto">
                    <a href="my_profile" class="avatar avatar-30 shadow-sm rounded-circle ml-2">
                        <figure class="m-0 background">
                            <img src="HTML/img/user1.png" alt="">
                        </figure>
                    </a>
                </div>
            </div>
        </header>
        <form id="prepaid" nethod="post">
        <!-- page content start -->
		<div class="main-container">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group float-label mb-0">
                            <input type="number"  id="number" maxlength="10" class="form-control" autofocus="">
                            <label class="form-control-label">Mobile Number</label>
                        </div>
						<div class="form-group float-label mb-0">
                            <select id="opertor" class="form-control" ></select>
                            
                        </div>
						<div class="form-group float-label mb-0">
                            <select id="circle" class="form-control" ></select>
                        </div>
						<div class="form-group float-label mb-0">
                            <input type="number" id="amount" min="5" max="3000" maxlength="4" autocomplete="off" class="form-control" autofocus="">
                            <label class="form-control-label">Amount</label>
                        </div>
						<div class="form-group float-label mb-0">
                            <input type="number" id="pin"  maxlength="4" autocomplete="off" class="form-control" autofocus="">
                            <label class="form-control-label">Pin</label>
                        </div>
                    </div>
                    <div class="card-footer">
					    <input type="button" id="roffer" value="View Plan" class="btn btn-primary btn-block rounded">
                        <input type="button" id="input_submit" value="Pay Now" class="btn btn-primary btn-block rounded">
                    </div>
                </div>

            </div>
        </div>
		<!-- page content end -->
		</form>
       
    </main>
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