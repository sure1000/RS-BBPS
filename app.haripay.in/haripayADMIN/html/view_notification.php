
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">View Notifications</h1>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-primary" href="delete_notice.php?aid=<?=$o1->user_id?>">Delete All</a>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of View Notifications :  <?= $o1->user_name?> <?= $o1->name?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Notification</th>
                            <th>Date</th>
                            <th>Is Read</th>
                            <th>Status</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < $rows; $i++) {?>

                            <tr >
                                <td><?=$i + 1;?></td>
                                <td>
                                    <?= ($res[$i]['notification'])?> <br/>
                                   
                                </td>
                               
                                <td>
                                 <?= ($res[$i]['notification_date']) ?>
                                 </td>   
                                 <td>
                                    <?= ($res[$i]['is_read'])?>
                                </td>
                            
                                <td>
                                    <?=status($res[$i]['is_active']);?>
                                </td>
                               
                            </tr>
                        <?php }?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid