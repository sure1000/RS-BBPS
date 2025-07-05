<?php $page = 'add_member'; ?>
<html lang="en"><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Member</title>
<link rel="stylesheet" href="include/asstes/styles.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<style>

.form .form_wrap {
    margin: 15px 0;
}
.form .input_container .input_wrap {
    margin-bottom: 8px;
    position: relative;
}
</style>
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
		Add Member
	</p>
</div>
</div>
<div class="form">
	
	<div class="form_wrap">
		<form id="loginform" method="post" class="form">
			<div class="input_container">
				<div class="input_wrap">
					<div class="input_field">
						<input type="text" name="name" id="name" required class="input" placeholder="Name">
					</div>
					<div class="icon">
						<span class="material-icons">
							account_circle
						</span>
					</div>
				</div>
				<div class="input_wrap">
					<div class="input_field">
						<input type="text" name="mobile" id="mobile" class="input" placeholder="Mobile Number">
					</div>
					<div class="icon">
						<span class="material-icons">
							local_phone
						</span>
					</div>
				</div>
				<div class="input_wrap">
					<div class="input_field">
						<input type="email" name="email" id="email" class="input" placeholder="Email address">
					</div>
					<div class="icon">
						<span class="material-icons">
							local_post_office
						</span>
					</div>
				</div>
			
			<div class="input_wrap">
					<div class="input_field">
						<input type="text" name="user_address" id="user_address" class="input" placeholder="Address">
					</div>
					<div class="icon">
						<span class="material-icons">
							note_add
						</span>
					</div>
				</div>			
				
				<div class="input_wrap">
					<div class="input_field">
						<input type="text" name="company_name" id="company_name" class="input" placeholder="Company Name">
					</div>
					<div class="icon">
						<span class="material-icons">
							business
						</span>
					</div>
				</div>
				
				<!--div class="input_wrap">
					<div class="input_field">
						<input type="text" name="gst_no" id="gst_no" class="input" placeholder="GST No.">
					</div>
					<div class="icon">
						<span class="material-icons">
							local_post_office
						</span>
					</div>
				</div-->
				
					<div class="input_wrap">
					<div class="input_field">
						<input type="text" name="pancard" id="pancard" class="input" placeholder="PANCARD">
					</div>
					<div class="icon">
						<span class="material-icons">
							credit_card
						</span>
					</div>
				</div>
				<div class="input_wrap">
					<div class="input_field">
						<input type="text" name="adhaar_card" id="adhaar_card" class="input" placeholder="Adhaar Card">
					</div>
					<div class="icon">
						<span class="material-icons">
							perm_identity
						</span>
					</div>
				</div>
				
			</div>
			<div class="input_wrap">
					<div class="input_field">
					<input type="button" id="Update" value="Add"  class="input_submit" style="margin-top: 10%;font-size: 16px;width: 100%;border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
				</div>
				
				</div>
			</div>	
		</form>
	</div>

<?php include("include/footer.php"); ?> 