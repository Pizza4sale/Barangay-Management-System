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
                     New Application / Business Permit
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- Container fluid  -->
        <!-- ============================================================== -->
<CENTER>

   <?php
          if(isset($_GET['fr'])){
             if($_GET['fr'] =='yes'){

                  $qry = "SELECT * FROM tbl_resident where id = '".$_GET['id']."' ";
                  $res = mysqli_query($conn, $qry);
                  while($row = mysqli_fetch_array($res)) { 

                    $fname = $row['fname'];
                    $mname = $row['mname'];
                    $lname = $row['lname'];
                    $bday = $row['bday'];
                    $civilstat = $row['civilstat'];
                    $purok = $row['purok'];
                    $brgy = $row['brgy'];
                    $city = $row['city'];
                    $country = $row['country'];
                    $voter = $row['voter'];
                    $contact = $row['contact'];
                    $gender = $row['gender'];
                    $occupation = $row['occupation'];
                    $citizen = $row['citizenship'];
                    $bplace = $row['bplace'];
                    $disable = '';
                    $fulladdress = $purok." ".$brgy." ".$city." ".$country;
                    if( $row['voter'] =='Registered Voter'){
                      $voterr = 'yes';
                    }else{
                      $voterr ='no';
                    }

                  }

                  $back = 'select_transaction.php?id='.$_GET['id'];

             }elseif($_GET['fr'] =='no'){

                    $fname = "";
                    $mname = "";
                    $lname = "";
                    $bday = "";
                    $civilstat = "Select Civil Status";
                    $purok = "";
                    $brgy = "";
                    $city = "";
                    $country = "";
                    $voter = "";
                    $contact = "";
                    $gender = "Select Gender";
                    $occupation =""; "";
                    $citizen = "";
                    $bplace = "";
                    $disable = 'disabled';
                    $voterr='';
                    $fulladdress = "";
                    $back = 'permit_file.php';

             }
          }
                
         ?>

        <div class="container-fluid" >
        <form method="post" action="savepermit_b.php" ><br>
                  <div class="card" style="background-color:darkslategray;width:90%;border-radius:12px" >
                   <input type="hidden" name="from" class="form-control" required>
                  <h2  style="padding-left:-10px;font-size:20px;background-color: #0C4AF3;" class="badge rounded-pill"> &nbsp New Application | Barangay Business Permit &nbsp </h2>
                  <br>
                   <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;">
                    <div class="col-lg-4">
                    <label><small class="text-muted"><em style="color: red">*</em> FIRST NAME</small></label >
                    <input type="text" name="name" value='<?php echo $fname; ?>' class="form-control" id="name" placeholder="---" autocomplete="off" required>
                   </div>
                   <div class="col-lg-4">
                     <label><small class="text-muted">MIDDLE NAME</small></label >
                     <input type="text" name="mname" value='<?php echo $mname; ?>'class="form-control" id="name" placeholder="---" autocomplete="off" >
                  </div>
                  <div class="col-lg-4">
                     <label><small class="text-muted"><em style="color: red">*</em> LAST NAME</small></label >
                     <input type="text" name="lname" value='<?php echo $lname; ?>' class="form-control" id="name" placeholder="---" autocomplete="off" required>
                  </div>
                </div>
                <div class="row mb-3 mt-1" style="padding-left : 30px;padding-right : 30px;padding-top: 1px;">
                  <div class="col-lg-4">
                     <label><small class="text-muted"><em style="color: red">*</em> TAX IDENTIFICATION NUMBER</small></label >
                      <input type="text" name="tinn" class="form-control tin-inputmask" id="tin-inputmask" id="name" placeholder="" autocomplete="off" required>
                  </div>
                  <div class="col-lg-4">
                     <label><small class="text-muted"><em style="color: red">*</em> PHONE NUMBER</small></label >
                    <input type="tel"  class="form-control phone-inputmask" value='<?php echo $contact; ?>' name="phone" autocomplete="off" > 
                  </div>
                  <div class="col-lg-4">
                     <label><small class="text-muted">TELEPHONE NUMBER</small></label >
                   <input type="text" name="telnum" class="form-control telephone-inputmask"  autocomplete="off" >
                  </div>
                </div>
                 <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;padding-top: 1px;">
                  <div class="col-lg-8">
                    <label><small class="text-muted"><em style="color: red">*</em> BUSINESS TRADE NAME (per DTI Reg.)</small></label >
                    <input type="text" name="busname" class="form-control" placeholder="---" autocomplete="off" required>
                  </div>
                  <div class="col-lg-4">
                   <small class="text-muted"><em style="color: red">*</em>  TAX IDENTIFICATION NUMBER</small> 
                    <input type="text" name="btin"  class="form-control tin-inputmask" id="tin-inputmask" placeholder="---"autocomplete="off" required>
                  </div>
                 </div>
                  <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;padding-top: 1px;  ">
                    <div class="col-lg-8">
                    <label><small class="text-muted"><em style="color: red">*</em> CORPORATE NAME (per SEC. Reg)</small></label >
                    <input type="text" name="corponame" class="form-control" placeholder="---" autocomplete="off" required>
                  </div>
                    <div class="col-lg-4">
                      <label><small class="text-muted"><em style="color: red">*</em> TYPE OF OWNERSHIP</small></label >
                    <select type="text" name="radio" class="form-control" required>
                        <option value="Single"> - Single Proprietor</option>
                        <option value="cooperative"> - Cooperative</option>
                        <option value="partner"> - Partnership</option>
                        <option value="others"> - Others</option>
                      </select>
                       <input type="text" name="others" style="border-bottom: 1px solid;" cautocomplete="off" class="form-control" placeholder="Other's Specify" >
                    
                  </div>
                </div>
                 <div class="row mb-3" style="padding: 30px;padding-top: 1px;">
                  <div class="col-lg-8">
                    <label><small class="text-muted"><em style="color: red">*</em> BUSINESS FULL ADDRESS</small></label >
                   <input type="text" name="busaddress" class="form-control" placeholder="---"autocomplete="off" required>
                    <center><br><br>
                   <button onclick="return confirm('Are you sure you want to process this transaction ?')" name="permitsave" type="submit" style="width:30%;color:white;border-radius: 8px;"  class="btn btn-info"><i class="fas fa-save"></i> Process / Save</button>
                     <a href="<?php echo $back; ?>" style="width:30%;color:white;border-radius: 8px;"  class="btn btn-danger" > <i class="fas fa-arrow-alt-circle-left"></i> Back to Home</a>
                  </div>
                   <div class="col-lg-4">
                    <label><small class="text-muted">CAPITAL BREAKDOWN</small></label >
                     <textarea class="form-control" name="breakdown" autocomplete="off" rows="5" placeholder="Type Here..."></textarea>
                  </div>
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
