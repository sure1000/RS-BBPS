<!-- Begin Page Content  -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Send Money To User</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transfer to User's Wallet</h6>
        </div>
        <div class="card-body">
            <div id="user_info">
                <form name="ra" id="ra" method="post" onsubmit="return false;"  >
                    <div class="row">
                        <?php if($o1->user_id == 0){?> 
                        <div class="col-md-6">
                            <?php 
                            if ($o->user_type == "Distributor" || $o->user_type == "White Label" || $o->user_type == "Master Distributor"){ ?>
                            <label>Transfer to</label>
                            <select name="transfer_money" id="transfer_money" class="form-control" onchange ="get_users_detail(this.value)" required="required">

                                 <option value="0">Select User</option>
                            <?php   for($k=0;$k < $row;$k++){ ?>
                            <option value="<?= $res[$k]['user_id'] ?>"  <?php if($res[$k]['user_id'] == $send_user_id) { ?> selected <?php }?> ><?= $res[$k]['user_name']." ". $res[$k]['name']; ?></option>  
                            <?php } ?>
                            </select>
                        <?php } ?>
                        </div>
                         <?php } else{ ?>
                            <input type="hidden" name ="transfer_money" id="transfer_money" value="<?= $o1->user_id; ?>">
                        <?php } ?>   
                                

                        <!-- <div class="col-md-6">
                            <label>Transfer to</label>
                            <input type="text" class="form-control" name="phone_email" id="phone_email" placeholder="Mobile / Email" value="<?= $o1->user_name ?> - <?php $o1->name ?>" required="required" />
                        </div> -->
                    </div>
                    <div class="row top_margin_10">
                        <div class="col-md-6">
                            <div>
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">User Info will be listed here</h6>
                                    </div>
                                    <div class="card-body" >
                                        <table class="table-striped table-bordered" width="100%" cellspacing="4" cellpadding="4">
                                            <tr>
                                                <td width="35%">Name</td>
                                                <th width="65%" id="t_name"><?= $o1->name; ?></th>
                                            </tr>
                                            <tr>
                                                <td width="35%">User Name</td>
                                                <th width="65%" id="t_username"><?= $o1->user_name; ?></th>
                                            </tr>
                                            <tr>
                                                <td width="35%">Mobile</td>
                                                <th width="65%" id="t_mobile"><?= $o1->mobile; ?></th>
                                            </tr>
                                            <tr>
                                                <td width="35%">Email</td>
                                                <th width="65%" id="t_email"><?= $o1->email; ?></th>
                                            </tr>
                                            <tr>
                                                <td width="35%">Balance Amount</td>
                                                <th width="65%" ><i class="fa fa-rupee-sign"></i> <span id="t_balance"><?= round($o1->amount_balance,3); ?></span></th>
                                            </tr>
                                        
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Amount to be transferred</label>
                            <input type="number" class="form-control" min="1" name="amount" id="amount" placeholder="Amount in Rs" value="" required="required" step="0.01"  />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Credit / Debit </label>
                            <select name="credit_paid" id="credit_paid" class="form-control" required="required">
                                <option value="">Select Payment</option>
                                <option value="Debit">Debit</option>
                                <option value="Credit">Credit</option>
                            </select> 
                        </div>
                    </div>
                    <div class="row top_margin_10">
                        <div class="col-md-6">

                            <input type="hidden" name="updte" id="updte" value="1" />
                            <input type="hidden" name="user_id" id="user_id" value="<?= $o->user_id; ?>" />
                            <input type="submit" name="save" id="save" value="Save" class="btn btn-primary" />
                            <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-secondary" onclick="window.location.href = 'index.php'" />

                        </div>
                    </div>
                </form>
            </div>
            <div id="processing" style="display:none;" class="text-center">
                <?php include "html/processing.php"; ?>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->



<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Send Money List</h1>
        </div>
    </div>
    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <div class="col-md-12 text-left ">
                List of Send Money
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="dataTable">
                        <thead>
                            <tr style="background-color:#205f56 !important; color:white !important; ">
                                <th> Date</th>
                                <th>Transaction Details</th>
                                <th>Reference Number</th>
                                <th>Credit</th> 
                                <th>Debit</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <?php for ($i = 0; $i < $rows_transaction; $i++) { ?>
                            <tr>
                                <td><?= format_date1($res_transaction[$i]['transaction_date']); ?></td>
                              <td>
                                <?= $res_transaction[$i]['user_name']?> (<?= $res_transaction[$i]['transaction_type'] ?>)<br />
                                
                             <?= $res_transaction[$i]['transaction_details'] ?> </td>
                             <td>
                              <?= $res_transaction[$i]['ref_number'] ?>
                            </td>
                                <?php if($res_transaction[$i]['transaction_type'] == 'Recieve Money'){?>
                                <td><span style="color: #008000;"><i class="fas fa-rupee-sign"></i><?= $res_transaction[$i]['amount'] ?></span></td>
                                <td> - </td>
                            <?php }else if($res_transaction[$i]['transaction_type'] == 'Reverse'){?>
                                 <td> - </td>
                                <td><span style="color: #ff0000;"><i class="fas fa-rupee-sign"></i><?= $res_transaction[$i]['amount'] ?></span></td>

                            <?php } ?>
                <td><i class="fas fa-rupee-sign"></i><?= $res_transaction[$i]['user_new_balance']?></td>
                                   
                            </tr>
                        <?php } ?>     
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>















