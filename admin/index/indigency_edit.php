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
                      Certificate of Indigency
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
   <?php 
   $style1 = "style=''";
        $sqlrt01 = "SELECT * FROM `tbl_indigency` where reqnum ='".$_GET['cnum']."' ";
        $processQueryrt01 = $conn->query($sqlrt01);
        while ($resultQueryrt01 = $processQueryrt01->fetch_assoc())
        {  

         ?> 
        <form method="post" action="saveindigency.php"  enctype="multipart/form-data" >
        <br>
         <div class="card" >
          <h2  style="padding-left:-10px;font-size:20px;background-color: grey;" class="badge rounded-pill"> &nbsp Certificate of Indigency - Control No.: <?php echo $_GET['cnum']; ?> &nbsp </h2>
<center>

            <div class="card-body" style="background-color:#25304E;width:90%;border-radius:12px" >
              <div class="row mb-3 mt-1" style="padding-left : 30px;padding-right : 30px;padding-top: 1px;">
                    <div class="col-lg-4">
                    <label><small class="text-muted">FIRST NAME</small></label >
                    <input type="text" name="fname" class="form-control" value="<?php echo $resultQueryrt01['fname']; ?>" autocomplete="off" <?php echo $style1; ?> >
                   </div>
                   <div class="col-lg-4">
                     <label><small class="text-muted">MIDDLE NAME</small></label >
                    <input type="text" name="mname" class="form-control"  value="<?php echo $resultQueryrt01['mname']; ?>" autocomplete="off" <?php echo $style1; ?>>
                  </div>
                  <div class="col-lg-4">
                     <label><small class="text-muted">LAST NAME</small></label >
                    <input type="text" class="form-control" name="lname"  value="<?php echo $resultQueryrt01['lname']; ?>" autocomplete="off" <?php echo $style1; ?>>
                  </div>
                
                </div>
                 <div class="row mb-3 mt-1" style="padding-left : 30px;padding-right : 30px;padding-top: 1px;">
                   <div class="col-lg-4">
                 <label><small class="text-muted">CONTACT NUMBER</small></label >
                  <input type="text" class="form-control" name="number"  value="<?php echo $resultQueryrt01['phonenumber']; ?>" autocomplete="off" <?php echo $style1; ?>>
                </div>
                  <div class="col-lg-4">
                 <label><small class="text-muted">CIVIL STATUS</small></label >
                  <select type="text" name="civil" class="form-control" required <?php echo $style1; ?>>
                    <option><?php echo $resultQueryrt01['marital']; ?> </option>
                     <option value="Single">- Single</option>
                     <option value="Married">- Married</option>
                      <option value="Widowed">- Widowed</option>
                  </select>
                </div>
                <div class="col-lg-4">
                 <label><small class="text-muted">BIRTHDAY</small></label >
                  <input type="date" class="form-control" name="bday"  value="<?php echo $resultQueryrt01['bday']; ?>" autocomplete="off" <?php echo $style1; ?>>
                </div>
                </div>
                <div class="row mb-3 mt-1" style="padding-left : 30px;padding-right : 30px;padding-top: 1px;">
                  <div class="col-lg-8">
                    <label><small class="text-muted" STYLE='text-align: left;'>ADDRESS</small></label >
                    <input type="text" name="address" class="form-control" value="<?php echo $resultQueryrt01['address']; ?>" <?php echo $style1; ?>>
                    <input type="hidden" name="cnumm" class="form-control" value="<?php echo $_GET['cnum']; ?>" required>
                  </div>
                  <div class="col-lg-2">
                    <label><small class="text-muted" STYLE='text-align: left;'>Uploaded Requirements</small></label >
                    <?php if($resultQueryrt01['uploadreq']==""){ $file = "No uploaded file.";} else{ $file = $resultQueryrt01['uploadreq']; } ?> 
                   <a class='badge btn-warning' href="../../user/pages/file/<?php echo $file; ?>" target="_blank"><?php echo substr($file,0,50); ?></a>
                  </div>
                 </div>
                 
                  <br>
                 <div class="row mb-3 mt-1" style="padding-left : 30px;padding-right : 30px;padding-top: 1px;">
                  <center>
               <?php if($resultQueryrt01['pay_status']=="NEW"){ ?>
                <button onclick="return confirm('Are you sure you want to process this request ?')" type="submit" style="width: 20%;color:white;border-radius: 5px;" class="btn btn-primary" ><i class="fas fa-save"></i>  Process / Save</button>
                  <a href="payment_ref_edit.php?cnum=<?php echo $_GET['cnum']; ?>&oldcnum=A&from=indigency" style="width: 20%;color:white;border-radius: 5px;" class="btn btn-danger" > <i class="fas fa-arrow-alt-circle-left"></i> Back to Home</a>
                <?php }else{?>
                    <br>
                  <a href="soloparentfile.php" style="width: 40%;color:white;border-radius: 5px;" class="btn btn-danger" > <i class="fas fa-arrow-alt-circle-left"></i> Back to Home</a>
                  <?Php } ?> &nbsp
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
