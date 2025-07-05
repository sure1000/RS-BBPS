<div id="register" style="display:none;">
    <form class="user" name="rg" id="rg" method="post" action="register.php" onsubmit="return false;">
        <div class="text-center">
            <h4 class="h4 text-gray-900 mb-4">Register!</h4>
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="reg_shop_name" name="reg_shop_name" placeholder="Enter Shop Name..." required="required" />
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="reg_pan_no" name="reg_pan_no" placeholder="Enter Pancard Number..."  />
        </div>
        <div class="form-group">
            <input type="email" class="form-control form-control-user" id="reg_email" name="reg_email" placeholder="Enter Email Address..." required="required" />
        </div>
        <div class="form-group">
            <input type="number" class="form-control form-control-user" id="reg_mobile" name="reg_mobile" placeholder="Enter Mobile..." required="required" />
        </div>
        <div class="form-group">
            <select name="user_type" id="user_type" class="form-control form-control-user" style="padding: 0.5rem 1rem; height: calc(2.5em + 0.75rem + 2px);" required="required">
                <option value="">Select Account Type</option>
                 <option value="Master Distributor">Master Distributor</option>
                <option value="Distributor">Distributor</option>
                <option value="Retailer">Retailer</option>
               
                <!--option value="Retailer">API Partner</option-->
            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="confirm_submit" id="confirm_submit" class="btn btn-primary btn-user btn-block" value="Register" />
            <input type="hidden" name="updte5" id="updte5" value="1" />
        </div>
        <hr>
        <div class="text-center">
            <a class="small" href="#" onclick="show_login('2')">Back to Login</a>
            
        </div>
    </form>
</div>