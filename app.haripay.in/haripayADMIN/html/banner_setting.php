<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">Banner settings</h1>
    </div>

  </div>

  <form name="banner_img" id="banner_img" method="post" action="banner_setting.php"enctype="multipart/form-data" >
    <div class="row" >
      <div class="col-md-12" >

        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Banner Setting</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <label>Banner Image</label>
                <input type="file" name="banner_pic" id="banner_pic" class="form-control" accept="image/x-png,image/gif,image/jpeg" >
              </div>
              <div class="col-md-4">
                <label>Status</label>
                <select name="is_active" id="is_active" class="form-control select2_single">
                  <option value="1">Active</option>
                  <option value="0">Block</option>
                </select>
              </div>
            </div>

            <div class="row top_margin_10">
              <div class="col-md-12">
                <input type="hidden" name="updte" id="updte" value="1" />
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary" style="background-color:#2AB6A3; border:#2AB6A3;" />

              </div>
            </div>

          </div>
        </div>

      </div>


    </div>
  </form>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold">List of Banner Images</h6>
    </div>
    <div class="card-body">
            <div class="table-responsive">
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Banner Image</th>
                            <th>Status</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $rows; $i++) { ?>

                            <tr  >
                                <td><?= $i + 1; ?></td>
                        <td><img style="height: 60px;"src="../banner_pic/<?= $res[$i]['banner_pic'] ?>"/></td>
                        <td>
                <?=status($res[$i]['is_active']);?>
              </td>
                        <td>
                            <a href="banner_setting.php?aid_status=<?= $res[$i]['benner_set_id']; ?>" ><i class="fa fa-pen-square fa-fw" title="Edit Status" style="color: #093A86;"></i></a> | 
                            <a href="banner_setting.php?aid_delete=<?= $res[$i]['benner_set_id']; ?>" ><i class="fa fa-trash" title="Delete" style="color: #093A86;"></i></a>
                          </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
  </div>
</div>
<!-- /.container-fluid