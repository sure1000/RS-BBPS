<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800"><?= $o1->plan_name; ?>  Plans</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $o1->plan_name; ?> Plans Details</h6>
        </div>
        <div class="card-body">
            <form name="ra" id="ra" method="post" action="plan_commission.php?aid=<?= $o1->user_plan_id; ?>" onsubmit="return false;" >
                <div class="row">
                    <div class="col-md-12 bg-danger text-gray-100">
                        <b>Clicking "Apply To All" will apply commission for "All <?= $service_name; ?> Providers" displayed below.</b>
                    </div>
                </div>
				
				 <div class="row top_margin_10">
                    <div class="col-md-2">
                        <label>Services</label>
                    </div>
					
					<div class="col-md-2">
                        <label>Type(MD)</label>
                    </div>
                    <div class="col-md-1">
                        <label>Amt /% (MD)</label>
                    </div>
					
                    <div class="col-md-2">
                        <label>Type(DT)</label>
                    </div>
                    <div class="col-md-1">
                        <label>Amt /% (DT)</label>
                    </div>
                    <div class="col-md-2">
                        <label>Type(RT)</label>
                    </div>
                    <div class="col-md-1">
                        <label>Amt /% (RT)</label>
                    </div>

                    <div class="col-md-1">
                        <label>&nbsp;</label>
                    </div>

                </div>
				
				
                <div class="row top_margin_10">
                    <div class="col-md-2">
                        <select name="services" id="services" class="form-control" onchange="update_form(2)">
                            <option value="0">All Services</option>
                            <?= service_list($service_id); ?>
                        </select>
                    </div>
					
					<div class="col-md-2">
                        <select name="all_type_md" id="all_type_md" class="form-control">
                            <option value="Commission Percentage">Commission Percentage</option>
                            <option value="Commission Flat">Commission Flat</option>
                            <option value="Surcharge Percentage">Surcharge Percentage</option>
                            <option value="Surcharge Flat">Surcharge Flat</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <input type="number" name="all_commission_amount_md" id="all_commission_amount_md" class="form-control" placeholder="" step="0.01" />
                    </div>
					
                    <div class="col-md-2">
                        <select name="all_type_dt" id="all_type_dt" class="form-control">
                            <option value="Commission Percentage">Commission Percentage</option>
                            <option value="Commission Flat">Commission Flat</option>
                            <option value="Surcharge Percentage">Surcharge Percentage</option>
                            <option value="Surcharge Flat">Surcharge Flat</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <input type="number" name="all_commission_amount_dt" id="all_commission_amount_dt" class="form-control" placeholder="" step="0.01" />
                    </div>
                    <div class="col-md-2">
                        <select name="all_type_rt" id="all_type_rt" class="form-control">
                            <option value="Commission Percentage">Commission Percentage</option>
                            <option value="Commission Flat">Commission Flat</option>
                            <option value="Surcharge Percentage">Surcharge Percentage</option>
                            <option value="Surcharge Flat">Surcharge Flat</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <input type="number" name="all_commission_amount_rt" id="all_commission_amount_rt" class="form-control" placeholder="" step="0.01" />
                    </div>

                    <div class="col-md-1">
                        <input type="button" name="apply_all" id="apply_all" class="btn btn-primary form-control" value="Apply" onclick="update_form(3)" />
                    </div>

                </div>
                <hr />
                <div class="row top_margin_10">
                    <div class="col-md-2 ">
                        <b>Provider Name</b>
                    </div>
					
					<div class="col-md-2">
                        <b>Type (MD)</b>
                    </div>
                    <div class="col-md-1">
                        <b>Amt / % (MD)</b>
                    </div>
                    <div class="col-md-2">
                        <b>Type (DT)</b>
                    </div>
                    <div class="col-md-1">
                        <b>Amt / % (DT)</b>
                    </div>
                    <div class="col-md-2">
                        <b>Type (RT)</b> 
                    </div>
                    <div class="col-md-1">
                        <b>Amt / % (RT)</b>
                        <input type="hidden" name="total_providers" id="total_providers" value="<?= $rows; ?>" />
                    </div>
                </div>
                <?php for ($i = 0; $i < $rows; $i++) { ?>
                    <div class="row top_margin_10">
                        <div class="col-md-2">
                            <input type="hidden" name="provider_id_<?= $i; ?>" id="provider_id_<?= $i; ?>" class="form-control" value="<?= $res[$i]['provider_id']; ?>" />
                            <input type="hidden" name="user_plan_service_id_<?= $i; ?>" id="user_plan_service_id_<?= $i; ?>" class="form-control" value="<?= $res[$i]['user_plan_service_id']; ?>" />
                            <input type="text" name="provider_<?= $res[$i]['provider_id']; ?>" id="provider_<?= $i; ?>" class="form-control" value="<?= $res[$i]['provider']; ?>" readonly="readonly" class="form-control" />
                        </div>
						 
						 <div class="col-md-2">
                            <select name="type_md_<?= $res[$i]['provider_id']; ?>" id="type_md_<?= $res[$i]['provider_id']; ?>" class="form-control">
                                <option value="Commission Percentage" <?php if($res[$i]['type_md'] == "Commission Percentage") { ?> selected <?php } ?> >Commission Percentage</option>
                                <option value="Commission Flat" <?php if($res[$i]['type_md'] == "Commission Flat") { ?> selected <?php } ?>>Commission Flat</option>
                                <option value="Surcharge Percentage" <?php if($res[$i]['type_md'] == "Surcharge Percentage") { ?> selected <?php } ?>>Surcharge Percentage</option>
                                <option value="Surcharge Flat" <?php if($res[$i]['type_md'] == "Surcharge Flat") { ?> selected <?php } ?>>Surcharge Flat</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <input type="number" name="commission_amount_md_<?= $res[$i]['provider_id']; ?>" id="commission_amount_md_<?= $i; ?>" class="form-control" value="<?= $res[$i]['commission_amount_md']; ?>" class="form-control" step="0.01" />
                        </div>
						
                        <div class="col-md-2">
                            <select name="type_dt_<?= $res[$i]['provider_id']; ?>" id="type_dt_<?= $res[$i]['provider_id']; ?>" class="form-control">
                                <option value="Commission Percentage" <?php if($res[$i]['type_dt'] == "Commission Percentage") { ?> selected <?php } ?> >Commission Percentage</option>
                                <option value="Commission Flat" <?php if($res[$i]['type_dt'] == "Commission Flat") { ?> selected <?php } ?>>Commission Flat</option>
                                <option value="Surcharge Percentage" <?php if($res[$i]['type_dt'] == "Surcharge Percentage") { ?> selected <?php } ?>>Surcharge Percentage</option>
                                <option value="Surcharge Flat" <?php if($res[$i]['type_dt'] == "Surcharge Flat") { ?> selected <?php } ?>>Surcharge Flat</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <input type="number" name="commission_amount_dt_<?= $res[$i]['provider_id']; ?>" id="commission_amount_dt_<?= $i; ?>" class="form-control" value="<?= $res[$i]['commission_amount_dt']; ?>" class="form-control" step="0.01" />
                        </div>
						
                        <div class="col-md-2">
                            <select name="type_rt_<?= $res[$i]['provider_id']; ?>" id="type_rt_<?= $res[$i]['provider_id']; ?>" class="form-control">
                        <option value="Commission Percentage" <?php if($res[$i]['type_rt'] == "Commission Percentage") { ?> selected <?php } ?> >Commission Percentage</option>
                                <option value="Commission Flat" <?php if($res[$i]['type_rt'] == "Commission Flat") { ?> selected <?php } ?>>Commission Flat</option>
                                <option value="Surcharge Percentage" <?php if($res[$i]['type_rt'] == "Surcharge Percentage") { ?> selected <?php } ?>>Surcharge Percentage</option>
                                <option value="Surcharge Flat" <?php if($res[$i]['type_rt'] == "Surcharge Flat") { ?> selected <?php } ?>>Surcharge Flat</option>
                            
                            </select>
                        </div>
                        <div class="col-md-1">
                            <input type="number" name="commission_amount_rt_<?= $res[$i]['provider_id']; ?>" id="commission_amount_rt_<?= $i; ?>" class="form-control" value="<?= $res[$i]['commission_amount_rt']; ?>" class="form-control" step="0.01" />
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