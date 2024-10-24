<!DOCTYPE html>
<?php include 'conn.php';
session_start();
if(!isset($_SESSION["user_id_2"]))
header("location:../index.php");
           $uname= $_SESSION["uname01_2"];
           $empname= $_SESSION["empname_2"];
           $userid= $_SESSION["user_id_2"];
           $position= $_SESSION["userpos_2"];
 ?>
  
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Milawid Services</title>
 <link rel="icon" type="image/png" sizes="16x16" href="../images/milawid_logo.png" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
<?php include'../include/navbar.php'; ?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../images/milawid_logo.png"  alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: ">
      <span class="brand-text font-weight-light">Milawid Service</span>
    </a>

  <?php include'../include/sidebar.php'; ?>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Barangay Online Services</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- =========================================================== -->

        <!-- Small Box (Stat card) -->

        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4>Barangay Residency</h4>
                <p><br>
                  <b>Requirements:</b> <br>
                  1. Barangay ID / Voter's ID <br>
                  2. Payment of ₱35.00 <br><br>
                <!--  <b>Payment Option:</b> <br>
                 Gcash - 09123456789<br>
                 Paymaya - 09123456789 -->
                 </p>
              </div>
              <div class="icon">
               <i class="fas fa-user"></i>
              </div>
              <a href="addresidence.php" class="small-box-footer">
                Apply Now <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h4>Certificate of Indigency</h4>

                <p><br>
                  <b>Requirements:</b> <br>
                  1. Barangay ID / Voter's ID <br>
                  2. Payment of ₱35.00 <br><br>
                 <!-- <b>Payment Option:</b> <br>
                 Gcash - 09123456789<br>
                 Paymaya - 09123456789 -->
                 </p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="addindigency.php" class="small-box-footer">
                Apply Now <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h4>Complaint</h4>
                <br>
                <p>File your complaint via online and let our barangay staff take action and review your file.</p><br><br>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="addcomplaint.php" class="small-box-footer">
                 Apply Now <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>

          <!--  <a data-amount="100" data-fee="0" data-expiry="6" data-description="Payment for services rendered" data-href="https://getpaid.gcash.com/paynow" data-public-key="pk_bc7bc265864b44511f7a06b7a08210b3" onclick="this.href = this.getAttribute('data-href')+'?public_key='+this.getAttribute('data-public-key')+'&amp;amount='+this.getAttribute('data-amount')+'&amp;fee='+this.getAttribute('data-fee')+'&amp;expiry='+this.getAttribute('data-expiry')+'&amp;description='+this.getAttribute('data-description');" href="https://getpaid.gcash.com/paynow?public_key=pk_bc7bc265864b44511f7a06b7a08210b3&amp;amount=100&amp;fee=0&amp;expiry=6&amp;description=Payment for services rendered" target="_blank" class="x-getpaid-button"><img src="https://getpaid.gcash.com/assets/img/paynow.png"></a> -->

          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="dropdown-divider mb-4" style="border-width: 2px; border-color: #9e9e9e;"></div>
        <h2 style="font-size: 1.8rem;">Barangay Services (Walk-in)</h2>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h4>Barangay Clearance</h4>

                <p><br>
                  <b>Please! Bring the following:</b> <br>
                 1. Barangay ID / Voter's ID <br>
                 2. Cedula <br>
                 3. Payment of ₱35.00 <br><br>
               <!--   <b>Payment Option:</b> <br>
                 Gcash - 09123456789<br>
                 Paymaya - 09123456789 -->
                 </p>
              </div>
              <div class="icon">
               <i class="fas fa-user"></i>
              </div>
              <a href="addclearance.php" class="small-box-footer">
                 Apply Now <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h4>Business Permit</h4>

                <p><br>
                  <b>Please! Bring the following:</b> <br>
                  1. Barangay ID / Voter's ID <br>
                  2. Cedula <br>
                  3. Payment of ₱35.00 <br><br>
                <!-- <b>Payment Option:</b> <br>
                 Gcash - 09123456789<br>
                 Paymaya - 09123456789 -->
                 </p>
              </div>
              <div class="icon">
               <i class="fas fa-user"></i>
              </div>
              <a href="addpermit.php"  class="small-box-footer">
                 Apply Now <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h4>Certificate of Solo Parent</h4>

                <p><br>
                  <b>Please! Bring the following:</b> <br>
                  1. Barangay ID / Voter's ID<br>
                  2. Cedula <br>
                  3. Payment of ₱35.00 <br><br>
                <!-- <b>Payment Option:</b> <br>
                 Gcash - 09123456789<br>
                 Paymaya - 09123456789 -->
                 </p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="addsolo.php" class="small-box-footer">
                Apply Now <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h4>Certificate of Low Income</h4>

                <p><br>
                  <b>Please! Bring the following:</b> <br>
                  1. Barangay ID / Voter's ID <br>
                  2. Cedula <br>
                  3. Payment of ₱35.00 <br><br>
               <!--  <b>Payment Option:</b> <br>
                 Gcash - 09123456789<br>
                 Paymaya - 09123456789 -->
                 </p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="addlowincome.php" class="small-box-footer">
                Apply Now <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Barangay Milawid Services @2022 - Capstone Project</strong>
  </footer>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

</body>
</html>
