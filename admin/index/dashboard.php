<?php 
include 'include/conn.php';
session_start();
if(!isset($_SESSION["userpos"]))
header("location:../../user/pages/index.php");

$page = 'dashboard.php';
$sec = "15";

?>
 

<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
     <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
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
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin5"
      data-sidebartype="full"
      data-sidebar-position="absolute"
      data-header-position="absolute"
      data-boxed-layout="full"
    >

      <!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
          <?php include'include/navbar.php'; ?>
        </nav>
      </header>
      <!-- End Topbar header -->
      <!-- Left Sidebar - style you can find in sidebar.scss  -->
      <?php include 'include/sidebar.php'; ?>
      <!-- End Of Sidebar  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Employee Dashboard</h4>
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
          <!-- ============================================================== -->
          <!-- Sales Cards  -->
          <!-- ============================================================== -->
          <div class="row">
          
            <!-- Column
            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-success text-center">
                  <h1 class="font-light text-white">
                    <i class="fa fa-user-plus" aria-hidden="true" ></i> <small>
                    <?php
                       $sqlz = "SELECT count(distinct res_email) as voterr FROM tbl_residency WHERE voter ='Registered Voter' ";
                      $processQueryz= $conn->query($sqlz);
                      while ($resultQuerz = $processQueryz->fetch_assoc())
                      {echo  $nummz = "(".$resultQuerz['voterr'].")"; } ?>
                </small>
                  </h1>
                  <h6 class="text-white">REGISTERED VOTER</h6>
                </div>
              </div>
            </div>

            Column 
            <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-danger text-center">
                  <h1 class="font-light text-white">
                    <i class="fa fa-user-times" aria-hidden="true"></i> <small>
                  <?php
                       $sqlz = "SELECT count(distinct res_email) as voterr FROM tbl_residency WHERE voter ='not registered voter'  ";
                      $processQueryz= $conn->query($sqlz);
                      while ($resultQuerz = $processQueryz->fetch_assoc())
                      {echo  $nummz = "(".$resultQuerz['voterr'].")"; } ?></small>
                  </h1>
                  <h6 class="text-white">NON REGISTERED VOTER</h6>
                </div>
              </div>
            </div>
          -->

            <!-- Column -->
            <!-- <div class="col-md-6 col-lg-2 col-xlg-3">
             <a href="clearance_file.php"> <div class="card card-hover">
                <div class="box bg-primary text-center">
                  <h1 class="font-light text-white">
                    <i  class="fa fa-university" aria-hidden="true"></i>
                  </h1>
                  <h6 class="text-white">Barangay Clearance</h6>
                   <a style='font-size:15px;margin-top: 20px' class='badge btn-danger' ><b>
                   <?php
                       $sqlx = "SELECT count(ctrl_num) as num FROM tbl_brgyclearance WHERE status='OLD' and captain='okay' and datereleased='' ";
                      $processQueryx = $conn->query($sqlx);
                      while ($resultQuerx = $processQueryx->fetch_assoc())
                      { echo  $nummx = "For Releasing : (".$resultQuerx['num'].")"; } ?>
                  </b>
                  </a>
                </div>
              </div>
            </a>
            </div> -->
             <!-- Column -->
            <!-- <div class="col-md-6 col-lg-2 col-xlg-3">
              <a href="permit_file.php"><div class="card card-hover">
                <div class="box bg-cyan text-center">
                  <h1 class="font-light text-white">
                    <i class="fa fa-suitcase" aria-hidden="true"></i>
                  </h1>
                  <h6 class="text-white">Barangay Business Permit</h6>
                  <a style='font-size:15px;' class='badge btn-danger' ><b>
                   <?php
                       $sqlx = "SELECT count(permit_num) as num FROM tbl_permit WHERE captain='okay' and datereleased='' and status='OLD' ";
                      $processQueryx = $conn->query($sqlx);
                      while ($resultQuerx = $processQueryx->fetch_assoc())
                      { echo  $nummx = "For Releasing : (".$resultQuerx['num'].")"; } ?>
                  </b>
                  </a>
                </div>
              </div>
            </a>
            </div> -->
            <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
             <a href="residency_file.php"> <div class="card card-hover">
                <div class="box bg-success text-center">
                  <h1 class="font-light text-white">
                    <i class="fa fa-id-card" aria-hidden="true" ></i>
                  </h1>
                  <h6 class="text-white">Barangay Residency</h6>
                   <a style='font-size:15px;margin-top: 20px' class='badge btn-danger' ><b>
                   <?php
                      $sqlx = "SELECT count(reqnum) as num FROM tbl_residency WHERE captain='okay' and datereleased='' and status='OLD' ";
                      $processQueryx = $conn->query($sqlx);
                      while ($resultQuerx = $processQueryx->fetch_assoc())
                      { echo  $nummx = "For Releasing : (".$resultQuerx['num'].")"; } ?>
                  </b>
                  </a>
                </div>
              </div>
            </a>
            </div>
                       <!-- Column -->
            <div class="col-md-6 col-lg-2 col-xlg-3">
              <a href="indigencyfile.php"> <div class="card card-hover">
                <div class="box bg-secondary text-center">
                  <h1 class="font-light text-white">
                    <i class="fa fa-bookmark"  aria-hidden="true" ></i>
                  </h1>
                  <h6 class="text-white">Certificate of Indigency</h6>
                  <a style='font-size:15px;margin-top: 20px' class='badge btn-danger' ><b>
                    <?php
                      $sqlx = "SELECT count(reqnum) as num FROM tbl_indigency WHERE captain='okay' and datereleased='' and status='OLD' ";
                      $processQueryx = $conn->query($sqlx);
                      while ($resultQuerx = $processQueryx->fetch_assoc())
                      { echo  $nummx = "For Releasing : (".$resultQuerx['num'].")"; } 
                    ?>
                  </b>
                  </a>
                </div>
              </div>
            </a>
            </div>
            <!-- Column -->
            <!-- <div class="col-md-6 col-lg-2 col-xlg-3">
              <a href="lowincomefile.php"> <div class="card card-hover">
                <div class="box bg-secondary text-center">
                  <h1 class="font-light text-white">
                     <i class="fa fa-bookmark"  aria-hidden="true" ></i>
                  </h1>
                  <h6 class="text-white">Certificate of Low Income</h6>
                  <a style='font-size:15px;' class='badge btn-danger' ><b>
                   <?php
                      $sqlx = "SELECT count(reqnum) as num FROM tbl_lowincome WHERE captain='okay' and datereleased='' and status='OLD'";
                      $processQueryx = $conn->query($sqlx);
                      while ($resultQuerx = $processQueryx->fetch_assoc())
                      { echo  $nummx = "For Releasing : (".$resultQuerx['num'].")"; } ?>
                  </b>
                  </a>
                </div>
              </div>
            </a>
            </div> -->
            <!-- Column -->
            <!-- <div class="col-md-6 col-lg-2 col-xlg-3">
              <a href="soloparentfile.php"> <div class="card card-hover">
                <div class="box bg-secondary text-center">
                  <h1 class="font-light text-white">
                    <i class="fa fa-bookmark"  aria-hidden="true" ></i>
                  </h1>
                  <h6 class="text-white">Certificate of Solo Parent</h6>
                  <a style='font-size:15px;' class='badge btn-danger' ><b>
                   <?php
                      $sqlx = "SELECT count(reqnum) as num FROM tbl_soloparent WHERE captain='okay' and datereleased='' and status='OLD' ";
                      $processQueryx = $conn->query($sqlx);
                      while ($resultQuerx = $processQueryx->fetch_assoc())
                      { echo  $nummx = "For Releasing : (".$resultQuerx['num'].")"; } ?>
                  </b>
                  </a>
                </div>
              </div>
            </a>
            </div> -->
            <!-- Column -->
            <hr>
             <?php 

              $sqlz1 = "SELECT count(*) as alll FROM tbl_resident ";
              $processQueryz1= $conn->query($sqlz1);
              while ($resultQuerz1 = $processQueryz1->fetch_assoc())
                { $Regpopulation = $resultQuerz1['alll']; } 


              $sqlz2 = "SELECT count(*) as voterr FROM tbl_resident where voter ='Registered Voter'";
              $processQueryz2= $conn->query($sqlz2);
              while ($resultQuerz2 = $processQueryz2->fetch_assoc())
                { $reg = $resultQuerz2['voterr']; } 

              $sqlz3 = "SELECT count(*) as nonvoterr FROM tbl_resident where voter ='Not Registered Voter'";
              $processQueryz3= $conn->query($sqlz3);
              while ($resultQuerz3 = $processQueryz3->fetch_assoc())
                { $nonreg = $resultQuerz3['nonvoterr']; } 

              ?>
                <!-- Column -->
            <div class="col-md-3 col-lg-2 col-xlg-3">
               <div class="card card-hover">
                <div class="box bg-danger text-center">
                  <h1 class="font-light text-white">
                    <i class="fa fa-user" aria-hidden="true" ></i>
                  </h1>
                  <h6 class="text-white">Voters</h6>
                  <a style='font-size:15px;margin-top: 5px' class='badge btn-success' ><b>
                   Voters: <?php echo $reg; ?><br>
                   Non-Voters: <?php echo $nonreg; ?>
                  </b>
                  </a>
                </div>
              </div>
            </div>

               <!-- Column -->
            <div class="col-md-3 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                <div class="box bg-danger text-center">
                  <h1 class="font-light text-white">
                    <i class="fa fa-users" aria-hidden="true" ></i>
                  </h1>
                  <h6 class="text-white">Population</h6>
                  <a style='font-size:15px;margin-top: 23px' class='badge btn-success' ><b>
                   Registered: <?php echo $Regpopulation; ?>
                  </b>
                </a>
                </div>
              </div>
            </div>

  <!-- Column -->
            <div class="col-md-3 col-lg-2 col-xlg-3">
              <a href="complain_file.php"> <div class="card card-hover">
                <div class="box bg-info text-center">
                  <h1 class="font-light fa-4x text-white">
                    <i class="fa fa-life-ring" aria-hidden="true"></i>
                  </h1>
                  <h6 class="text-white">Barangay Complaints</h6>
                  <a style='font-size:15px; margin-top:45px'></a>
                </div>
              </div>
            </a>
            </div>

             <!-- Column -->
           <!-- Column -->      
            <div class="col-md-6 col-lg-6 col-xlg-3">
              <a href="notif.php">
              <div class="card card-hover">
                <div class="box bg-warning text-center"><br>
                  <h6 style='font-size:25px;' class="text-white"> <b> WEBSITE SERVICE NOTIFICATION </b></h6>
                    <a style='font-size:25px;margin-top: 23px' class='badge btn-danger' ><i class="fa fa-exclamation-triangle" aria-hidden="true" ></i><b>
                      <?php
                       $sqlx = "SELECT count(cnum) as num FROM tbl_request WHERE status='Active' ";
                      $processQueryx = $conn->query($sqlx);
                      while ($resultQuerx = $processQueryx->fetch_assoc())
                      {echo  $nummx = "(".$resultQuerx['num'].")"; } ?>
                    </b><i class="fa fa-exclamation-triangle" aria-hidden="true" ></i></a>
                </div>
              </div>
              </a>
            </div>
           <!-- Column -->
          </div>
          <!-- ============================================================== -->
         
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
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
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
