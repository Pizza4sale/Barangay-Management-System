<!DOCTYPE html>
<?php include 'conn.php';
session_start();
if(!isset($_SESSION["user_id_2"]))
header("location:../index.php");
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
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Service Request (Indigency)</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- =========================================================== -->

        <br>
        <div class="row">
          <div class="col-lg-12 col-12">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4><small><b>Indigency Request Confirmation</b><br>
                  <?php date_default_timezone_set("Asia/Manila"); $datt = date('M d, Y h:i:s'); echo "<small style='font-size:20px'>".$datt."</small>"; ?></small></h4>
                <center>
                  <!-- <p style="font-size:40px" class="title"><?php date_default_timezone_set("Asia/Manila"); $datt = date('M d, Y h:i:s'); echo $_GET['idres']; ?> -->
                     <img src="img/<?php echo "newpayment.png"; ?>" alt="" style="width:250px;height:200px" class="img-fluid"> 

                    <br><br>
                    
                    <small style="font-size:15px;color:white;"><b>
                    Note:   All request made through this website will be delivered only from  <em style="font-size:20px;color:red;"> 8 a.m to 5 p.m </em> from the date of request. <br> If the request exceeds from the intended timeframe. The requested document will be delivered the <em style="font-size:20px;color:red"> next day </em> only if that day is an office hour.  </b></small></p>
              </div>
              <div class="icon">
                <i class="fas fa-check"></i>
              </div>
              <a href="addindigency.php" class="small-box-footer">
                 Apply Another <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- /.row -->

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
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
