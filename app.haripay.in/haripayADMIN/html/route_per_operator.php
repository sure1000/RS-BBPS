<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">Operators / Providers</h1>
    </div>
  </div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Routes Per Provider</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Provider</th>
              <th>Provider Type</th>
              <th width="20%">Route</th>
            </tr>
          </thead>
          <tfoot>
          <tr>
            <th>S.No</th>
            <th>Provider</th>
            <th>Provider Type</th>
            <th>Route</th>
          </tr>
          </tfoot>
          <tbody>
            <?php for ($i = 0; $i < $rows; $i++) {?>
            <tr >
              <td><?=$i + 1;?></td>
              <td>
                <?=$res[$i]['provider'];?>
              </td>
              <td>
                <?=$res[$i]['service'];?>
              </td>
              <td>
                <select name="api_id" id="api_id_<?=$i;?>" class="form-control" onchange="update_provider_route('<?=$res[$i]['provider_id'];?>',this.value);">
                  <option value="0" <?php if ($res[$i]['api_id'] == 0) {?> selected = "selected" <?php }?>>Any</option>
                  <?=api_list($res[$i]['api_id']);?>
                </select>
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->