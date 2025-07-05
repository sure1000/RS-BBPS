<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Recharge API</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Prepaid Recharge (IP Address & Ket must match)</h6>
        </div>
        <div class="card-body">
            <form name="rapp" id="rapp" method="post"  action="api_ip_key.php">
                <div class="row">
                    <div class="col-md-12 text-primary">
                        <strong>Example to Recharge Prepaid Number</strong>
                    </div>
                    <div class="col-md-12">
                        <?=$url_prepaid;?>
                    </div>
                    <div class="col-md-12">
                        <label class="text-primary"><b>Copy URL From Below</b></label>
                        <input type="text" class="form-control" value="<?=$url_prepaid;?>" readonly="readonly" />
                    </div>
                    <div class="col-md-12 text-primary">
                        <b>Parameters for these are as follows:</b>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-responsive-lg table-striped table-bordered" width="100%" >
                            <tr>
                                <th>Parameter</th>
                                <th>Details</th>
                            </tr>
                            <tr>
                                <td>Uname</td>
                                <td><b class="text-primary"><?=$o->user_name;?></b> (This is your unique User Name)</td>
                            </tr>
                            <tr>
                                <td>api_token</td>
                                <td><b class="text-primary"><?=$res[0]['authorization_key'];?></b> (Each IP Address has unique Authorization Key. Please match it. This one is applicable to <?=$res[0]['ip_address'];?>)</td>
                            </tr>
                            <tr>
                                <td>operator</td>
                                <td><b class="text-primary">4</b> (You can check operator codes <a href="api_operator_codes.php">Here</a>. 4 is for JIO Prepaid)</td>
                            </tr>
                            <tr>
                                <td>circle</td>
                                <td><b class="text-primary">18</b> (You can check circle codes <a href="api_operator_codes.php">Here</a>. 18 is for Punjab)</td>
                            </tr>
                            <tr>
                                <td>number</td>
                                <td><b class="text-primary">9337692413</b> (Prepaid Number you want to recharge)</td>
                            </tr>
                            <tr>
                                <td>amount</td>
                                <td><b class="text-primary">11</b> (Recharge Amount)</td>
                            </tr>
                            <tr>
                                <td>reqid</td>
                                <td><b class="text-primary"><?=$reqid;?></b> (Unique Request Id)</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Postpaid Recharge (IP Address & Ket must match)</h6>
        </div>
        <div class="card-body">
            <form name="rapp" id="rapp" method="post"  action="api_ip_key.php">
                <div class="row">
                    <div class="col-md-12 text-primary">
                        <strong>Example to Recharge Postpaid Number</strong>
                    </div>
                    <div class="col-md-12">
                        <?=$url_postpaid;?>
                    </div>
                    <div class="col-md-12">
                        <label class="text-primary"><b>Copy URL From Below</b></label>
                        <input type="text" class="form-control" value="<?=$url_postpaid;?>" readonly="readonly" />
                    </div>
                    <div class="col-md-12 text-primary">
                        <b>Parameters for these are as follows:</b>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-responsive-lg table-striped table-bordered" width="100%" >
                            <tr>
                                <th>Parameter</th>
                                <th>Details</th>
                            </tr>
                            <tr>
                                <td>Uname</td>
                                <td><b class="text-primary"><?=$o->user_name;?></b> (This is your unique User Name)</td>
                            </tr>
                            <tr>
                                <td>api_token</td>
                                <td><b class="text-primary"><?=$res[0]['authorization_key'];?></b> (Each IP Address has unique Authorization Key. Please match it. This one is applicable to <?=$res[0]['ip_address'];?>)</td>
                            </tr>
                            <tr>
                                <td>operator</td>
                                <td><b class="text-primary">9</b> (You can check operator codes <a href="api_operator_codes.php">Here</a>. 9 is for JIO Postpaid)</td>
                            </tr>
                            <tr>
                                <td>circle</td>
                                <td><b class="text-primary">18</b> (You can check circle codes <a href="api_operator_codes.php">Here</a>. 18 is for Punjab)</td>
                            </tr>
                            <tr>
                                <td>number</td>
                                <td><b class="text-primary">9216000700</b> (Postpaid Number you want to recharge)</td>
                            </tr>
                            <tr>
                                <td>amount</td>
                                <td><b class="text-primary">20</b> (Recharge Amount)</td>
                            </tr>
                            <tr>
                                <td>reqid</td>
                                <td><b class="text-primary"><?=$reqid1;?></b> (Unique Request Id)</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DTH Recharge (IP Address & Ket must match)</h6>
        </div>
        <div class="card-body">
            <form name="rapp" id="rapp" method="post"  action="api_ip_key.php">
                <div class="row">
                    <div class="col-md-12 text-primary">
                        <strong>Example to Recharge DTH Number</strong>
                    </div>
                    <div class="col-md-12">
                        <?=$url_dth;?>
                    </div>
                    <div class="col-md-12">
                        <label class="text-primary"><b>Copy URL From Below</b></label>
                        <input type="text" class="form-control" value="<?=$url_dth;?>" readonly="readonly" />
                    </div>
                    <div class="col-md-12 text-primary">
                        <b>Parameters for these are as follows:</b>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-responsive-lg table-striped table-bordered" width="100%" >
                            <tr>
                                <th>Parameter</th>
                                <th>Details</th>
                            </tr>
                            <tr>
                                <td>Uname</td>
                                <td><b class="text-primary"><?=$o->user_name;?></b> (This is your unique User Name)</td>
                            </tr>
                            <tr>
                                <td>api_token</td>
                                <td><b class="text-primary"><?=$res[0]['authorization_key'];?></b> (Each IP Address has unique Authorization Key. Please match it. This one is applicable to <?=$res[0]['ip_address'];?>)</td>
                            </tr>
                            <tr>
                                <td>operator</td>
                                <td><b class="text-primary">16</b> (You can check operator codes <a href="api_operator_codes.php">Here</a>. 16 is for TataSky)</td>
                            </tr>
                            <tr>
                                <td>number</td>
                                <td><b class="text-primary">1006300000</b> (DTH Number you want to recharge)</td>
                            </tr>
                            <tr>
                                <td>amount</td>
                                <td><b class="text-primary">20</b> (Recharge Amount)</td>
                            </tr>
                            <tr>
                                <td>reqid</td>
                                <td><b class="text-primary"><?=$reqid2;?></b> (Unique Request Id)</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>



</div>
<!-- /.container-fluid -->