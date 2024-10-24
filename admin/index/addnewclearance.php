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
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <?php if($_SESSION["userpos"] =='ADMIN02'){ ?>
                    <li class="breadcrumb-item"><a href="dashboard02.php">Home</a></li>
                    <?php }else{ ?>
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <?php } ?>
                    <li class="breadcrumb-item active" aria-current="page">
                     New Application / Barangay Clearance
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
        <center>

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
                    $back = 'clearance_file.php';

             }
          }
                
         ?>

 
         <div class="card" style="background-color:darkslategray;width:100%;border-radius:12px" >
                  <h2  style="padding-left:-10px;font-size:20px;background-color: #0C4AF3;" class="badge rounded-pill"> &nbsp New Application | Barangay Clearance &nbsp </h2>
                  <br>

                <form method="post" action="saveclearance.php" >
                   <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;">
                     
                    <div class="col-lg-4">
                    <label><small class="text-muted"><em style="color: red">*</em> FIRST NAME</small></label >
                     <input type="hidden" name="oldcnum" class="form-control" value="-" required>
                     <input type="hidden" name="idniya" class="form-control" value="<?php echo $_GET['id']; ?>">
                     <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>" placeholder="First Name" autocomplete="off" required>
                   </div>
                   <div class="col-lg-4">
                     <label><small class="text-muted">MIDDLE NAME</small></label >
                    <input type="text" name="mname" class="form-control" value="<?php echo $mname; ?>" placeholder="Middle Name" autocomplete="off" >
                  </div>
                  <div class="col-lg-4">
                     <label><small class="text-muted"><em style="color: red">*</em> LAST NAME</small></label >
                   <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>" placeholder="Last Name" autocomplete="off" required>
                  </div>
                </div>
                <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;padding-top:1px">
                  <div class="col-lg-4">
                     <label><small class="text-muted"><em style="color: red">*</em> BIRTHDAY</small></label >
                     <input type="date" name="bdate" class="form-control" value="<?php echo $bday; ?>" required>
                  </div>
                 <div class="col-lg-4">
                     <label><small class="text-muted"><em style="color: red">*</em> CIVIL STATUS</small></label >
                     <select type="text" name="civil" class="form-control" required>
                      <option selected <?php echo $disable; ?> ><?php echo $civilstat; ?></option>
                      <option>Single</option>
                      <option>Married</option>
                      <option>Widowed</option>
                    </select>
                  </div>
                  <div class="col-lg-4">
                     <label><small class="text-muted"><em style="color: red">*</em> GENDER</small></label ><Br>

                      <select type="text" name="gender" class="form-control" required>
                      <option selected <?php echo $disable; ?> ><?php echo $gender; ?></option>
                      <option>Single</option>
                      <option>Married</option>
                      <option>Widowed</option>
                    </select>

                   
                  </div>
                </div>
                   <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;padding-top:1px">
                  <div class="col-lg-4">
                    <label><small class="text-muted"><em style="color: red">*</em> ARE YOU A REGISTERED VOTER?</small></label >
                    <select type="text" name="voter" class="form-control" required>
                   <option selected <?php echo $disable; ?> value='<?php echo $voterr; ?>' ><?php echo $voter; ?></option>
                    <option value="yes">Yes, I am a registered voter</option>
                    <option value="no">No, I am not registered</option>
                  </select>
                  </div>
                   <div class="col-lg-4">
                    <label><small class="text-muted"><em style="color: red">*</em> LENGTH OF STAY (YRS)</small></label >
                   <input type="number" name="length" class="form-control" autocomplete="off" placeholder="Length of Stay (yrs)" required>
                  </div>
                  <div class="col-lg-4">
                    <label><small class="text-muted">EMPLOYMENT BACKGROUND - EMPLOYER NAME</small></label >
                   <input type="text" name="company" value='N/A' class="form-control" autocomplete="off" placeholder="Company if employed" required>
                  </div>
                  <div hidden class="col-lg-4">
                    <label><small class="text-muted">-</small></label ><br>
                    <input type="hidden" name="attached2" class="form-control">
                  </div>
                 </div>
                  <div class="row mb-1" style="padding-left : 30px;padding-right : 30px;padding-top:1px">
                    <div class="col-lg-8">
                    <label><small class="text-muted"><em style="color: red">*</em> FULL ADDRESS OF THE REQUESTOR</small></label >
                     <input type="text" name="address" value='<?php echo $fulladdress; ?>' class="form-control" autocomplete="off" placeholder="Full Address" required>
                  </div>
                  <div class="col-lg-4">
                    <label><small class="text-muted"><em style="color: red">*</em> PURPOSE OF REQUEST</small></label >
                      <textarea class="form-control" name="purpose" autocomplete="off" rows="3" placeholder="Type Here..." required></textarea>
                  </div>
                  </div><br>
                 <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;padding-top:1px">
                <center> &nbsp  &nbsp

                <button name="save" onclick="return confirm('Are you sure you want to process this transaction ?')"type="submit" style="width:30%;color:white;border-radius: 8px;" class="btn btn-info"><i class="fas fa-save"></i> Process / Save</button>


                 <a href="<?php echo $back; ?>" style="width:30%;color:white;border-radius: 8px;" class="btn btn-danger"> <i class="fas fa-arrow-alt-circle-left"></i> Back to Home</a>
                </div>
              </div>
       </form>
   
        </div>
        <!-- ============================================================== #25304E -->
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
