<?php include("include/header.php"); $page = 'dth';?>
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
                        <h5 class="mb-0">DTH Recharge</h5>
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

        <!-- page content start -->
		
		<div class="main-container">
		
		<form >
            <div class="container">
			<div class="alert alert-danger" style="display: none" role="alert">
               <a id="res_msg" ></a>
                                </div>
                <div class="card">
				
                    <div class="card-body">
					
                        <div class="form-group float-label mb-0">
                            <input type="number"  id="number" maxlength="10" class="form-control" autofocus="">
                            <label class="form-control-label">Dth Number</label>
                        </div>
						<div class="form-group float-label mb-0">
                            <select id="opertor" class="form-control" ></select>
                            
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
					     <input type="button" id="dth_info" value="Customer Info" class="btn btn-primary btn-block rounded">
                        <input type="button" id="input_submit" value="Pay Now" class="btn btn-primary btn-block rounded">
                    </div>
                </div>
            </div>
			</form>
        </div>
		<!-- page content end -->
       
    </main>
	 <div id="dth_div" class="w3-modal">
    <div class="w3-modal-content">
      <header class="w3-container w3-teal"> 
        <span onclick="document.getElementById('dth_div').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <h2 style="text-align:center">DTH Details</h2>
      </header>
      <div class="w3-container" id="dth_div">
       <table id="dth_active" align="center" style="margin-left: 63px;text-align: initial;">
			<tr>
				<td>Status</td>
				<td> : </td>
				<td id="dth_status"></td>
			</tr>
			<tr>
				<td>Customer Name</td>
				<td> : </td>
				<td id="dth_cust"></td>
			</tr>
			<tr>
				<td>Monthly Recharge</td>
				<td> : </td>
				<td id="res_montly"></td>
			</tr>
			<tr>
				<td>Balance</td>
				<td> : </td>
				<td id="dth_balance"></td>
			</tr>
			<tr>
				<td>Next Recharge Date</td>
				<td> : </td>
				<td id="dth_next"></td>
			</tr>
			<tr>
				<td>Last Recharge Amount</td>
				<td> : </td>
				<td id="dth_last_amt"></td>
			</tr>
			<tr>
				<td>Last Recharge Date</td>
				<td> : </td>
				<td id="dth_last_date"></td>
			</tr>
			<tr>
				<td>Plan Name</td>
				<td> : </td>
				<td id="dth_planname"></td>
			</tr>
		</table>
		
		<table align="center" id="dth_error" style="margin-left: 63px;text-align: initial;">
			<tr>
				<td>Message</td>
				<td> : </td>
				<td> Your request is failed, please try again.</td>
			</tr>
			
		</table>
		
      </div>
      <footer class="w3-container w3-teal" style="text-align: center;">
        <input type="button" value="OK" onclick="document.getElementById('dth_div').style.display='none'" style="color: #f1f1f1;background: #dd5555;padding: 5px 50px;border: 0px;">
      </footer>
    </div>
  </div>
<?php include("include/footer.php"); ?> 