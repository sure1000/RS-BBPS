<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800"> Profile</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Edit  Profile</h6>
        </div>
        <div class="card-body">
            <form name="update_profile" id="update_profile" method="post" >
                <div class="row">
                    <div class="col-md-4">
                        <label>Name of Client</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name of Client" value="<?=$o->name?>" required="required">
                    </div>

                    <div class="col-md-4">
                        <label>Email</label>
                        <input type="text" name="email" id="email" class="form-control" required="required" value="<?=$o->email?>" placeholder="Enter Email">
                    </div>
                    <div class="col-md-4">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile" id="mobile" class="form-control" required="required" value="<?=$o->mobile?>"  placeholder="Enter Mobile No">
                    </div>
                    <!-- <div class="col-md-4">
                        <label>Alternative Number</label>
                        <input type="text" name="mobile_1" id="mobile_1" class="form-control" value="<?=$o->mobile_1?>" placeholder="Alternative Mobile No">
                    </div> -->
                    <div class="col-md-4">
                        <label>Address</label>
                        <input type="text" name="user_address" id="user_address" class="form-control" placeholder="User Address" value="<?=$o->user_address?>">
                    </div>
                    <div class="col-md-4">
                        <label>District</label>
                        <input type="text" name="district" id="district" class="form-control" placeholder="District" value="<?=$o->district?>">
                    </div>
                    <div class="col-md-4">
                        <label>State</label>
                        <input type="text" name="state" id="state" class="form-control" placeholder="State" value="<?=$o->state?>">
                    </div>
                   <!--  <div class="col-md-4">
                        <label>DOB</label>
                        <input type="date" name="dob" id="dob" class="form-control" placeholder="Date of Birth" value="<?=$o->dob?>">
                    </div> -->
                    <div class="col-md-4">
                        <label>Company Name</label>
                        <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company Name" value="<?=$o->company_name?>">
                    </div>
                    <!-- <div class="col-md-4">
                        <label>Company Type</label>
                        <input type="text" name="company_type" id="company_type" class="form-control" placeholder="Company Type" value="<?=$o->company_type?>">
                    </div> -->

                    <div class="col-md-4">
                        <label>GST</label>
                        <input type="text" name="gst_no" id="gst_no" class="form-control" value="<?=$o->gst_no?>" placeholder="GST Number">
                    </div>
                    <div class="col-md-4">
                        <label>Pancard</label>
                        <input type="text" name="pancard" id="pancard" class="form-control" value="<?=$o->pancard?>" placeholder="Pancard Number">
                    </div>
                    <div class="col-md-4">
                        <label>Adhaar Card</label>
                        <input type="text" name="adhaar_card" id="adhaar_card" class="form-control" value="<?=$o->adhaar_card?>" placeholder="Adhaar Card Number">
                    </div>
                    <div class="col-md-4">
                        <label>Profile Pic</label>
                        <input type="file" name="profile_pic" id="profile_pic"   class="form-control">
                    </div>
                        <?php if ($o->profile_pic != "") {?>
                        <div class="col-md-4" id="profile_picture">
                            <img src="/profile_picture/thumbs/<?=$o->profile_pic?>">
                        </div>
                    <?php }?>
                </div>

                <div class="row top_margin_10">
                    <div class="col-md-12">
                        <input type="hidden" name="user_id" id="user_id" value="<?=$o->user_id?>">
                        <input type="hidden" name="updte" id="updte" value="1">
                        <input type="submit" name="save" id="save" value="Save" class="btn btn-primary">
                        <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-secondary" onclick="history.back(-1)">

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="update_profile_processing" style="display:none;" class="text-center top_margin_10">
            <?php include $path . "processing.php";?>
        </div>
</div>