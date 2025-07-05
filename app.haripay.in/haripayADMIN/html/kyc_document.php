<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800"><?=$o1->user_name;?> KYC Documents</h1>
        </div>        
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Upload New Document(s)</h6>
        </div>
        <div class="card-body">
            <form name="ra" id="ra" method="post" action="kyc_document.php?aid=<?=$o1->user_id;?>" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <label>Document Type</label>
                        <select name="document_type" id="document_type" class="form-control" required="required">
                            <option value="">Select Type of Document</option>
                            <option value="Adhaar Card">Adhaar Card</option>
                            <option value="Pan Card">Pan Card</option>
                            <option value="Driving License">Driving License</option>
                            <option value="Voter ID">Voter ID</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Document File</label>
                        <input type="file" name="document_name" id="document_name" class="form-control" placeholder="Document File" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1">Verified</option>
                            <option value="0">Pending Verification</option>
                        </select>
                    </div>
                </div>
                <div class="row top_margin_10">
                    <div class="col-md-6">
                        <input type="hidden" name="updte" id="updte" value="1" />
                        <input type="submit" name="submit" id ="submit" class="btn btn-primary" value="Upload Document" />
                        <input type="button" name="cancel" id="cancel" class="btn btn-secondary" value="Cancel" onclick="team.php" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->