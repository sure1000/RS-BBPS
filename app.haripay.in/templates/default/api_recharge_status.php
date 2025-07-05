
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Recharge Status Check</h1>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Check the Status of Recharge</h6>
        </div>
        <div class="card-body">
            <form name="rapp" id="rapp" method="post"  action="api_ip_key.php">
                <div class="row">
                    <div class="col-md-12 text-primary">
                        <strong>Example of Recharge Status Check URL </strong>
                    </div>
                    <div class="col-md-12">
                        <?=$res_site[0]['site_url'];?>/apiservice/response.php?uname=<?=$o->user_name;?>&api_token=<?=$res[0]['api_token'];?>&reqid=2344562365
                    </div>
                    <div class="col-md-12 text-primary">
                        Copy the URL from Below
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="url" id="url" class="form-control" value="<?=$res_site[0]['site_url'];?>/apiservice/response.php?uname=<?=$o->user_name;?>&api_token=<?=$res[0]['api_token'];?>&reqid=2344562365" readonly="readonly" />
                    </div>
                    <div class="col-md-12 text-primary">
                        <b>Parameters for these are as follows:</b>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-responsive-lg table-striped table-bordered" width="100%" >
                            <tr>
                                <th>Parameter</th>
                                <th>Response</th>
                            </tr>
                            <tr>
                                <td>api_token</td>
                                <td><b class="text-primary"><?=$res[0]['api_token'];?></b> (This is your Authorization Key for IP <?=$res[0]['ip_address'];?>)</td>
                            </tr>
                            <tr>
                                <td>reqid</td>
                                <td><b class="text-primary">2344562365</b> (Request ID you have sent while recharging)</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Response (This will only give results in Json)</h6>
        </div>
        <div class="card-body">

                <div class="row">
                    <div class="col-md-12 text-primary">
                        <strong>Example of Response</strong>
                    </div>
                    <div class="col-md-12">
                        {"reqid":"2344562365","status":"Success","amount":"20","commission":"4","opid":"45093860356"}
                    </div>
                    <div class="col-md-12 text-primary">
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