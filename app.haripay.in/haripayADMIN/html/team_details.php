<!-- Begin Page Content --> 
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Team Details</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php if ($o1->user_id > 0) {?> Edit <?php } else {?> Add <?php }?> Team Details      :  <small><?php if ($o1->user_id > 0) {?> Created At : <?= $o1->created_at?>  <?php } ?></small></h6>
        </div>
        <div class="card-body">
            <form name="ra" id="ra" method="post" action="team_details.php?aid=<?=$o1->user_id;?>" enctype="multipart/form-data" >
                <div class="row">
                    <div class="col-md-4">
                        <label>Name of Client</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name of Client" value="<?=$o1->name;?>" required="required" />
                    </div>
                    
                    <div class="col-md-4">
                        <label>User Plan</label>
                        <select name="plan_id" id="plan_id" class="form-control" >
                            <option value="0">Select Plan</option>
                            <?=user_plans_dropdown($o1->plan_id);?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>User Type</label>
                        <select name="user_type" id="user_type" class="form-control" required="required" >
                            <option value="" <?php if ($o1->user_id == 0) {?>selected="selected" <?php }?> >Select User Type</option>
                            <?=user_types($o1->user_type);?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Team Member</label>
                        <select name="parent_id" id="parent_id" class="form-control" >
                            <option value=""  <?php if ($o1->user_id == 0) {?>selected="selected" <?php }?> >Select Team Member</option>
                            <?=user_list_dropdown_team($o1->parent_id);?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Email</label>
                        <input type="text" name="email" id="email" class="form-control" required="required" value="<?=$o1->email;?>" placeholder="Enter Email" />
                    </div>
                    <div class="col-md-4">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile" id="mobile" class="form-control" required="required" value="<?=$o1->mobile;?>" placeholder="Enter Mobile No" />
                    </div>
                  <!--   <div class="col-md-4">
                        <label>Alternative Number</label>
                        <input type="text" name="mobile_1" id="mobile_1" class="form-control" value="<?=$o1->mobile_1;?>" placeholder="Alternative Mobile No" />
                    </div> -->
                    <div class="col-md-4">
                        <label>Password</label>
                        <?php if ($o1->user_id > 0) {?>
                            <input type="button" name="change_password" id="change_password" class="btn btn-primary form-control" value="Change Password" onclick="change_password()" />
                        <?php } else {?>
                            <input type="text" name="password" id="password" class="form-control" value="<?=substr(md5(rand(1000, 10000)), 0, 8);?>" />
                        <?php }?>
                    </div>
                     <div class="col-md-4" >
                        <label>User Pin</label>
                        
                            <input type="number" name="kyc_id" id="kyc_id" class="form-control" value="<?= $o1->kyc_id?>"  required="required" />
                    
                    </div>
                    <div class="col-md-4">
                        <label>Address</label>
                        <input type="text" name="user_address" id="user_address" class="form-control" placeholder="User Address" value="<?=$o1->user_address;?>" />
                    </div>
                    <!-- <div class="col-md-4">
                        <label>District</label>
                        <input type="text" name="district" id="district" class="form-control" placeholder="District" value="<?=$o1->district;?>" />
                    </div>
                    <div class="col-md-4">
                        <label>State</label>
                        <input type="text" name="state" id="state" class="form-control" placeholder="State" value="<?=$o1->state;?>" />
                    </div>
                    <div class="col-md-4">
                        <label>Amount Balance</label>
                        <input type="text" name="amount_balance" id="amount_balance" class="form-control" placeholder="Amount Balance" value="<?=$o1->amount_balance;?>" disabled="disabled" />
                    </div>
                    <div class="col-md-4">
                        <label>Credit Amount</label>
                        <input type="text" name="credit_amount" id="credit_amount" class="form-control" placeholder="Credit Amount" value="<?=$o1->credit_amount;?>" disabled="disabled" />
                    </div>
                    <div class="col-md-4">
                        <label>Credit Limit</label>
                        <input type="number" name="credit_limit" id="credit_limit" class="form-control" placeholder="Credit Limit" value="<?=$o1->credit_amount;?>" />
                    </div> -->
                    <!--div class="col-md-4">
                        <label>Commission</label>
                        <input type="text" name="commission" id="commission" class="form-control" placeholder="Commission" value="<?=$o1->commission;?>"  />
                    </div-->
                    <!--div class="col-md-4">
                        <label>DOB</label>
                        <input type="date" name="dob" id="dob" class="form-control" placeholder="Date of Birth" value="<?=$o1->dob;?>" />
                    </div-->
                    <div class="col-md-4">
                        <label>Shop Name</label>
                        <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Shop Name" value="<?=$o1->company_name;?>" />
                    </div>
                    <!--div class="col-md-4">
                        <label>Company Type</label>
                        <input type="text" name="company_type" id="company_type" class="form-control" placeholder="Company Type" value="<?=$o1->company_type;?>" />
                    </div-->
                    <!-- <div class="col-md-4">
                        <label>Kyc Verified</label>
                        <span class="form-control">
                            <?php if ($o1->kyc_id > 0) {?>
                                Verified
                            <?php } else {?>
                                Not Verified
                            <?php }?>
                        </span>
                    </div> -->
                    <div class="col-md-4">
                        <label>GST</label>
                        <input type="text" name="gst_no" id="gst_no" class="form-control" value="<?=$o1->gst_no;?>" placeholder="GST Number" />
                    </div>
                    <div class="col-md-4">
                        <label>Pancard</label>
                        <input type="text" name="pancard" id="pancard" class="form-control" value="<?=$o1->pancard;?>" placeholder="Pancard Number" />
                    </div>
                    <div class="col-md-4">
                        <label>Adhaar Card</label>
                        <input type="text" name="adhaar_card" id="adhaar_card" class="form-control" value="<?=$o1->adhaar_card;?>" placeholder="Adhaar Card Number" />
                    </div>
                   <!--  <div class="col-md-4">
                        <label>Mobile Verified</label>
                        <select name="mobile_verified" id="mobile_verified" class="form-control">
                            <option value="Yes" <?php if ($o1->mobile_verified == "Yes") {?> selected="selected" <?php }?>>Yes</option>
                            <option value="No" <?php if ($o1->mobile_verified == "No") {?> selected="selected" <?php }?>>No</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Email Verified</label>
                        <select name="email_verified" id="email_verified" class="form-control">
                            <option value="Yes" <?php if ($o1->email_verified == "Yes") {?> selected="selected" <?php }?>>Yes</option>
                            <option value="No" <?php if ($o1->email_verified == "No") {?> selected="selected" <?php }?>>No</option>
                        </select>
                    </div> -->
                    <div class="col-md-4">
                        <label>Approved By</label> <?=$o1->approved_by;?>
                        <?php if ($o1->approved_by > 0) {?>
                            <select name="approved_by" id="approved_by" class="form-control" disabled="disabled">
                                <?=admin_list_dropdown($o1->approved_by);?>
                            </select>
                        <?php } else {?>
                            <select name="approve_it" id="approve_it" class="form-control">
                                <option value="Yes">Approve Now</option>
                                <option value="No">Not Yet</option>
                            </select>
                        <?php }?>
                    </div>
