<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" href="../img/<?=$res_site[0]['logo'];?>">
  <title><?=$res_site[0]['site_name'];?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-md-8">

        <div class="card o-hidden border-0 my-5" >
          <div class="card-body p-0"  style="border:1px solid #ddd;border-radius: 4px;">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <img src="../img/<?=$res_site[0]['logo'];?>" alt="ShibaTechnology" style="width:200px;margin-left: -14px;" />
                  <div>
                    <h2 class="h4 text-gray-900 mb-2">Transaction Receipt</h2>
                  </div>
                  <div class="row">
                    <div class="col-md-8 small">DATE</div>
                    <div class="col-md-4 small">ORDER NO.</div>
                    <div class="col-md-8 small"><?=format_date_without_br($res[0]['transaction_date']);?></div>
                    <div class="col-md-4 small"><?=$res[0]['ref_number'];?></div>
                  </div>

                  <div class="row" style="margin-top:20px;">
                    <div class="col-md-12 text-gray-600 text-left small">BILLED TO</div>
                    <div class="col-md-12 text-gray-800 text-left small"><?=ucwords($o->name);?></div>
                    <div class="col-md-12 text-gray-800 text-left small"><?=$o->mobile;?></div>
                    <div class="col-md-12 text-gray-800 text-left small"><?=$o->email;?></div>
                  </div>
                  <div class="row" style="margin-top: 10px;border:1px solid #ddd;padding:20px;">
                    <div class="col-md-4 small" style="border-right:1px solid #ddd;">
                      Recharge of Number<br /><br />
                      <b><?=$res[0]['mobile_number'];?></b>
                    </div>
                    <div class="col-md-4 small" style="border-right:1px solid #ddd;">
                      Operator<br /><br />
                      <b><?=$res[0]['provider_name'];?></b>
                    </div>
                    <div class="col-md-4 small">
                      Amount Paid<br /><br />
                      <b><b><i class="fa fa-rupee-sign"></i> <?=$res[0]['amount'];?></b>
                    </div>
                  </div>

                  <div class="row bg-gray-100" style="margin-top: 10px;border:1px solid #ddd;padding:20px;">
                    <div class="col-md-12 small"><b>Payment Details</b></div>
                  </div>
                  <div class="row" style="border:1px solid #ddd;padding:20px;">
                    <div class="col-md-7 small">Operator Reference Number</div>
                    <div class="col-md-5 text-right small"><?=$res[0]['opid'];?></div>
                  </div>
                  <div class="row" style="border:1px solid #ddd;padding:20px;">
                    <div class="col-md-7 small">Amount Paid</div>
                    <div class="col-md-5 text-right small">Rs. <?=$res[0]['amount'];?></div>
                  </div>
                  <div class="row" style="margin-top: 10px;">
                    <div class="col-md-12 small"><b>Note:</b> This is computer generated receipt and does not require physical signature.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
