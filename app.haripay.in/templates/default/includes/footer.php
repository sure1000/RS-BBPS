<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?=$res_site[0]['site_name'];?> 2012-2025 | All rights reserved.</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="status_check" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Check Status</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div id="status_check_result" class="text-center" style="display: none;">

                </div>
                <div id="status_check_processing" class="text-center" style="display: block;">
                    <?php include $path . "processing.php";?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="notice_board" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Notice Board</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <img src="./notice_board/<?=$res_notice[0]['notice_file'];?>" style='width:100%;' alt='notice' />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="dispute_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Raise a Dispute?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form name="dispute_raise" id="dispute_raise" method="post" action="dispute.php" onsubmit="return false;">
                <div id="disputed_div">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="dispute_issue" id="dispute_issue" rows="5" class="form-control" placeholder="What is the dispute" required="required"></textarea>
                            </div>
                            <div class="col-md-12 text-right top_margin_10">
                                <input type="hidden" name="ref_no_dispute" id="ref_no_dispute" value="0" />
                                <input type="hidden" name="dispute_updte" id="dispute_updte" value="1" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="submit_dispute" id="submit_dispute" class="btn btn-primary" value="Raise Dispute" />
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
                <div id="dispute_processing" class="text-center" style="display: none;">
                    <?php include $path . "processing.php";?>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="./vendor/sweetalert/sweetalert.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<input type="hidden" name="msg_id" id="msg_id" value="<?=$msg_id;?>" />
<input type="hidden" name="kyc_id" id="kyc_id" value="<?=$kyc_id;?>" />
<input type="hidden" name="notice_id" id="notice_id" value="<?=$show_notice;?>" />
<input type="hidden" name="search_new" id="search_new" value="" />
<script src="./js/custom.js"></script>

<sc
</script>

<?php if ($charts == 1) {?>
    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <!--script src="js/demo/chart-area-demo.js"></script-->
    <?php include "./js/demo/chart-area-demo.php";?>
    <?php include "./js/demo/chart-area-revenue.php";?>
    <?php include "./js/demo/chart-pie-turnover.php";?>
    <?php include "./js/demo/chart-pie-revenu.php";?>
<?php }?>
<?php if ($tables == 1) {?>
    <script type="text/JavaScript" src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script type="text/JavaScript" src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script type="text/JavaScript" src="js/demo/datatables-demo.js"></script>
    <script type="text/JavaScript" src="vendor/datatables/dataTables.buttons.min.js"></script>
    <script type="text/JavaScript" src="vendor/datatables/buttons.flash.min.js"></script>
    <script type="text/JavaScript" src="vendor/datatables/jszip.min.js"></script>
    <script type="text/JavaScript" src="vendor/datatables/pdfmake.min.js"></script>
    <script type="text/JavaScript" src="vendor/datatables/vfs_fonts.js"></script>
    <script type="text/JavaScript" src="vendor/datatables/buttons.html5.min.js"></script>
    <script type="text/JavaScript" src="vendor/datatables/buttons.print.min.js"></script>

<?php }?>
</body>
</html>