<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 ">
                <div id="tabled_data">
                    <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="beneficiary_list">
                        <thead>
                            <tr>
                                <th >Beneficary Detail</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div id="processing" style="display: none;" class="col-md-12 text-center">
                    <?php include "templates/" . $res_template[0]['template_name'] . "/processing.php"; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ipay_ben_del_otp_md" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content  ">
            <div class="modal-header">

                <h4 class="modal-title" id="formModalLabel">Beneficiary Delete</h4>
            </div>
            <div class="modal-body">
                <form id="ipay_ben_del_otp" name="ipay_ben_del_otp" class="custom-form-style"  method="POST" onsubmit="return false;" >

                    <div class="form-content">
                        <div class="col-md-12 top_margin_10">
                            <label><i class="fa fa-map-marker"></i> Otp</label>
                            <input type="text" name="ipay_del_otp" id="ipay_del_otp" class="form-control" required="required" placeholder=" OTP" />
                        </div>

                        <div class="col-md-12 top_margin_10">
                            <label>&nbsp;</label>
                            <input type="hidden" name="updte" id="updte" value="1" />
                            <input type="hidden" name="benificiary_id_del" id="benificiary_id_del" value="0" />
                            <button type="submit" name="ipay_submit_del" id="ipay_submit_del" class="btn btn-primary form-control btn-large" />Verify </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



<!-- /.container-fluid -->