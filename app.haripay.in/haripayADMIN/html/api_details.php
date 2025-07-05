<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Api Details</h1> Callback Url -  <? echo "https://".$_SERVER['SERVER_NAME'];; ?>/callback_apis<?= $o1->api_id; ?>.php
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold"><?php if ($o1->api_id > 0) { ?> Edit <?php } else { ?> Add <?php } ?> api Details</h6>
        </div>
        
      
        
        <div class="card-body">
            <form name="ra" id="ra" method="post" action="api_details.php?aid=<?= $o1->api_id; ?>" onload="document.ra.api_name.focus()">
                <div class="row">
                    <div class="col-md-3">
                        <label>Api Type</label>
                        <select name="api_type" id="api_type" class="form-control">
                            <option value="Other" <?php if ($o1->api_type == "Other") { ?> selected="selected" <?php } ?>>Other</option>
                            <option value="Recharge" <?php if ($o1->api_type == "Recharge") { ?> selected="selected" <?php } ?>>Recharge</option>
                            <option value="BBPS" <?php if ($o1->api_type == "BBPS") { ?> selected="selected" <?php } ?>>BBPS</option>    
                            
                            <option value="SMS" <?php if ($o1->api_type == "SMS") { ?> selected="selected" <?php } ?>>SMS</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Api Name</label>
                        <input type="text" class="form-control" name="api_name" id="api_name" placeholder="Api Name" value="<?= $o1->api_name; ?>" required="required" />
                    </div>
                    <div class="col-md-3">
                        <label>Api Balance</label>
                        <input type="text" class="form-control" name="api_balance" id="api_balance" placeholder="Api Balance" <?php if ($o1->api_id > 0) { ?> readonly="" <?php } ?> value="<?= $o1->api_balance; ?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Status Name</label>
                        <input type="text" class="form-control" name="status_name" id="status_name" placeholder="Status Name" value="<?= $o1->status_name; ?>" required="required" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Api Domain</label>
                        <input type="text" class="form-control" name="api_domain" id="api_domain" placeholder="API Domain" value="<?= $o1->api_domain; ?>"  />
                    </div>
                    <div class="col-md-6">
                        <label>Status Check Url</label>
                        <input type="text" class="form-control" name="status_check_url" id="status_check_url" placeholder="Status Check Url" value="<?= $o1->status_check_url; ?>"  />
                    </div>
                    <div class="col-md-6">
                        <label>Balance Check Url</label>
                        <input type="text" class="form-control" name="balance_check_url" id="balance_check_url" placeholder="Balance Check Url" value="<?= $o1->balance_check_url; ?>"  />
                    </div>
                    <div class="col-md-6">
                        <label>Bill Fetch Url</label>
                        <input type="text" class="form-control" name="bill_fetch_url" id="bill_fetch_url" placeholder="Bill Fetch Url" value="<?= $o1->bill_fetch_url; ?>"  />
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <label>Success Value</label>
                        <input type="text" class="form-control" name="success_value" id="success_value" placeholder="Success Value" value="<?= $o1->success_value; ?>" required="required" />
                    </div>
                    <div class="col-md-3">
                        <label>Failed Value</label>
                        <input type="text" class="form-control" name="failed_value" id="failed_value" placeholder="Failed Value" value="<?= $o1->failed_value; ?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Pending Value</label>
                        <input type="text" class="form-control" name="pending_value" id="pending_value" placeholder="Pending Value" value="<?= $o1->pending_value; ?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Refid Value</label>
                        <input type="text" class="form-control" name="refid_value" id="refid_value" placeholder="Refid Value" value="<?= $o1->refid_value; ?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Operator Id</label>
                        <input type="text" class="form-control" name="operator_id" id="operator_id" placeholder="Operator Id" value="<?= $o1->operator_id; ?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Api Username</label>
                        <input type="text" class="form-control" name="api_username" id="api_username" placeholder="Api Username" value="<?= $o1->api_username; ?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Api Key</label>
                        <input type="text" class="form-control" name="api_key" id="api_key" placeholder="Api Key" value="<?= $o1->api_key; ?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Lapu No</label>
                        <input type="text" class="form-control" name="lapu_no" id="lapu_no" placeholder="Lapu No" value="<?= $o1->lapu_no; ?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Remain Balance</label>
                        <input type="text" class="form-control" name="remain_balance" id="remain_balance" placeholder="Remain Balance" value="<?= $o1->remain_balance; ?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Remark</label>
                        <input type="text" class="form-control" name="remark" id="remark" placeholder="Remark" value="<?= $o1->remark; ?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Method</label>
                        <select name="method" id="method" class="form-control">
                            <option value="POST" <?php if ($o1->method == "POST") { ?> selected="selected" <?php } ?>>POST</option>
                            <option value="GET" <?php if ($o1->method == "GET") { ?> selected="selected" <?php } ?>>GET</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Format</label>
                        <select name="format" id="format" class="form-control">
                            <option value="JSON" <?php if ($o1->format == "JSON") { ?> selected="selected" <?php } ?>>JSON</option>
                            <option value="XML" <?php if ($o1->format == "XML") { ?> selected="selected" <?php } ?>>XML</option>
                            <option value="TEXT" <?php if ($o1->format == "TEXT") { ?> selected="selected" <?php } ?>>TEXT</option>
                        </select>
                    </div>
                </div>
                 <hr>
                  <label>Callback Setting</label>
                  <div class="row">
                      <div class="col-md-3">
                        <label>Status Value</label>
                        <input type="text" class="form-control" name="callbackstatus_value" id="callbackstatus_value" placeholder="Status Value" value="<?= $o1->callbackstatus_value; ?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Success Value</label>
                        <input type="text" class="form-control" name="callbacksuccess_value" id="callbacksuccess_value" placeholder="Success Value" value="<?= $o1->callbacksuccess_value; ?>" required="required" />
                    </div>
                    <div class="col-md-3">
                        <label>Failed Value</label>
                        <input type="text" class="form-control" name="callbackfailed_value" id="callbackfailed_value" placeholder="Failed Value" value="<?= $o1->callbackfailed_value; ?>"  />
                    </div>
                    
                    <div class="col-md-3">
                        <label>Refid Value</label>
                        <input type="text" class="form-control" name="callbackrefid_value" id="callbackrefid_value" placeholder="Refid Value" value="<?= $o1->callbackrefid_value; ?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Operator Id</label>
                        <input type="text" class="form-control" name="callbackoperator_id" id="callbackoperator_id" placeholder="Operator Id" value="<?= $o1->callbackoperator_id; ?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Remark</label>
                        <input type="text" class="form-control" name="callbackremark" id="callbackremark" placeholder="Remark" value="<?= $o1->callbackremark; ?>"  />
                    </div>
                    <div class="col-md-3">
                        <label>Method</label>
                        <select name="callbackmethod" id="callbackmethod" class="form-control">
                            <option value="POST" <?php if ($o1->callbackmethod == "POST") { ?> selected="selected" <?php } ?>>POST</option>
                            <option value="GET" <?php if ($o1->callbackmethod == "GET") { ?> selected="selected" <?php } ?>>GET</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Status</label>
                        <select name="is_active" id="is_active" class="form-control">
                            <option value="1" <?php if ($o1->is_active == 1) { ?> selected="selected" <?php } ?>>Active</option>
                            <option value="0" <?php if ($o1->is_active == 0) { ?> selected="selected" <?php } ?>>Blocked</option>
                        </select>
                    </div>

                </div>
                <div class="row top_margin_10">
                    <div class="col-md-6">
                        <input type="hidden" name="updte" id="updte" value="1" />
                        <input type="submit" name="save" id="save" value="Save" class="btn btn-primary" style="background-color:#2AB6A3; border:#2AB6A3;" />
                        <input type="button" name="cancel" id="cancel" value="Cancel" class="btn btn-secondary" onclick="history.back(-1)" />
                    </div>
                </div>
                
                 
        
        
        
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->