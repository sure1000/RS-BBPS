<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
<div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <div id="tabled_data">
                        <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="rech_beneficiary_list">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th> Beneficiary Details</th>
                                    <th> Address</th>
                                    <th> Bank Details</th>
                                    <th> Account Details</th>
                                    
                                    <th> Action</th>
                                    
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="processing" style="display: none;" class="col-md-12 text-center">
                        <?php include "templates/" . $res_template[0]['template_name'] . "/processing.php";?>
                    </div>
                </div>
            </div>
        </div>
    
</div>
<!-- /.container-fluid -->