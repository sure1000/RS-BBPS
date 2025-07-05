<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800"><?= $o1->user_name; ?> KYC Documents</h1>
        </div>
        <div class="col-md-6 text-right">
            <a class="btn btn-primary" href="kyc_document.php?aid=<?= $o1->user_id; ?>">Add New Document</a>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Document(s)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Document</th>
                            <th>View</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.No</th>
                            <th>Document</th>
                            <th>View</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php for ($i = 0; $i < $rows; $i++) { ?>
                            <tr >
                                <td><?= $i + 1; ?></td>
                                <td>
                                    <?= $res[$i]['document_type']; ?>
                                </td>
                                <td>
                                    <span class="cursor" onclick="show_document('<?=$res[$i]['document_name'];?>')">View Document</span>
                                </td>
                                <td>
                                    <?php if ($res[$i]['is_active'] == 1) { ?>
                                        Verified
                                    <?php } else { ?>
                                        Pending Verification
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($res[$i]['is_active'] == 0) { ?>
                                        <a href="verify_kyc.php?aid=<?= $res[$i]['kyc_id']; ?>"><i class="fa fa-check" title="Mark it Verified"></i></a> | 
                                    <?php } ?>
                                    <a href="delete_kyc.php?aid=<?= $res[$i]['kyc_id']; ?>"><i class="fa fa-times" title="Delete It"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Kyc Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body" id="img_div">
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->