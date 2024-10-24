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
                      Payment Process
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

      $style1 = "style='box-shadow: 1px 2px;color:grey'"; 
      if($_GET['from'] == "clearance"){
        $title ="Barangay Clearance - Control No.: ".$_GET['cnum']; 
        $cnum2 = $_GET['cnum'];
        $cnum1 = $_GET['cnum'];
        
        $pur = "Clearance";
        $cnum3 = "A"; 

      }elseif($_GET['from'] == "rclearance"){
        $title ="Barangay Clearance - Control No.: ".$_GET['cnum']; 
        $cnum2 = $_GET['cnum'];
        $cnum1 = $_GET['cnum'];
        $cnum3 = $_GET['oldcnum'];
        $pur = "Clearance";
      }elseif($_GET['from'] == "re_permit"){
      $title ="Business Permit - Control No.: ".$_GET['cnum']; 
      $pur = "Permit";
      $cnum2 = $_GET['cnum'];
      $cnum1 = $_GET['cnum'];
      $cnum3 = $_GET['oldcnum'];
      }elseif($_GET['from'] == "permit"){
      $title ="Business Permit - Control No.: ".$_GET['cnum']; 
      $pur = "Permit";
      $cnum2 = $_GET['cnum'];
      $cnum1 = $_GET['cnum'];
      $cnum3 = $_GET['oldcnum'];
      }elseif($_GET['from'] == "residency"){
      $title ="Barangay Residence - Control No.: ".$_GET['cnum']; 
      $pur = "Residence";
      $cnum2 = $_GET['cnum'];
      $cnum1 = $_GET['cnum'];
      $cnum3 = $_GET['oldcnum'];
      }elseif($_GET['from'] == "residencyb"){
      $title ="Barangay Residence - Control No.: ".$_GET['cnum']; 
      $pur = "Residence";
      $cnum2 = $_GET['cnum'];
      $cnum1 = $_GET['cnum'];
      $cnum3 = $_GET['oldcnum'];
      }
      elseif($_GET['from'] == "reclearance"){
       $title ="Barangay Clearance - RENEWAL Control No.: ".$_GET['cnum']; 
        $pur = "Clearance";
      $cnum2 = $_GET['cnum'];
      $cnum1 = $_GET['cnum'];
      $cnum3 = $_GET['oldcnum'];
      }
      elseif($_GET['from'] == "soloparent"){
       $title ="Certificate of Solo Parent - Control No.: ".$_GET['cnum']; 
        $pur = "soloparent";
        $cnum2 = $_GET['cnum'];
        $cnum1 = $_GET['cnum'];
        $cnum3 = "A";
      }
      elseif($_GET['from'] == "indigency"){
       $title ="Certificate of Indigency - Control No.: ".$_GET['cnum']; 
        $pur = "indigency";
        $cnum2 = $_GET['cnum'];
        $cnum1 = $_GET['cnum'];
        $cnum3 = "A";
      }

      elseif($_GET['from'] == "lowincome"){
       $title ="Certificate of Low Income - Control No.: ".$_GET['cnum']; 
        $pur = "lowincome";
        $cnum2 = $_GET['cnum'];
        $cnum1 = $_GET['cnum'];
        $cnum3 = "A";
      }

   ?> 
          <Center>
        <form method="post" action="savepayment.php" enctype="multipart/form-data" style="background-color:#272E2F;color:whitesmoke;border-radius:10px;width:70%">
        
                <div class="card-body">
                  <h5 class="card-title mb-0"><?php echo  $title; ?></h5><br>
                   <div class="row mb-3" style="">
                    <div class="col-lg-6">
                    <label><small class="text-muted">Mode of Payment</small></label >
                      <select type="text" name="type" class="form-control" required <?php echo $style1; ?>>
                        <option value='cash' selected>Cash - Barangay</option>
                      <!--  <option value='gcash'>Gcash</option>
                        <option value='paymaya'>Paymaya</option> -->
                      </select>
                   </div>
                   <div class="col-lg-6">
                     <label><small class="text-muted">Payment Reference Number / OR Number</small></label >
                    <input type="text" name="refnum" id="refnum" onInput="checkUname()" class="form-control" value="N/A" required autocomplete="off" <?php echo $style1; ?>>
                    <span id="check-refnum" style="font-size: 12px"></span> 
                    
                    <input type="hidden" name="idniya" class="form-control" required autocomplete="off" value="<?php echo $_GET['idniya']; ?>" >

                     <input type="hidden" name="oldcnum" class="form-control" required autocomplete="off" value="<?php echo $cnum3; ?>" >
                     <input type="hidden" name="purpose" class="form-control" required autocomplete="off" value="<?php echo $pur; ?>" >
                     <input type="hidden" name="cnum" class="form-control" required autocomplete="off" value="<?php echo $cnum1; ?>" >
                     <input type="hidden" name="from" class="form-control" required autocomplete="off" value="<?php echo $_GET['from']; ?>" >
                  </div>
                </div>
                 <div class="row mb-6" style="">
                   <div class="col-lg-6">
                     <label><small class="text-muted">Paid Amount</small></label >
                    <input type="number" step="0.01" name="amount" placeholder="0.00" class="form-control" required autocomplete="off" <?php echo $style1; ?>>
                  </div>
                
                  <div class="col-lg-6">
                     <label><small class="text-muted">Date Paid</small></label >
                    <input type="date" name="datepaid" placeholder="0.00" class="form-control" required autocomplete="off" <?php echo $style1; ?>>
                  </div>
                 <!-- <div class="col-lg-8">
                   <label><small class="text-muted">Upload Photo Gcash / Paymaya (jpg / png)</small></label > </div> -->
                    <input type="file" name="photo" placeholder="0.00" class="form-control" autocomplete="off" <?php echo $style1; ?> hidden>                     
              </div>
               <br><center><br>
                    <button onclick="return confirm('Are you sure you want to process this payment ?')" type="submit" style="width: 40%;color:white;border-radius: 10px;height:35px;float:right ;" class="btn btn-secondary" id='subm' name="process">Process Payment <i class="fas fa-paper-plane"></i> </button>
                <br><br>
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

<script>

    function checkUname() {
        
        jQuery.ajax({
        url: "../../checkrefnum.php",
        data:'ref='+$("#refnum").val(),
        type: "POST",
        success:function(data){
            $("#check-refnum").html(data);
        },
        error:function (){}
        });
    }
    </script>