<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Notice Board</h1>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-primary" href="notice_board_details.php">Add New Notice</a>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Notice(s)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="apiTABLE" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Notice Type</th>
                            <th>Notice</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $rows; $i++) {?>
                            <tr >
                                <td><?=$i + 1;?></td>
                                <td>
                                    <?=($res[$i]['notice_type']);?>
                                </td>
                                <td>
                                    <?=$res[$i]['notice_details'];?>
                                </td>
                                <td>
                                    <?=format_date($res[$i]['notice_date']);?>
                                </td>
                                <td>
                                    <?=status($res[$i]['is_active']);?>
                                </td>
                                <td>
                                    <a href="notice_board_details.php?aid=<?=$res[$i]['notice_board_id'];?>" ><i class="fa fa-pen-square fa-fw" title="Edit Notice"></i></a> |
                                    <a href="notice_board_details.php?aid_delete=<?=$res[$i]['notice_board_id'];?>" ><i class="fa fa-times fa-fw" title="Delete Notice"></i></a>

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