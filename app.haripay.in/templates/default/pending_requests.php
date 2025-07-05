
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Pending Wallet Top Up Requests</h1>
        </div>
    </div>
    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <div class="col-md-12 text-left ">
                List of Request Money
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="dataTable">
                        <thead>
                            <tr style="background-color:#205f56 !important; color:white !important; ">
                                <th>Request Date</th>
                                <th>User Details</th>

                                <th>Transaction Type</th>
                                <th>Amount</th> 

                                <?php if ($o->user_type == "Retailer") { ?>
                                    <th>Status</th>
                                <?php } ?>
                                <?php if ($o->user_type != "Retailer") { ?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <?php for ($i = 0; $i < $rows; $i++) { ?>
                            <tr>
                                <td><?= format_date1($res[$i]['request_date']); ?></td>


                                <td><?php echo $res[$i]['name']; ?>(<?php echo $res[$i]['user_type']; ?>)<br>
                                    <?php echo $res[$i]['email']; ?>
                                </td>

                                <?php if ($res[$i]['decision_date'] == "0000-00-00 00:00:00") { ?>
                                    <?php $res[$i]['decision_date'] = ""; ?>
                                <?php } ?>
                                <td><?= $res[$i]['transfer_mode'] ?> <?= $res[$i]['transaction_number'] ?> <br/> <?= $res[$i]['decision'] ?><br/> <?= $res[$i]['decision_date'] ?></td>

                                <td><i class="fa fa-rupee-sign"></i> <?= $res[$i]['amount']; ?></td>  


                                <td>
                                    <a class="text-center" onclick="change_payment_request('Approve',<?= $res[$i]['request_money_id'] ?>)"><i class="fa fa-check fa_approve" title="Approve"></i>
                                    </a>
                                    <a class="text-center" onclick="change_payment_request('Reject', '<?= $res[$i]['request_money_id'] ?>')"> <i class="fa fa-times fa_reject" title="Reject"></i>
                                    </a>

                                </td>
                            <?php } ?>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<div class="modal fade bs-example-modal-sm" id="payment_request_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel2">Payment Remark: <span id="order_id"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
            </div>
            <form name="payment_submit" id="payment_submit" method="post"  onsubmit="return false;" >

                <div class="modal-body">
                    <div class="col-md-12">
                        <label>Remark <small>(optional)</small></label>
                        <input type="text" class="form-control" id="remarks" placeholder="Remark" name="remarks"aria-describedby="inputSuccess2Status">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    <input type="hidden" name="request_money_status" id="request_money_status" value='0'/>
                    <input type="hidden" name="request_money_id" id="request_money_id" value='0'/>
                    <input type="hidden" name="updte" id="updte" value='1'/>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            <div id="processing_payment" style="display: none;" class="col-md-12 text-center">
                <?php include "processing.php"; ?>
            </div>

        </div>
    </div>
</div>