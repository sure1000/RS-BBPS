<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Call Back URL</h1>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 text-primary">
                        <strong>We will hit these URL once the status of the Recharge is changed.</strong>
                </div>
                <div class="col-md-12 text-primary">
                        <strong>URL = http://yourdomain.com/call_back_url</strong><br />
                        <strong class="text-danger">(We will pass Parameters & Response ourselves. Donot add those)</strong>
                </div>
            </div>
            <form name="rapp" id="rapp" method="post"  action="api_call_back.php">
                <?php for ($i = 0; $i < $rows; $i++) {?>
                    <div class="row">
                        <div class="col-md-3">
                            <label>Ip Address</label>
                            <input type="text" name="ip_address_<?=$i;?>" id="ip_address_<?=$i;?>" class="form-control" value="<?=$res[$i]['ip_address'];?>" readonly = "readonly" />
                            <input type="hidden" name="key_id_<?=$i;?>" id="key_id_<?=$i;?>" value="<?=$res[$i]['api_ip_key_id'];?>" />
                        </div>
                        <div class="col-md-6">
                            <label>Call Back URL</label>
                            <input type="text" name="call_back_url_<?=$i;?>" id="call_back_url_<?=$i;?>" class="form-control" value="<?=$res[$i]['call_back_url'];?>" placeholder = "Enter Call Back  Url" />
                        </div>
                    </div>
                <?php }?>
                <div class="row top_margin_10">
                    <div class="col-md-12">
                        <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Save Call Back Url" />
                        <input type="hidden" name="updte" id="updte" value="1" />
                        <input type="hidden" name="total_rows" id="total_rows" value="<?=$rows;?>" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Call Back URL Example, Parameters and Response (Remember we add Parameters and Response Ourselves)</h6>
        </div>
        <div class="card-body">

                <div class="row">
                    <div class="col-md-12 text-primary">
                        <strong>Example of Call Back URL</strong>
                    </div>
                    <div class="col-md-12">
                        URL You Passed: <span class="text-success">http://yourdomain.com/call_back_url</span>
                    </div>
                    <div class="col-md-12">
                        Parameter & Response we add: <span class="text-success">reqid=<?=$reqid;?>&status=Success&amount=20&commission=4&opid=45093860356</span>
                    </div>
                    <div class="col-md-12">
                        <strong>Complete URL We will hit<br /></strong>
                        <strong class="text-primary">http://yourdomain.com/call_back_url?reqid=<?=$reqid;?>&status=Success&amount=20&commission=4&opid=45093860356</strong>
                    </div>
                    <div class="col-md-12 text-success">
                        <b>Parameters for these are as follows:</b>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-responsive-lg table-striped table-bordered" width="100%" >
                            <tr>
                                <th>Parameter</th>
                                <th>Response</th>
                            </tr>
                            <tr>
                                <td>reqid</td>
                                <td><b class="text-primary"><?=$reqid;?></b> (This is your unique Request ID, that has been passed to us by yourself)</td>
                            </tr>
                            <tr>
                                <td>status</td>
                                <td><b class="text-primary">Success</b> (It can be any of these 3 <b class="text-primary">Success</b> | <b class="text-primary">Pending</b> | <b class="text-primary">Failed</b>)</td>
                            </tr>
                            <tr>
                                <td>amount</td>
                                <td><b class="text-primary">20</b> (Amount for which the recharge was requested)</td>
                            </tr>
                            <tr>
                                <td>commission</td>
                                <td><b class="text-primary">4</b> (Depending upon the plan you have earned from us)</td>
                            </tr>
                            <tr>
                                <td>opid</td>
                                <td><b class="text-primary">45093860356</b> (Operator ID passed from Operator / Provider)</td>
                            </tr>

                        </table>
                    </div>
                </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->