<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800"><?= $o1->api_name; ?> API Circle Code</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $o1->api_name; ?> Circle Codes</h6>
        </div>

        <div class="card-body">
            <form name="ra" id="ra" method="post" action="api_circle_code.php?api_id=<?= $o1->api_id; ?>" onsubmit="return false;" >
                     <input type="hidden" name="total_providers" id="total_providers" value="<?=$rows;?>" />
              
                <div class="row top_margin_10">                    
                    <div class="col-md-3 ">
                        <b>Circle Name</b>
                    </div>
                    <div class="col-md-3">
                        <b>Circle Code</b>
                    </div>
                    <div class="col-md-3 ">
                        <b>Circle Name</b>
                    </div>
                    <div class="col-md-3">
                        <b>Circle Code</b>
                    </div>
                </div>
                <div class="row top_margin_10">
                 <?php for($i=0;$i<$rows;$i++){ ?>
                    
                        <div class="col-md-3 top_margin_10">
                            <input type="hidden" name="circle_id_<?=$i;?>" id="circle_id_<?=$i;?>" class="form-control" value="<?=$res[$i]['service_circle_id'];?>" /> 
                            <input type="hidden" name="api_circle_code_<?=$i;?>" id="api_circle_code_<?=$i;?>" class="form-control" value="<?=$res[$i]['api_circle_code_id'];?>" /> 
                            
                            <input type="text" name="circle_<?=$res[$i]['service_circle_id'];?>" id="circle_<?=$i;?>" class="form-control" value="<?=$res[$i]['circle_name'];?>" readonly="readonly" class="form-control" /> 
                        </div>
                        <div class="col-md-3 top_margin_10">
                            <input type="text" name="circle_code_<?=$res[$i]['service_circle_id'];?>" id="circle_code_<?=$i;?>" class="form-control" value="<?=$res[$i]['circle_code'];?>" class="form-control" placeholder="Circle Code"  />
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