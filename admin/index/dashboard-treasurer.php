<?php 
include 'include/conn.php';
session_start();
if(!isset($_SESSION["userpos"]))
header("location:index.php");

$page = 'dashboard-treasurer.php';
$sec = "15";

 ?>
 

<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta  name="description" content="Barangay Milawid Official System" />
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    <title>Barangay System</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/milawid-logo.png" />
    <!-- Custom CSS -->
    <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet" />
  </head>

  <body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>


    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin5">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <?php include'include/navbar02.php'; ?>
      </nav>
    </header>
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
      <!-- ============================================================== -->
      <!-- Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Staff Dashboard</h4>
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php if($_SESSION["userpos"] =='ADMIN02'){ ?>
                  <li class="breadcrumb-item"><a href="dashboard02.php">Home</a></li>
                  <?php }else{ ?>
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <?php } ?>
                  <li class="breadcrumb-item active" aria-current="page">
                    Dashboard
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- ============================================================== -->
      <!-- End Bread crumb and right sidebar toggle -->
      <!-- Container fluid  -->
      <!-- ============================================================== -->
      <div class="container-fluid">
        <div class="col-md-6 col-lg-6 col-xlg-3">
          <a href="notif-treasurer.php" class="d-block">
            <div class="card card-hover mb-4">
              <div class="box bg-warning text-center"><br>
                <h6 style='font-size:25px;' class="text-white"> <b> WEBSITE SERVICE NOTIFICATION </b></h6>
                  <a style='font-size:25px;margin-top: 23px' class='badge btn-danger' ><i class="fa fa-exclamation-triangle" aria-hidden="true" ></i><b>
                    <?php
                      $sqlx = "SELECT count(cnum) as num FROM tbl_payments WHERE status != 'VERIFIED_PAID'";
                    $processQueryx = $conn->query($sqlx);
                    while ($resultQuerx = $processQueryx->fetch_assoc())
                    {echo  $nummx = "(".$resultQuerx['num'].")"; } ?>
                  </b><i class="fa fa-exclamation-triangle" aria-hidden="true" ></i></a>
              </div>
            </div>
          </a>
          <a href="paymentrecord-treasurer.php" class="d-block">
            <div class="card card-hover mb-4">
              <div class="box bg-info text-center py-4">
                <i class="fas fa-clipboard" style="font-size: 8rem; color: rgba(255, 255, 255, 0.25);"></i>
                <br>
                <h6 style='font-size:25px;' class="text-white">Payment Record</h6>
              </div>
            </div>
          </a>
        </div>
      </div>
      <!-- ============================================================== -->
      <!-- End Container fluid  -->
      <!-- ============================================================== -->
      <!-- footer -->
      <!-- ============================================================== -->
      <footer class="footer text-center">
        
      </footer>
      <!-- ============================================================== -->
      <!-- End footer -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->

    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="../assets/libs/flot/excanvas.js"></script>
    <script src="../assets/libs/flot/jquery.flot.js"></script>
    <script src="../assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="../assets/libs/flot/jquery.flot.time.js"></script>
    <script src="../assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="../assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="../assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../dist/js/pages/chart/chart-page-init.js"></script>
  </body>
</html>
