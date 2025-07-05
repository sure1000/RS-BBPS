<!-- Begin Page Content  -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Recieve Money From User</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Recieve Money</h6>
        </div>
        <div class="card-body">
            <div id="user_info">
                <form name="ra" id="ra" method="post" action="recieve_money.php"  >
                    <div class="row">
                        <div class="col-md-6">
                            <label>Recieve From</label>
                            <input type="text" class="form-control" name="phone_email" id="phone_email" placeholder="Mobile / Email" value="<?= $phone_email; ?>" required="required" />
                        </div>
                    </div>
                    <div class="row top_margin_10">
                        <div class="col-md-6">
                            <div  >
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
                                                <th width="65%" ><i class="fa fa-rupee-sign"></i> <span id="t_balance"><?= $o1->amount_balance; ?></span></th>
                                            </tr>
                                            <!-- <tr>
                                                <td width="35%">Credit Amount</td>
                                                <th width="65%" ><i class="fa fa-rupee-sign"></i> <span id="t_credit"><?= $o1->credit_amount; ?></span></th>
                                            </tr>
                                            <tr>
                                                <td width="35%">Credit Limit</td>
                                                <th width="65%" ><i class="fa fa-rupee-sign"></i> <span id="t_limit"><?= $o1->credit_limit; ?></span></th>
                                            </tr> -->
                                            <!-- <tr>
                                                <td width="35%">Limit Pending</td>
                                                <th width="65%" ><i class="fa fa-rupee-sign"></i> <span id="t_pending"><?= ($o1->credit_limit - $o1->credit_limit); ?></span></th>
                                            </tr> -->
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Amount Recieved</label>
                            <input type="number" class="form-control" min="1" name="amount" id="amount" placeholder="Amount in Rs" value="" required="required" step="0.01" <?php if ($o1->user_id == 0) { ?> disabled="disabled" <?php } ?> />
                        </div>
                    </div>
                    <div class="row top_margin_10">
                        <div class="col-md-6">
                            <input type="radio" name="credit_wallet" id="credit_wallet_1" required="required" value="Credit" /> Amount Recived Against Standing Credit <br />
                            <input type="radio" name="credit_wallet" id="credit_wallet_2" required="required" value="Wallet" /> Amount To be Deducted from his Wallet (This will reduce the wallet amount of User) <br />
                        </div>
                    </div>
                    <div class="row top_margin_10">
                        <div class="col-md-6">
                            <label>Update Credit After Reducing from Wallet</label>
                            <select name="update_credit" id="update_credit" class="form-control" disabled="disabled">
                                <option value="">Select Yes / No</option>
                                <option value="Yes">Update Standing Credit</option>
                                <option value="No">Donot Change Standing Credit</option>
                            </select>
                        </div>
                    </div>
                    <div class="row top_margin_10">
                        <div class="col-md-6">
                            <input type="hidden" name="updte" id="updte" value="1" />
                            <input type="hidden" name="user_id" id="user_id" value="<?= $o1->user_id; ?>" />
                            <input type="submit" name="save" id="save" value="Save" class="btn btn-primary" <?php if ($o1->user_id == 0) { ?> disabled="disabled" <?php } ?> />
                            <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-secondary" onclick="window.location.href = 'team.php'" />

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
<!-- /.container-fluid