<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">Service Details</h1>
    </div>
  </div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><?php if ($o1->service_id > 0) {?> Edit <?php } else {?> Add <?php }?> Service Details</h6>
    </div>
    <div class="card-body">
      <form name="ra" id="ra" method="post" action="service_details.php?aid=<?=$o1->service_id;?>" onload="document.ra.service_name.focus()">
        <div class="row">
          <div class="col-md-6">
            <label>Service Name</label>
            <input type="text" class="form-control" name="service_name" id="service_name" placeholder="Service Name" value="<?=$o1->service_name;?>" required="required" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label>Route</label>
            <select name="api_id" id="api_id" class="form-control" >
              <option value="0" <?php if ($o1->api_id == "0") {?> selected="selected" <?php }?>>Any</option>
              <?=api_list($o1->api_id);?>
            </select>
          </div>
        </div>
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