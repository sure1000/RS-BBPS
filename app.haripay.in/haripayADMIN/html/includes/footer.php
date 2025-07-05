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
<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>
<script src="./js/custom.js"></script>

<input type="hidden" name="msg_id" id="msg_id" value="<?=$msg_id;?>" />
<?php if ($charts == 1) {?>
    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <!--script src="js/demo/chart-area-demo.js"></script-->
    <?php include "./js/demo/chart-pie-turnover.php";?>
<?php }?>
<?php if ($tables == 1) {?>
  <script type="text/JavaScript" src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script type="text/JavaScript" src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script type="text/JavaScript" src="../js/demo/datatables-demo.js"></script>
    <script type="text/JavaScript" src="../vendor/datatables/dataTables.buttons.min.js"></script>
    <script type="text/JavaScript" src="../vendor/datatables/buttons.flash.min.js"></script>
    <script type="text/JavaScript" src="../vendor/datatables/jszip.min.js"></script>
    <script type="text/JavaScript" src="../vendor/datatables/pdfmake.min.js"></script>
    <script type="text/JavaScript" src="../vendor/datatables/vfs_fonts.js"></script>
    <script type="text/JavaScript" src="../vendor/datatables/buttons.html5.min.js"></script>
    <script type="text/JavaScript" src="../vendor/datatables/buttons.print.min.js"></script>
<?php }?>
<?php if ($page_name == "api_update_money") {?>

  <script src="./js/api_update_money.js"></script>

<?php }?>
<?php if ($page_name == "index") {?>

  <script src="./js/balance_check.js"></script>

<?php }?>

</body>
</html>