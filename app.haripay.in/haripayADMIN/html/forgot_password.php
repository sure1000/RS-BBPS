<div id="forgot_password" style="display:none;">
	<form class="user" name="fp" id="fp" method="post" action="forgot_password.php" onsubmit="return false;">
		
		<div class="text-center">
			<h4 class="h4 text-gray-900 mb-4">Forgot Password!</h4>
		</div>
		<div class="form-group">
			<input type="email" class="form-control form-control-user" id="forgot_email" name="forgot_email" placeholder="Enter Email Address..." required="required" />
		</div>
		<div class="form-group">
			<input type="submit" name="forgot_submit" id="forgot_submit" class="btn btn-primary btn-user btn-block" value="Reset Password" />
			<input type="hidden" name="updte1" id="updte1" value="1" />
		</div>
		
		
		
		<hr>
		<div class="text-center">
            <a class="small" href="#" onclick="show_login('1')">Back to Login</a>
        </div>
		
	</form>
</div>