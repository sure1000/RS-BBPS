<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800"><?= $o1->api_name; ?> API Provider Code</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $o1->api_name; ?> Provider Codes</h6>
        </div>
        <div class="card-body">
            <form name="ra" id="ra" method="post" action="api_provider_code.php?api_id=<?= $o1->api_id; ?>" onsubmit="return false;" >
                <div class="row top_margin_10">
                    <div class="col-md-4">
                        <label>Services</label>
                        <select name="services" id="services" class="form-control" onchange="update_form(2)">
                            <option value="0">All Services</option>
                            <?= service_list($service_id); ?>
                        </select>
                        <input type="hidden" name="total_providers" id="total_providers" value="<?=$rows;?>" />
                    </div>
                </div>
                <hr />
                <div class="row top_margin_10">                    
                    <div class="col-md-3 ">
                        <b>Provider Name</b>
                    </div>
                    <div class="col-md-3">
                        <b>Provider Code</b>
                    </div>
                    <div class="col-md-3 ">
                        <b>Provider Name</b>
                    </div>
                    <div class="col-md-3">
                        <b>Provider Code</b>
                    </div>
                </div>
                <div class="row top_margin_10">
                    <?php for($i=0;$i<$rows;$i++){ ?>
                    
                        <div class="col-md-3 top_margin_10">
                            <input type="hidden" name="provider_id_<?=$i;?>" id="provider_id_<?=$i;?>" class="form-control" value="<?=$res[$i]['provider_id'];?>" /> 
                            <input type="hidden" name="api_provider_code_<?=$i;?>" id="api_provider_code_<?=$i;?>" class="form-control" value="<?=$res[$i]['api_provider_code_id'];?>" /> 
                            
                            <input type="text" name="provider_<?=$res[$i]['provider_id'];?>" id="provider_<?=$i;?>" class="form-control" value="<?=$res[$i]['provider'];?>" readonly="readonly" class="form-control" /> 
                        </div>
                        <div class="col-md-3 top_margin_10">
                            <input type="text" name="provider_code_<?=$res[$i]['provider_id'];?>" id="provider_code_<?=$i;?>" class="form-control" value="<?=$res[$i]['provider_code'];?>" class="form-control" placeholder="Provider Code"  />
                        </div>
                    <?php } ?>
                </div>
                
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