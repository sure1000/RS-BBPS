<div id="verify_otp" style="display:none;">
	<form class="user" name="vo" id="vo" method="post" action="opt_verify.php" onsubmit="return false;">
		
		<div class="text-center">
			<h4 class="h4 text-gray-900 mb-4">Verify OTP!</h4>
		</div>
		<div class="form-group">
			<input type="number" class="form-control form-control-user" id="otp" name="otp" placeholder="Enter OTP..." required="required" />
		</div>
		<div class="form-group">
			<input type="hidden" name="user_id" id="user_id" value="0">
			<input type="submit" name="otp_submit" id="otp_submit" class="btn btn-primary btn-user btn-block" value="Verify OTP" />
			<a  style="color: white" class="btn btn-secondary btn-user btn-block" onclick="resentOTP()" >Resend OTP</a>
			<input type="hidden" name="updte4" id="updte4" value="1" />
		</div>
		
		
		
		<hr>
		<div class="text-center">
            <a class="small" href="#" onclick="show_login1('1')">Back to Login</a>
        </div>
		
	</form>
</div>