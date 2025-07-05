<?php include("include/header.php"); ?>
<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

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
                        <h5 class="mb-0">Add Money</h5>
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
            <div class="container">
                <div class="card">
				<form method="post" action="include/Paytmpg/PaytmKit/pgRedirect.php">
                    <div class="card-body">
					
                        <div class="form-group float-label mb-0">
                            <input type="text"  id="ORDER_ID" name="ORDER_ID" value="<?php $s=rand(11111,99999); echo "PYTM$s"; ?>" readonly class="form-control">
                            
                        </div>
						<div class="form-group float-label mb-0">
                            <input type="text" id="CUST_ID" name="CUST_ID" class="form-control" readonly value="<?php echo $_SESSION['username']; ?>">
                           <input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
						   <input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
                        </div>
						<div class="form-group float-label mb-0">
                            <input type="number" name="TXN_AMOUNT" title="TXN_AMOUNT" min="5" max="3000" maxlength="4" autocomplete="off" class="form-control" autofocus="">
                            <label class="form-control-label">Amount</label>
                        </div>
						
                    </div>
                    <div class="card-footer">
                        <input type="submit" onclick="" value="Add Now" class="btn btn-primary btn-block rounded">
                    </div>
                </div>
				</form>

            </div>
        </div>
		<!-- page content end -->
       
    </main>
<?php include("include/footer.php"); ?> 