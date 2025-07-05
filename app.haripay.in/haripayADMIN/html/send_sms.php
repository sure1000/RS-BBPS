 <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Send SMS</h1>
        </div>
        
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Send SMS</h6>
        </div>
        <div class="card-body">
            <div id="user_info">
                <form name="send_sms" id="send_sms" method="post" onsubmit="return false;"  >
                    <div class="row">
                        <div class="col-md-6">
                             <label>Select User type</label>
                            <select name="user_type" id="user_type" class="select2_single form-control" required>
                                <option value="0">User type</option>
                                <option value="All">All</option>
                                <?= user_types('0'); ?>
                            </select>
                        </div>
                    
                    </div>
                    <div class="row top_margin_10 ">
                        <div class="col-md-6">
                            <label>Send to</label>
                            <input type="text" class="form-control" name="phone_email" id="phone_email" placeholder="Mobile"  />
                        </div>
                    
                    </div>
                    <div class="row top_margin_10">
                        <div class="col-md-6">
                            <label>Message</label>
                            <textarea  class="form-control" min="1" name="message" id="message"  ></textarea> 
                           
                        </div>
                    </div>
                    
                     
                   
                    <div class="row top_margin_10">
                        <div class="col-md-6">
                            <input type="hidden" name="updte" id="updte" value="1" />
                            <input type="submit" name="save" id="Send" value="Send" class="btn btn-primary" />
                            <input type="button" name="Reset" id="Reset" value="Reset" class="btn btn-secondary" onclick="reset()" />

                        </div>
                    </div>
                </form>
            </div>
            <div id="sms_processing" style="display:none;" class="text-center">
                <?php include "html/processing.php"; ?>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->