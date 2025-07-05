<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Balance Check</h1>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Balance Check</h6>
        </div>
        <div class="card-body">

                <div class="row">
                    <div class="col-md-12 text-primary">
                        <strong>URL Of Balance Check</strong>
                    </div>
                    <div class="col-md-12">
                        URL You Passed: <span class="text-success"><?=$res_site[0]['site_url'];?>/apiservice/check_balance.php?uname=<?=$o->user_name;?>&api_token=<?=$res[0]['authorization_key'];?></span>
                    </div>
                    <div class="col-md-12 text-primary">
                        Copy URL from Below
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="url" id="url" class="form-control" readonly="readonly" value="<?=$res_site[0]['site_url'];?>/apiservice/check_balance.php?uname=<?=$o->user_name;?>&api_token=<?=$res[0]['authorization_key'];?>" />
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
                                <td>uname</td>
                                <td><b class="text-primary"><?=$o->user_name;?></b> (This is your user name)</td>
                            </tr>
                            <tr>
                                <td>api_token</td>
                                <td><b class="text-primary"><?=$res[0]['authorization_key'];?></b> (This is authorization key for <?=$res[0]['ip_address'];?>)</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12 text-primary">
                        <b>Response (Only in JSON Format)</b>
                    </div>
                    <div class="col-md-12">
                        {"balance":"20384.23"}
                    </div>
                    <div class="col-md-12">
                        <table class="table table-responsive-lg table-striped table-bordered" width="100%" >
                            <tr>
                                <th>Parameter</th>
                                <th>Response</th>
                            </tr>
                            <tr>
                                <td>balance</td>
                                <td><b class="text-primary">20384.23</b> (Balance Amount with Abhipay)</td>
                            </tr>
                        </table>
                    </div>
                </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->