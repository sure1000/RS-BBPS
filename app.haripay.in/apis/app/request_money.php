<?php 

include("include/header.php"); $page = 'r_money';

?>
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
                        <h5 class="mb-0">Request Money</h5>
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
		<form id="prepaid" method="post">
            <div class="container">
                <div class="card">
                    <div class="card-body">
						<div class="form-group float-label mb-0">
                            <select name="request_user" id="request_user" class="form-control" >
							<!--option value="<?php echo $_SESSION['parent_id'];?>">My Parent</option-->
							<option value="1">Super Admin</option>
							</select>
                        </div>
						<div class="form-group float-label mb-0">
                            <select name="payment_mode" id="payment_mode" class="form-control" >
							<option value="">Mode Type</option>
                                                <option value="IMPS">IMPS</option>
                                                <option value="NEFT">NEFT</option>
                                                <option value="RTGS">RTGS</option>
                                                <option value="UPI">UPI</option>
							</select>
                        </div>
						<div class="form-group float-label mb-0">
                            <select name="bank_list" id="bank_list" class="form-control" >
							 <option value=""></value>
							</select>
                        </div>
						<div class="form-group float-label mb-0">
                            <input type="number" name="request_money"  id="request_money" maxlength="8"  autocomplete="off" class="form-control" autofocus="">
                            <label class="form-control-label">Amount</label>
                        </div>
						<div class="form-group float-label mb-0">
                            <input type="text" name="remark" id="transaction_number" maxlength="8"  autocomplete="off" class="form-control" autofocus="">
                            <label class="form-control-label">Remark/UTR No.</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="button" id="submit" value="Send Request" class="btn btn-primary btn-block rounded">
                    </div>
                </div>
				<br>
             <div id="results">
					
				</div>
            </div>
			</form>
        </div>
		<!-- page content end -->
       
    </main>
<?php include("include/footer.php"); ?> 