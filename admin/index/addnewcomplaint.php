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
    <meta name="keywords" content="milawid,official,barangay system" />
    <meta  name="description" content="Barangay Milawid Official System" />
    <title>Barangay System</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/milawid-logo.png" />
    <!-- Custom CSS -->
    <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet" />
    <link href="include/css/tab.css" rel="stylesheet" />

    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
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

              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <?php if($_SESSION["userpos"] =='ADMIN02'){ ?>
                    <li class="breadcrumb-item"><a href="dashboard02.php">Home</a></li>
                    <?php }else{ ?>
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <?php } ?>
                    <li class="breadcrumb-item active" aria-current="page">
                      New Application / Barangay Complaints
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- Container fluid  -->
        <!-- ============================================================== -->
<center>
        <div class="container-fluid" >

        <form action="savecomplaint_b.php" method='post' enctype="multipart/form-data" >
           <br>
                  <div class="card" style="background-color:darkslategray;width:90%;border-radius:12px" >
                   <input type="hidden" name="from" class="form-control" required>
                  <h2  style="padding-left:-10px;font-size:20px;background-color: #0C4AF3;" class="badge rounded-pill"> &nbsp New Application | Barangay Complaint &nbsp </h2><br>

                  <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;">   
                 
                  <div class="col-lg-6">
                    <label><small class="text-muted">Reported By</small></label >
                    <input type="text" class="form-control" name="cname" placeholder="Complainant's Name" autocomplete="off" required>
                  </div>
                 </div>
               <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;">  
               <div class="col-lg-3">
                     <label><small class="text-muted">Phone number</small></label >
                    <input type="text" name="pnum"  class="form-control phone-inputmask"  autocomplete="off"  required>
                  </div> 
                  <div class="col-lg-5">
                     <label><small class="text-muted">Email Address</small></label >
                    <input type="email" name="email" class="form-control" placeholder="Your Email Address" autocomplete="off">
                  </div>
                  <div class="col-lg-4">
                     <label><small class="text-muted" >Upload Evidences <em style="font-size:8px">(PDF,JPEG, Voice Record,Video Record)</em></small></label><br>
                    <input type="file"  class="form-control" placeholder="Address of Incident"  name="fileupload" autocomplete="off" >
                  </div>
                </div><BR>

                  <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;">  
                     <div class="col-lg-3">

                    <label><small class="text-muted">Date of Incident</small></label >
                    <input type="Date" name="datee" class="form-control" placeholder="Barangay" autocomplete="off" required>
                 </div>
                    <div class="col-lg-5">
                    <label><small class="text-muted">Complainee</small></label >
                    <input type="text" name="rname" class="form-control" placeholder="Concerned Person" autocomplete="off" required>
                  </div>
                  <div class="col-lg-4">
                    
                  </div>
                </div>
                  <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;">  
                    <div class="col-lg-12">
                    <label><small class="text-muted">Address of the Incident</small></label >
                    <input type="text"  class="form-control" placeholder="Address of Incident"  name="address" autocomplete="off" required>
                  </div>
                  </div>
                    <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;">  
                    <div class="col-lg-12">
                    <label><small class="text-muted">Full Details of the Incident</small></label >
                   <textarea name="details" class="form-control" rows="6"></textarea>
                  </div>
                </div>
                <br>
                <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;">  
                  <cente>
                 <button onclick="return confirm('Are you sure you want to process this request ?')" name="report" type="submit" style="width:30%;color:white;border-radius: 8px;"  class="btn btn-info"><i class="fas fa-save"></i> Save Report</button>
                 <a href="complain_file.php" style="width:30%;color:white;border-radius: 8px;"  class="btn btn-danger" ><i class="fas fa-arrow-alt-circle-left"></i> Back to Notification</a>
                </div>
          
              </div>
      

          </form>  
    

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- footer -->
        <footer class="footer text-center">
         
        </footer>
        <!-- End footer -->
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
    <!-- This Page JS -->
    <script src="../assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="../dist/js/pages/mask/mask.init.js"></script>
    <script src="../assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="../assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="../assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
    <script src="../assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="../assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
    <script src="../assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
    <script src="../assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="../assets/libs/quill/dist/quill.min.js"></script>
  </body>
</html>
