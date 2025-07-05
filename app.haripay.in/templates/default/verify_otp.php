<div id="verify_otp" style="display:none;">
    <form class="user" name="votp" id="votp" method="post" action="verify_otp.php" onsubmit="return false;">
        <div class="text-center">
            <h4 class="h4 text-gray-900 mb-4">Confirm Email & Mobile</h4>
        </div>
        <div class="form-group">
            <input type="number" class="form-control form-control-user" id="email_otp" name="email_otp" placeholder="Enter Email Otp..." required="required" />
            <div style="float: right;">
                <a class="small" href="#"  onclick="resend_otp('email')">Resend Email Otp</a>
            </div>
        </div>

        <div class="form-group">
            <input type="number" class="form-control form-control-user" id="mobile_otp" name="mobile_otp" placeholder="Enter Mobile Otp..." required="required" />
            <div style="float: right;">
                <a class="small" href="#"  onclick="resend_otp('mobile')">Resend Mobile Otp</a>
            </div>

        </div>
        <div class="form-group">
            <input type="submit" name="confirm_submit" id="confirm_submit" class="btn btn-primary btn-user btn-block" value="Verify" />
            <input type="hidden" name="updte6" id="updte6" value="1" />
            <input type="hidden" name="verify_user_id" id="verify_user_id" value="0" />
        </div>
        <hr>
        <div class="text-center">
            <a class="small" href="#" onclick="show_login('2')">Back to Login</a>
        </div>
    </form>
</div>