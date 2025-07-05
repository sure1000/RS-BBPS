<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Report</h1>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
        </div>
        <div class="card-body">
            <form name="search_txn" id="search_txn" method="post"  action="list_excel_report.php" onsubmit="return false;" >
                <div class="row">
                    <div class="col-md-3">
                        <label>Service</label>
                        <select name="service_id" id="service_id" class="form-control">
                            <option value="0">Select Service</option>
                            <?= service_list(0); ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Provider</label>
                        <div id="provider_list">
                            <select name="provider_id" id="provider_id" class="form-control" disabled="disabled">
                                <option value="0">Select Provider</option>
                                <?= get_provider_list_by_service($provider_id, 0); ?>
                            </select>
                        </div>
                    </div>
                  
                       
                    <div class="col-md-3">
                        <label>From</label>
                        <input type="date" class="form-control" name="from_date" id="from_date" placeholder="From Date" />
                    </div>
                    <div class="col-md-3">
                        <label>To</label>
                        <input type="date" class="form-control" name="to_date" id="to_date" placeholder="To Date"   />
                    </div>
                  
                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <input type="submit" name="search_result" id="search_result" class="form-control btn btn-primary" value="Search Records" />
                    </div>

                </div>
            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <div class="col-md-12 text-left ">
               Report
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 ">
                    <div id="tabled_data">
                        <table class="table table-responsive-lg table-striped table-bordered" width="100%" id="excel_report">
                            <thead style="color:#fff;background-color:#034ea1">
                                <tr>
                                    <th>Provider</th>
                                    <th>Admin Total Comm.</th>
                                    <th>DT Comm.</th>
                                    <th>RT Comm.</th>
                                    <th>Surcharge</th>
                                    <th>Profit</th>
                                    <th>Total Sell</th>
                                    <th>Admin Total Profit</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="processing" style="display: none;" class="col-md-12 text-center">
                        <?php include "processing.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<div class="modal fade " id="action_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true" style="padding-right: 17px; display: none;">
    <div class="modal-dialog modal-lg" role="document" style="    margin-top: 5px;">

        <div class="modal-content">
            <div class="modal-header head_modal">
                <h5 class="modal-title" id="exampleModalLabel"><span id="modal_head"></span></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div id="retry_div">
                <div class="modal-body">

                    <div id="modal_body1"></div>  
                </div>

            </div>
            <div id="processing_wallet" style="display:none;width:100%;text-align: center;">
                <?php include "html/processing.php"; ?>
            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->