<?php 
include 'include/conn.php';
session_start();
if(!isset($_SESSION["userpos"]))
header("location:index.php");

 ?>
 

<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta  name="description" content="Barangay Milawid Official System" />
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
                    Payment Process / Service
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
        <?php
          $style1 = "style='box-shadow: 1px 2px;color:grey'";
          
          if ($_GET['from'] == "clearance") {
            $title = "Barangay Clearance - Control No.: " . $_GET['cnum'];
            $cnum3 = "A";
            $pur = "Clearance";
          } elseif ($_GET['from'] == "rclearance") {
            $title = "Barangay Clearance - Control No.: " . $_GET['cnum'];
            $cnum3 = $_GET['oldcnum'];
            $pur = "Clearance";
          } elseif ($_GET['from'] == "permit") {
            $title = "Business Permit - Control No.: " . $_GET['cnum'];
            $pur = "Permit";
            $cnum3 = $_GET['oldcnum'];
          } elseif ($_GET['from'] == "residency") {
            $title = "Barangay Residence - Control No.: " . $_GET['cnum'];
            $pur = "Residence";
            $cnum3 = $_GET['oldcnum'];
          } elseif ($_GET['from'] == "residencyb") {
            $title = "Barangay Residence - Control No.: " . $_GET['cnum'];
            $pur = "Residence";
            $cnum3 = $_GET['oldcnum'];
          } elseif ($_GET['from'] == "reclearance") {
            $title = "Barangay Clearance - RENEWAL Control No.: " . $_GET['cnum'];
            $pur = "Clearance";
            $cnum3 = $_GET['oldcnum'];
          } elseif ($_GET['from'] == "soloparent") {
            $title = "Certificate of Solo Parent Control No.: " . $_GET['cnum'];
            $pur = "soloparent";
            $cnum3 = "A";
          } elseif ($_GET['from'] == "indigency") {
            $title = "Certificate of Indigency - Control No.: " . $_GET['cnum'];
            $pur = "indigency";
            $cnum3 = "A";
          } elseif ($_GET['from'] == "lowincome") {
            $title = "Certificate of Indigency - Control No.: " . $_GET['cnum'];
            $pur = "lowincome";
            $cnum3 = "A";
          }

          $cnum2 = $_GET['cnum'];
          $cnum1 = $_GET['cnum'];

          $getqry = "SELECT * from tbl_payments where cnum='" . $_GET['cnum'] . "' ";
          $getres = $conn->query($getqry);
          $resultQuery2 = $getres->fetch_assoc();
        ?> 
        <center>
          <form method="post" enctype="multipart/form-data" action="savepayment_edit.php" style="color:black;background-color:#272E2F;color:whitesmoke;border-radius:10px;width:50%">
            <div class="card-body">
              <h5 class="card-title mb-0"><?php echo $title; ?></h5><br>
              <div class="row mb-3">
                <input type="hidden" name="oldcnum" class="form-control" required autocomplete="off" value="<?php echo $cnum3; ?>" >
                <input type="hidden" name="purpose" class="form-control" required autocomplete="off" value="<?php echo $pur; ?>" >
                <input type="hidden" name="cnum" class="form-control" required autocomplete="off" value="<?php echo $cnum1; ?>" >
                <input type="hidden" name="from" class="form-control" required autocomplete="off" value="<?php echo $_GET['from']; ?>" >
                <input type="hidden" name="redirect_url" value="/admin/index/dashboard-treasurer.php">

                <div class="col-lg-12">
                  <label><small class="text-muted">Mode of Payment</small></label >
                  <select type="text" readonly name="type" class="form-control" required <?php echo $style1; ?>>
                    <option selected value='<?php echo $resultQuery2['payment_type']; ?>' selected><?php echo $resultQuery2['payment_type']; ?></option>
                        <!-- <option value='cash'>Cash - Barangay</option>
                        <option value='gcash'>Gcash</option>
                        <option value='paymaya'>Paymaya</option>-->
                  </select>

                  <label><small class="text-muted">Payment Reference Number / OR Number</small></label >
                  <?php if ($resultQuery2['refnum'] == "") {
                    $e = "N/A";
                  } else {
                    $e = $resultQuery2['refnum'];
                  } ?>
                  <input type="text" readonly name="refnum" onInput="checkUname()" class="form-control" value="<?php echo $e; ?>" autocomplete="off" id="refnum" <?php echo $style1; ?>>
                  <span id="check-refnum" style="font-size: 12px"></span> 

                  <label><small class="text-muted">Date Paid</small></label >
                  <input type="date" readonly name="datepaid" placeholder="0.00" class="form-control" value="<?php echo $resultQuery2['datepaid']; ?>" autocomplete="off" <?php echo $style1; ?>>

                  <label><small class="text-muted">Paid Amount</small></label >
                  <input type="number" step="0.01" name="amount" value="<?php echo $resultQuery2['amount']; ?>" class="form-control" readonly required autocomplete="off" <?php echo $style1; ?>>
                  <br>
                  <button id='subm' onclick="return confirm('Are you sure you want to process this payment ?')" type="submit" 
              style="width: 40%;color:white;border-radius: 10px;height:35px;" class="btn btn-secondary" >Process Payment  <i class="fas fa-check"></i> </button>
                </div>
              </div>
            </div>
          </form>
        </center>
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