<!--                    <div class="col-md-4">
                        <label>Route</label>
                        <select name="route" id="route" class="form-control">
                            <option value="0">Any</option>
                            <?=api_list($o1->route);?>
                        </select>
                    </div>-->
<!--                    <div class="col-md-4">
                        <label>Force Logout</label>
                        <input type="button" name="force_logout" id="force_logout" class="btn btn-primary form-control" value="Force Logout From All Devices" />
                    </div>-->
                    <!-- <div class="col-md-4">
                        <label>UUID</label>
                        <input type="text" name="uuid" id="uuid" class="form-control" value="<?=$o1->uuid;?>" placeholder="UUID of Device" />
                    </div> -->
                    <!-- <div class="col-md-4">
                        <label>Profile Pic</label>
                        <input type="file" name="profile_pic" id="profile_pic" class="form-control" />
                    </div> -->
                    <!-- <div class="col-md-4">
                        <img src="../profile_picture/thumbs/<?=$o1->profile_pic;?>"  />
                    </div> -->
                    <div class="col-md-4">
                        <label>Status</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1" <?php if ($o1->is_active == 1) {?> selected="selected" <?php }?>>Active</option>
                            <option value="0" <?php if ($o1->is_active == 0) {?> selected="selected" <?php }?>>Blocked</option>
                        </select>
                    </div>
                    <?php if($o->user_id > 0){?>
                    <div class="col-md-4">
                       <!--  <label>User Name</label> -->
                        <input type="hidden" class="form-control" name="user_name" id="user_name" readonly="readonly" placeholder="Username of Client" value="<?=$o1->user_name;?>"    />
                    </div>
                <?php } ?>

                </div>

                <div class="row top_margin_10">
                    <div class="col-md-12">
                        <input type="hidden" name="user_id" id="user_id" value="<?=$o1->user_id;?>" />
                        <input type="hidden" name="updte" id="updte" value="1" />
                        <input type="submit" name="save" id="save" value="Save" class="btn btn-primary" />
                        <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-secondary" onclick="history.back(-1)" />

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid