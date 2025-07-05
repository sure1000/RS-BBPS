<?php include("include/header.php"); $page='home'; 
?>

<body>
	<div class="main_wrapper">
		<div class="main_conatiner" style="background: #0ea9bd;">
			<!-- Starting of the Loader -->
			<div class="loader">
				<div class="loader_inner">
					<img src="include/asstes/Spin-loader.gif" alt="loader">
				</div>
			</div>
			<!-- Ending of the Loader -->
			<div class="dashboard_page">	
<div class="header_wrap">
					<div class="header">
						<a href="my_profile"  class="back_btn">
							<span class="material-icons">
								<img src="include/asstes/user.png" style="width: 35px;height: 24px;font-size: 24px">
							</span>
						</a>
						<p class="title"style="font-size: 20px;" id="user_type">
							
						</p>
						<p style="float:right;font-size: 20px;padding-left: 80px;color: white;font-weight: bold;">
							<span id="amount_balance"></span>
						</p>
					</div>
				</div>
	<p style="height: 25px;font-size: 18px;background: #a41ef9;color: white;text-align: center;font-weight: bold;" id="name1"></p>
<marquee style="font-weight: bold;color: white; height: 35px;font-size: 18px;background: #0071bc;padding-top: 7px;">
						Welcome to Abhipay
						</marquee>
				<div class="dashboard_items_wrap">	
					<div class="diw_container">
						<?php if($_SESSION['user_type']=='Retailer'){ ?>
						<div id="r1" class="diw_item">
							<div class="diw_icon">
								<span class="material-icons">
									<img src="include/asstes/sicon/mobile.png" class="sicon">
								</span>
							</div>
							<div class="diw_name" >Prepiad</div>
						</div>
						<div id="r2"class="diw_item">
							<div class="diw_icon">
								<span class="material-icons">
									<img src="include/asstes/sicon/tv.png" class="sicon">
								</span>
							</div>
							<div class="diw_name">DTH</div>
						</div>
						<div id="r3" class="diw_item diw_br0">
							<div class="diw_icon">
								<span class="material-icons">
										<img src="include/asstes/sicon/dmt.png" class="sicon">
								</span>
							</div>
							<div class="diw_name">DMT</div>
						</div>
						<!--div id="r4" class="diw_item">
							<div class="diw_icon">
								<span class="material-icons">
										<img src="include/asstes/sicon/aeps.png" class="sicon">
								</span>
							</div>
							<div class="diw_name">Aeps</div>
						</div>
						<div id="r5" class="diw_item">
							<div class="diw_icon">
								<span class="material-icons">
										<img src="include/asstes/sicon/mpos.png" class="sicon">
								</span>
							</div>
							<div class="diw_name">Mini ATM</div>
						</div>
						<div id="r6" class="diw_item diw_br0">
							<div class="diw_icon">
								<span class="material-icons">
										<img src="include/asstes/sicon/flight.png" class="sicon">
								</span>
							</div>
							<div class="diw_name">Flight</div>
						</div-->
						<?php } else if($_SESSION['user_type']!='Retailer'){ ?> 
						
						<div id="d1" class="diw_item">
							<div class="diw_icon">
								<span class="material-icons">
										<img src="include/asstes/sicon/addusers.png" class="sicon">
								</span>
							</div>
							<div class="diw_name">Add_Member</div>
						</div>
						
						<div id="d2" class="diw_item">
							<div class="diw_icon">
								<span class="material-icons">
										<img src="include/asstes/sicon/users.png" class="sicon">
								</span>
							</div>
							<div class="diw_name">My_Team</div>
						</div>
						
						<div id="d3" class="diw_item">
							<div class="diw_icon">
								<span class="material-icons">
										<img src="include/asstes/sicon/dmt.png" class="sicon">
								</span>
							</div>
							<div class="diw_name">Fund_Transfer</div>
						</div>
						<?php } ?>
						<div id="r7" class="diw_item">
							<div class="diw_icon">
								<span class="material-icons">
										<img src="include/asstes/sicon/rmoney.png" class="sicon">
								</span>
							</div>
							<div class="diw_name">Request_Money</div>
						</div>
						<div id="r8" class="diw_item">
							<div class="diw_icon">
								<span class="material-icons">
										<img src="include/asstes/sicon/wallet.png" class="sicon">
								</span>
							</div>
							<div class="diw_name">Wallet_History</div>
						</div>
						<div id="r9" class="diw_item diw_br0">
							<div class="diw_icon">
								<span class="material-icons">
										<img src="include/asstes/sicon/support.png" class="sicon">
								</span>
							</div>
							<div class="diw_name">Support/Bank</div>
						</div>
						<div id="r10" class="diw_item">
							<div class="diw_icon">
								<span class="material-icons">
										<img src="include/asstes/sicon/pin.png" class="sicon">
								</span>
							</div>
							<div class="diw_name">Change_Pin</div>
						</div>
						<div id="r11" class="diw_item">
							<div class="diw_icon">
								<span class="material-icons">
										<img src="include/asstes/sicon/pass.png" class="sicon">
								</span>
							</div>
							<div class="diw_name">Change_Password</div>
						</div>
						<div id="r12" class="diw_item diw_br0">
							<div class="diw_icon">
								<span class="material-icons">
										<img src="include/asstes/sicon/out.png" class="sicon">
								</span>
							</div>
							<div class="diw_name">Sign Out</div>
						</div>
						
					</div>
				</div>

				<div class="fixed_menu"style="background: #0467049c;" >
					<div class="fm_wrap">
						<ul>
							<li><a href="ledger_reports" >
								<div class="icon">
									<span class="material-icons">
									menu_book
									</span>
								</div>
								<div class="text">
									Ledger
								</div>
							</a></li>
							<li><a href="my_commission">
								<div class="icon">
									<span class="material-icons">
									analytics
									</span>
								</div>
								<div class="text">
									 Margin
								</div>
							</a></li>
							<li><a href="home" class="active">
								<div class="icon">
									<span class="material-icons">
									home
									</span>
								</div>
								<div class="text">
								Home
								</div>
							</a></li>
							<li><a href="transaction_history">
								<div class="icon">
									<span class="material-icons">
									history
									</span>
								</div>
								<div class="text">
									History
								</div>
							</a></li>
							<li><a href="my_profile">
								<div class="icon">
									<span class="material-icons">
									account_circle
									</span>
								</div>
								<div class="text">
									Profile
								</div>
							</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>	


<?php include("include/footer.php"); ?> 
