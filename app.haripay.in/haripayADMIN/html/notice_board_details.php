<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Notice Board Details</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php if ($o1->notice_board_id > 0) {?> Edit <?php } else {?> Add <?php }?> Notice Board Details</h6> <small class="text-danger">Note*: Remember only one notice will be active at a time</small>
        </div>
        <div class="card-body">
            <form name="ra" id="ra" method="post" action="notice_board_details.php?aid=<?=$o1->notice_board_id;?>" enctype= multipart/form-data>
                <div class="row">
                    <div class="col-md-6">
                        <label>Notice Type</label>
                        <select name="notice_type" id="notice_type" class="form-control" required="required">
                            <option value="">Select Notice Type</option>
                            <option value="Image" <?php if ($o1->notice_type == "Image") {?> selected="selected" <?php }?>>Image</option>
                            <option value="Text" <?php if ($o1->notice_type == "Text") {?> selected="selected" <?php }?>>Text</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Notice</label>
                        <textarea name="notice_details" id="notice_details" class="form-control" rows="5"><?=$o1->notice_details;?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Image</label>
                        <input type="file" name="notice_file" id="notice_file" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Notice Date</label>
                        <input type="text" name="notice_date" id="notice_date" class="form-control" value="<?=$o1->notice_date;?>" disabled="disabled" />
                    </div>
                </div>
                <?php if ($o1->notice_file != "") {?>
                <div class="row">
                    <div class="col-md-6">
                        <img src="../notice_board/<?=$o1->notice_file;?>" class="img-rounded" style="width:100px;" alt="Notice board" />
                    </div>
                </div>
                <?php }?>
                <div class="row">
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1" <?php if ($o1->is_active == 1) {?> selected="selected" <?php }?>>Active</option>
                            <option value="0" <?php if ($o1->is_active == 0) {?> selected="selected" <?php }?>>Blocked</option>
                        </select>
                    </div>
                </div>
                <div class="row top_margin_10">
                    <div class="col-md-6">
                        <input type="hidden" name="updte" id="updte" value="1" />
                        <input type="submit" name="save" id="save" value="Save" class="btn btn-primary" />
                        <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-secondary" onclick="history.back(-1)" />

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->