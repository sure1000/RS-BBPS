<div id="reset_password" style="display:none;">
    <form class="user" name="rp" id="rp" method="post" action="reset_password.php" onsubmit="return false;">

        <div class="text-center">
            <h4 class="h4 text-gray-900 mb-4">Reset Password!</h4>
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="reset_email" name="reset_email" placeholder="Enter Email Address..." required="required" />
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="verification_code" name="verification_code" placeholder="Verification Code" required="required" />
        </div>
        <div class="form-group">
            <input type="Password" name="new_password" id="new_password" placeholder="New Password" required="required" class="form-control form-control-user" />
        </div>
        <div class="form-group">
            <input type="Password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required="required" class="form-control form-control-user" />
        </div>
        <div class="form-group">
            <input type="submit" name="confirm_submit" id="confirm_submit" class="btn btn-primary btn-user btn-block" value="Reset Password" />
            <input type="hidden" name="updte2" id="updte2" value="1" />
        </div>



        <hr>
        <div class="text-center">
            <a class="small" href="#" onclick="show_login('2')">Back to Login</a>
        </div>

    </form>
</div>