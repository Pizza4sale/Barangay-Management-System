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
                      Barangay Business Permit
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- Container fluid  -->
        <!-- ============================================================== -->
<center><br>
        <div class="container-fluid" >
   <?php 
   $style1 = "style=''";
        $sqlrt01 = "SELECT * FROM `tbl_permit` where permit_num='".$_GET['cnum']."' ";
        $processQueryrt01 = $conn->query($sqlrt01);
        while ($resultQueryrt01 = $processQueryrt01->fetch_assoc())
        {  

         ?> 
        <form method="post" action='resavepermit.php' >
    
         <div class="card" style="background-color:#25304E;width:90%;border-radius:12px" >
           <h2  style="padding-left:-10px;font-size:20px;background-color: #0C4AF3;" class="badge rounded-pill"> &nbsp Barangay Business Permit - Control No.: <?php echo $_GET['cnum']; ?> &nbsp </h2>
                <div class="card-body">
                  <h5 class="card-title mb-0"></h5><br>
                 <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;">   
                    <div class="col-lg-4">
                    <label><small class="text-muted">First Name</small></label >
                    <input type="hidden" name="purpo" class="form-control" value="<?php echo $_GET['from']; ?>" >
                    <input type="text" name="fname" class="form-control" value="<?php echo $resultQueryrt01['fname']; ?>" autocomplete="off" <?php echo $style1; ?> >
                   </div>
                   <div class="col-lg-4">
                     <label><small class="text-muted">Middle Name</small></label >
                    <input type="text" name="mname" class="form-control"  value="<?php echo $resultQueryrt01['mname']; ?>" required autocomplete="off" <?php echo $style1; ?>>
                  </div>
                  <div class="col-lg-4">
                     <label><small class="text-muted">Last Name</small></label >
                    <input type="text" class="form-control" name="lname"  value="<?php echo $resultQueryrt01['lname']; ?>" autocomplete="off" <?php echo $style1; ?>>
                  </div>
                </div>
              <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;">   
                  <div class="col-lg-4">
                     <label><small class="text-muted">Tax Identification Number</small></label >
                    <input type="text" name="tin" class="form-control" class="form-control tin-inputmask" id="tin-inputmask" value="<?php echo $resultQueryrt01['tin_no']; ?>" required <?php echo $style1; ?>>
                  </div>
                  <div class="col-lg-4">
                     <label><small class="text-muted">Phone number</small></label >
                    <input type="text" name="phone" class="form-control" placeholder="0" autocomplete="off" value="<?php echo $resultQueryrt01['phone_num']; ?>" required <?php echo $style1; ?>>
                  </div>
                  <div class="col-lg-4">
                     <label><small class="text-muted">Telephone number</small></label >
                    <input type="text" name="tel" class="form-control" placeholder="0" autocomplete="off" value="<?php echo $resultQueryrt01['tel_num']; ?>" <?php echo $style1; ?>>
                  </div>
                </div>
                  <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;">   
                  <div class="col-lg-8">
                    <label><small class="text-muted">Business Trade Name (per DTI Reg.)</small></label >
                    <input type="text" name="busname" class="form-control" value="<?php echo $resultQueryrt01['corponame']; ?>" <?php echo $style1; ?>>
                    <input type="hidden" name="cnumm" class="form-control" value="<?php echo $_GET['cnum']; ?>" required>
                  </div>
                  <div class="col-lg-4">
                    <label><small class="text-muted">Business TIN</small></label >
                   <input type="text" name="bustin" class="form-control" value="<?php echo $resultQueryrt01['bus_tin']; ?>" <?php echo $style1; ?>>
                  </div>
                 </div>
                  <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;">   
                    <div class="col-lg-8">
                    <label><small class="text-muted">Name of Corporation (per SEC. Reg)</small></label >
                    <input type="text" name="corponame" class="form-control" value="<?php echo $resultQueryrt01['business_name']; ?>" <?php echo $style1; ?>>
                  </div>
                   <div class="col-lg-4">
                    <label><small class="text-muted">Type of Ownership</small></label >
                    <select type="text" name="owner" class="form-control" required <?php echo $style1; ?>>
                       <?php if( $resultQueryrt01['ownership'] == "Single" ){ $r= "Single Proprietor"; }
                             elseif( $resultQueryrt01['ownership'] == "cooperative" ) { $r= "Cooperative"; }
                              elseif( $resultQueryrt01['ownership'] == "partner" ) { $r= "Partnership"; }else{
                                 $r= $resultQueryrt01['ownership'];
                              }
                        ?>
                        <option value="<?php echo $r; ?>" selected><?php echo $r; ?></option>
                        <option value="Single"> - Single Proprietor</option>
                        <option value="cooperative"> - Cooperative</option>
                        <option value="partner"> - Partnership</option>
                        <option value="others"> - Others</option>
                      </select>
                      <input type="text" name="address" class="form-control" placeholder="Only if Others" <?php echo $style1; ?>>
                  </div>
                  </div>
                   <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;">   
                    <div class="col-lg-8">
                    <label><small class="text-muted">Full Address of the Business</small></label >
                    <input type="text" name="busadd" class="form-control" value="<?php echo $resultQueryrt01['bus_address']; ?>" <?php echo $style1; ?>>
                    <br> <br>
                  <center>
     
                  <br>
                  <a href="permit_file.php" style="width:30%;color:white;" class="btn btn-danger"> <i class="fas fa-arrow-alt-circle-left"></i> Back to Home</a>
                  </div>
                   <div class="col-lg-4">
                    <label><small class="text-muted">Capital Breakdown</small></label >
                     <textarea name="capital" class="form-control" placeholder="..." rows="6" <?php echo $style1; ?>><?php echo $resultQueryrt01['capital_breakdown']; ?></textarea>
                  </div>
                </div>
              </div>
       </form>
     <?php } ?>





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
