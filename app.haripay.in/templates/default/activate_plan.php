<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Activate <?=$o1->plan_name;?> API Plan</h1>
        </div>
    </div>
    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <div class="col-md-12 text-left ">
                Invoice
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h1>Invoice</h1>
                </div>
                <div class="col-md-4 text-right">
                    <img src="./img/<?=$res_site[0]['logo'];?>" alt="site name" style="width:100px;" /> 
                    <h4>Date: <?= format_date_only(todaysDate_only());?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    From<br />
                    <b><?=$res_site[0]['site_name'];?></b><br />
                    S-100, First Phase Rico Industrial Area<br />
                    Jhunjhunu<br />
                    Rajasthan - 3330001<br />
                    Phone: +91 <?=$res_site[0]['mobile'];?><br />
                    Email: +91 <?=$res_site[0]['email'];?>
                </div>
                <div class="col-md-4">
                    To<br />
                    <b><?=$o->company_name;?></b><br />
                    <?=$o->user_address;?><br />
                    <?=$o->district;?><br />
                    <?=$o->state;?> - <?=$o->pincode;?><br />
                    Phone: +91 <?=$o->mobile;?><br />
                    Email: +91 <?=$o->email;?>
                </div>
                <div class="col-md-4">
                    <b>Invoice #<?= reference_number();?></b><br /><br />
                    
                    <b>Plan:</b> <?=$o1->plan_name;?><br />
                    <b>Payment Due:</b> <?= format_date_only(todaysDate_only());?><br />
                    <b>Account:</b> Wallet Balance<br />
                    <b>GST No:</b> 08BEQPK9277N2ZB<br />
                </div>
            </div>
            <div class="row top_margin_10">
                <div class="col-md-12">
                    <table class="table table-responsive-lg table-striped " width="100%">
                        <thead>
                            <tr>
                                <th width="20%">QTY</th>
                                <th width="30%">Product</th>
                                <th width="50%" class="text-right">Sub Total</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>1</td>
                            <td><?=$o1->plan_name;?></td>
                            <td class="text-right"><i class="fa fa-rupee-sign"></i> <?=$o1->amount;?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row top_margin_10">
                <div class="col-md-6 ">
                    <strong>Payment Methods:</strong><br />
                    <?=$res_site[0]['site_name'];?> Wallet<br />
                    <div class="col-md-12 bg-gray-200 border-left-danger">
                        Payment Once Deducted will not be refunded back.<br />
                        New Package will be effective immediately<br />
                        You will be only charged Upgradation Amount<br />
                        A Lesser Amount Package will only have rates changed. No Refund will be processed
                    </div>
                    <div class="col-md-12 top_margin_10">
                        <a href="pay_plan.php?aid=<?=$o1->user_plan_id;?>" class="btn btn-success">Pay & Activate Plan</a>
                        <a href="membership.php" class="btn btn-secondary">Cancel & Go Back</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12 border-bottom-1">
                        <strong>Amount To Be Deducted</strong>
                    </div>
                    <div class="row border-bottom-1 border_box text-gray-800">
                        <div class="col-md-6 small"><b>Sub Total:</b></div>
                        <div class="col-md-6 small"><i class="fa fa-rupee-sign"></i> <?=$o1->amount;?></div>                        
                    </div>
                    <div class="row border-bottom-1 border_box text-gray-800">
                        <div class="col-md-6 small"><b>Discount:</b></div>
                        <div class="col-md-6 small"><i class="fa fa-rupee-sign"></i> <?=$discount;?></div>                        
                    </div>
                    <div class="row border-bottom-1 border_box text-gray-800">
                        <div class="col-md-6 small"><b>Total:</b></div>
                        <div class="col-md-6 small"><i class="fa fa-rupee-sign"></i> <?=$new_amount;?></div>                        
                    </div>
                    <div class="row border-bottom-1 border_box text-gray-800">
                        <div class="col-md-6 small"><b>GST 18%:</b></div>
                        <div class="col-md-6  small"><i class="fa fa-rupee-sign"></i> <?=$gst;?></div>                        
                    </div>
                    <div class="row border-bottom-1 border_box text-gray-800">
                        <div class="col-md-6"><b>Grand Total:</b></div>
                        <div class="col-md-6"><b><i class="fa fa-rupee-sign"></i> <?= round($new_amount + $gst, 2); ?></b></div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->