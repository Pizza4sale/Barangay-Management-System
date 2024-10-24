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
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full" >

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
              <h4 class="page-title">Website Notification</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <?php if($_SESSION["userpos"] =='ADMIN02'){ ?>
                    <li class="breadcrumb-item"><a href="dashboard02.php">Home</a></li>
                    <?php }else{ ?>
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <?php } ?>
                    <li class="breadcrumb-item active" aria-current="page">
                      Barangay Clearance Edit
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- Container fluid  -->
        <!-- ============================================================== -->

        <div class="container-fluid" >
   <?php 
   $style1 = "style='padding-left : 30px;padding-right : 30px;'";


        $sqlrt01 = "SELECT * FROM `tbl_brgyclearance` where ctrl_num='".$_GET['cnum']."' ";
        $processQueryrt01 = $conn->query($sqlrt01);
        while ($resultQueryrt01 = $processQueryrt01->fetch_assoc())
        { ?> 
          <center>
        <form method="post" action='resave-clearance.php' >
         <div class="card" style="background-color:#25304E;width:90%;border-radius:12px" >
           <h2  style="padding-left:-10px;font-size:20px;background-color: #0C4AF3;" class="badge rounded-pill"> &nbsp Barangay Clearance - Control No.: <b><?php echo $_GET['cnum']; ?></b> &nbsp </h2>
                <div class="card-body">
                  <input type="hidden" name="from" class="form-control" value="<?php echo $_GET['from']; ?>" required>

                   <div class="row mb-3" <?php echo $style1; ?>>
                    <div class="col-lg-4">
                    <label><small class="text-muted">First Name</small></label >
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
                <div class="row mb-3"<?php echo $style1; ?> >
                  <div class="col-lg-4">
                     <label><small class="text-muted">Birthday</small></label >
                    <input type="date" name="bdate" class="form-control"  value="<?php echo $resultQueryrt01['bday']; ?>" required <?php echo $style1; ?>>
                  </div>
                  <div class="col-lg-4">
                     <label><small class="text-muted">Age (yrs)</small></label >
                    <input type="number" name="age" class="form-control" placeholder="0" autocomplete="off" value="<?php echo $resultQueryrt01['age']; ?>" required <?php echo $style1; ?>>
                  </div>
                  <div class="col-lg-4">
                     <label><small class="text-muted">Gender</small></label ><Br>
                      <?php if( $resultQueryrt01['gender'] == "Female" ){ ?>
                        <input type="radio" style="font-size: 15px;" value="Female" name="gender"checked> <b>Female</b> &nbsp &nbsp &nbsp
                        <input type="radio" style="font-size: 15px" value="Male" name="gender"> <b >Male</b>
                      <?php }else{ ?>
                         <input type="radio" style="font-size: 15px;" value="Female" name="gender"> <b >Female</b> &nbsp &nbsp &nbsp
                         <input type="radio" style="font-size: 15px;" value="Male" name="gender" checked> <b>Male</b>
                      <?php } ?>
                  </div>
                </div>
                <div class="row mb-3" <?php echo $style1; ?>>
                  <div class="col-lg-4">
                     <label><small class="text-muted">Civil Status</small></label >
                     <select type="text" name="civil" class="form-control" required <?php echo $style1; ?>>
                        <option><?php echo $resultQueryrt01['civil']; ?></option>
                        <option value="Single">- Single</option>
                        <option value="Married">- Married</option>
                        <option value="Widowed">- Widowed</option>
                      </select>
                  </div>
                  <div class="col-lg-4">
                    <label><small class="text-muted">Are you a registered Voter?</small></label >
                    <select type="text" name="voter" class="form-control" required <?php echo $style1; ?>>
                       <?php if( $resultQueryrt01['voter'] == "yes" ){ ?>
                        <option value="yes" selected>Yes, I am a registered voter</option>
                        <option value="no">No, I am not registered</option>
                       <?php }else{ ?>
                         <option value="yes" >Yes, I am a registered voter</option>
                         <option value="no"selected>No, I am not registered</option>
                       <?php } ?>
                      </select>
                  </div>
                  <div class="col-lg-4">
                    <label><small class="text-muted">Uploaded File Requirements</small></label ><br>
                    <?php if($resultQueryrt01['fileupload']==""){ $file = "No uploaded file.";} else{ $file = $resultQueryrt01['fileupload']; } ?> 
                   <a href="../../user/pages/file/<?php echo $file; ?>" target="_blank"><?php echo $file; ?></a>
                  </div>
                 </div>
                 <div class="row mb-3" <?php echo $style1; ?>>
                    <div class="col-lg-8">
                    <label><small class="text-muted">Full Address of the Requestor</small></label >
                    <input type="text" name="address" class="form-control" value="<?php echo $resultQueryrt01['address']; ?>" <?php echo $style1; ?>>
                    <input type="hidden" name="cnumm" class="form-control" value="<?php echo $_GET['cnum']; ?>" required>
                  </div>
                   <div class="col-lg-4">
                    <label><small class="text-muted">Length of Stay (yrs)</small></label >
                   <input type="number" name="length" class="form-control" autocomplete="off" value="<?php echo $resultQueryrt01['length']; ?>" <?php echo $style1; ?>>
                  </div>
                  </div>
                 <!------------------------------------  -->
                <div class="row mb-3" <?php echo $style1; ?>>
                    <div class="col-lg-8">
                    <label><small class="text-muted">Employment Background - Employer Name</small></label >
                    <input type="text" name="company" class="form-control" autocomplete="off" value="<?php echo $resultQueryrt01['company']; ?>" <?php echo $style1; ?>>
                  </div>

                  <div class="col-lg-4">
                    <label><small class="text-muted">Purpose of Request</small></label >
                     <textarea name="purpose" class="form-control" placeholder="..." rows="2" <?php echo $style1; ?>><?php echo $resultQueryrt01['purpose']; ?></textarea>
                  </div>
                </div>
             <!------------------------------------  -->


                <div class="row mb-3" style="padding-left:  20px;">
                  <Center><br>
                <?php if($_GET['fromwhere'] =="homefilec"){ ?>
                 &nbsp  &nbsp <button name="edit" onclick="return confirm('Are you sure you want to process this request ?')"type="submit" style="width: 25%;color:white;"  class="btn btn-primary"><i class="fas fa-save"></i> Re-Process/Save</button> &nbsp 
               <?php } ?>
                  <a href="clearance_file.php" style="width: 25%;color:white;"  class="btn btn-primary"> <i class="fas fa-arrow-alt-circle-left"></i> Back to Home</a>

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
