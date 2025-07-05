<?php include("include/header.php"); $page ='support'; ?>
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
							Support & Bank
						</p>
					</div>
				</div>
					<div class="form">
					    <br>
					    <div class="history_item_wrap">
					<div class="history_item">
						<div class="hi_left" id="results">
							<div class="hi_info">
								<div class="icon_holder">
									<span class="material-icons">
									support
									</span>
								</div>
								<div class="info">
									<P class="head" style="margin-bottom:10px;padding-left: 35px;">
										Phone: <?php echo $phone ?>
									</P>
									<P class="head">
										Email: <?php echo $email ?>
									</P>

								</div>
							</div>
							
							</div>
						</div>
					</div></div>
	
<?php include("include/footer.php"); ?> 