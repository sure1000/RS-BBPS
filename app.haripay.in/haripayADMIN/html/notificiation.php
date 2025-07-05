<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Notifications</h1>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-primary" href="delete_notice.php?aid=0">Delete All</a>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Notifications</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="color:#fff; background-color: #034ea1;">
                        <tr>
                            <th>S.No</th>
                            <th>User Details</th>
                            
                            <th>Total</th>
                            <th>Read</th>
                            <th>Unread</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $rows; $i++) {?>

                            <tr >
                                <td><?=$i + 1;?></td>
                                <td>
                                    <?=($res[$i]['user_name']);?><br/>
                                    <?= ($res[$i]['name'])?>
                                </td>
                            
                                
                                <td>        
                                     <?= total_read($res[$i]['user_id']); ?>


                                </td>
                                 <td>
                                 <?= read($res[$i]['user_id']); ?>
                                 </td>
                                 <td>
                                    <?= un_read($res[$i]['user_id']); ?>
                                 </td>
                                <td>
                                    <?=status($res[$i]['is_active']);?>
                                </td>
                                <td>
                                    <a href="view_notification.php?aid=<?=$res[$i]['user_id'];?>" ><i class="fa fa-eye" title="View"></i></a> |
                                    <a href="delete_notice.php?aid=<?=$res[$i]['user_id'];?>" ><i class="fa fa-times fa-fw" title="Delete Notice"></i></a>

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