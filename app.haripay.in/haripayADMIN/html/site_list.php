<div class="container-fluid">
    <!-- Page Headin222g -->
    <div class="row">
    <div class="col-md-6">
      <h1 class="h3 mb-2 text-gray-800">White lebel List</h1>
    </div>
    <div class="col-md-6 text-right">
      <a class="btn btn-primary" href="whitelabel_team_details.php">Add New Details</a>
    </div>
  </div>

    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="color:#fff;background-color:#034ea1">
                        <tr>
                            <th>S.No</th>
                            <th>Website Name</th>
                            <th>Web Url</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Location</th>
							<th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php for ($i = 0; $i < $rows; $i++) { ?>
                            
                            <tr bgcolor="<?= $colors['bgcolor']; ?>" style="color:<?= $colors['color']; ?>" >
                                <td><?= $i + 1; ?></td>
                                <td>
                                    <?= $res[$i]['site_name']; ?>
                                </td>
								<td>
                                    <?= $res[$i]['site_url']; ?>
                                </td>
								<td>
                                    <?= $res[$i]['email']; ?>
                                </td>
								<td>
                                    <?= $res[$i]['mobile']; ?>
                                </td>
                               <td>
                                    <?= $res[$i]['loction']; ?>
                                </td>
                                <td>
                                    <?= status($res[$i]['is_active']); ?> 

                                </td>
                                <td>
                                    <a href="whitelabel_team_details.php?aid=<?= $res[$i]['site_info_id']; ?>" ><i class="fa fa-edit  fa_approve"></i></a> 
                                    
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>