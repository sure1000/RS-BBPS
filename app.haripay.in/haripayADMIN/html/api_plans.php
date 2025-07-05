<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800"><?= $o1->api_name; ?> API Plans</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $o1->api_name; ?> Plans Details</h6>
        </div>
        <div class="card-body">
            <form name="ra" id="ra" method="post" action="api_plans.php?api_id=<?= $o1->api_id; ?>" onsubmit="return false;" >
                <div class="row">
                    <div class="col-md-12 bg-danger text-gray-100">
                        <b>Clicking "Apply To All" will apply commission for "All <?=$service_name;?> Providers" displayed below.</b>
                    </div>
                </div>
                <div class="row top_margin_10">
                    <div class="col-md-4">
                        <label>Services</label>
                        <select name="services" id="services" class="form-control" onchange="update_form(2)">
                            <option value="0">All Services</option>
                            <?= service_list($service_id); ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>Amount Or</label>
                        <input type="number" name="all_commission_amount" id="all_commission_amount" class="form-control" placeholder="Commission Amount" step="0.01" />
                    </div>
                    <div class="col-md-2">
                        <label>Percentage</label>
                        <input type="number" name="all_commission_percentage" id="all_commission_percentage" class="form-control" placeholder="Commission Percentage" step="0.01" />
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <input type="button" name="apply_all" id="apply_all" class="btn btn-primary form-control" value="Apply To All" onclick="update_form(3)" />
                    </div>

                </div>
                <hr />
                <div class="row top_margin_10">                    
                    <div class="col-md-4 ">
                        <b>Provider Name</b>
                    </div>
                    <div class="col-md-2">
                        <b>Amount</b> Or
                    </div>
                    <div class="col-md-2">
                        <b>Percentage</b> 
                        <input type="hidden" name="total_providers" id="total_providers" value="<?=$rows;?>" />
                    </div>                    
                </div>
                <?php for($i=0;$i<$rows;$i++){ ?>
                    <div class="row top_margin_10">
                        <div class="col-md-4">
                            <input type="hidden" name="provider_id_<?=$i;?>" id="provider_id_<?=$i;?>" class="form-control" value="<?=$res[$i]['provider_id'];?>" /> 
                            <input type="hidden" name="provider_api_id_<?=$i;?>" id="provider_api_id_<?=$i;?>" class="form-control" value="<?=$res[$i]['api_provider_id'];?>" /> 
                            
                            <input type="text" name="provider_<?=$res[$i]['provider_id'];?>" id="provider_<?=$i;?>" class="form-control" value="<?=$res[$i]['provider'];?>" readonly="readonly" class="form-control" /> 
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="commission_amount_<?=$res[$i]['provider_id'];?>" id="commission_amount_<?=$i;?>" class="form-control" value="<?=$res[$i]['commission_amount'];?>" class="form-control" step="0.01" />
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="commission_percentage_<?=$res[$i]['provider_id'];?>" id="commission_percentage_<?=$i;?>" class="form-control" value="<?=$res[$i]['commission_percentage'];?>" class="form-control" step="0.01" />
                        </div>
                    </div>
                
                <?php } ?>
                
                <div class="row top_margin_10">
                    <div class="col-md-6">
                        <input type="hidden" name="updte" id="updte" value="1" />
                        <input type="button" name="save" id="save" value="Save" class="btn btn-primary" onclick="update_form(1)" />
                        <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-secondary" onclick="history.back(-1)" />

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->