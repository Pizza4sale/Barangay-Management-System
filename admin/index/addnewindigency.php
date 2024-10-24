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
                     New Application / Certificate of Indigency
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
        <div class="container-fluid" >

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
                    $city = "Panukulan";
                    $country = "Philippines";
                    $voter = "";
                    $contact = "";
                    $gender = "Select Gender";
                    $occupation =""; "";
                    $citizen = "";
                    $bplace = "";
                    $disable = 'disabled';
                    $voterr='';
                    $fulladdress = "";
                    $back = 'indigencyfile.php';

             }
          }
                
         ?>

        <form method="post" action="saveindigency_2.php" ><br>
                  <div class="card" style="background-color:darkslategray;width:80%;border-radius:12px" >
                   <input type="hidden" name="from" class="form-control" required>
                  <h2  style="padding-left:-10px;font-size:20px;background-color: #0C4AF3;" class="badge rounded-pill"> &nbsp New Application |  Certificate of Indigency &nbsp </h2>
                  <br>
                   <div class="row mb-8" style="padding-left : 30px;padding-right : 30px;">
                  <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*First Name</label>
                       <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>" autocomplete="off" placeholder="First Name" required>
                      </div>
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">Middle Name</label>
                        <input type="text" name="mname" class="form-control" value="<?php echo $mname; ?>"  placeholder="Middle Name" autocomplete="off" >
                      </div>
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Last Name</label>
                        <input type="text" class="form-control" value="<?php echo $lname; ?>"  name="lname" placeholder="Last Name" autocomplete="off" required>
                      </div>
                </div>
                <div class="row mb-3 mt-1" style="padding-left : 30px;padding-right : 30px;padding-top: 1px;">
                  <div class="col-lg-4">
                     <label><small class="text-muted"><em style="color: red">*</em> PHONE NUMBER</small></label >
                    <input type="tel"  class="form-control phone-inputmask" value="<?php echo $contact; ?>" name="number" autocomplete="off" > 
                  </div>
        
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Birthday</label>
                     <input type="date" name="bday" value="<?php echo $bday; ?>" class="form-control" required>
                      </div>
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Civil Status</label>
                       <select type="text" name="civil" class="form-control" required>
                           <option selected <?php echo $disable; ?>><?php echo $civilstat; ?></option>
                           <option>Single</option>
                           <option>Married</option>
                           <option>Widowed</option>
                      </select>
                      </div>
                 </div>
                  <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;padding-top: 1px;  ">
                   <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">* House Number</label>
                       <input type="text"name="street" class="form-control" placeholder="Sitio/Purok/Zone/Building No."  autocomplete="off" required>
                      </div>
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Barangay</label>
                      <input type="text" name="brgy" value="<?php echo $brgy; ?>"class="form-control" value='Barangay Milawid' autocomplete="off">
                      </div>
                      <div class="col-md-2 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*City/Province</label>
                      <input type="text"  class="form-control" value="<?php echo $city; ?>" name="sal" value="Panukulan"  autocomplete="off">
                      </div>
                      <div class="col-md-2 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Country</label>
                      <input type="text" class="form-control" name="phil"  value="<?php echo $country; ?>" >
                      </div>
                </div>
                <br>
                 <div class="row mb-3" style="padding: 30px;padding-top: 1px;">
                  <div class="col-lg-12">
                   <button  onclick="return confirm('Are you sure you want to process this request ?')" name="permitsave" style="width:30%;color:white;border-radius: 8px;"  class="btn btn-info"><i class="fas fa-save"></i> Process / Save</button>
                     <a href="<?php echo $back; ?>" style="width:30%;color:white;border-radius: 8px;"  class="btn btn-danger" > <i class="fas fa-arrow-alt-circle-left"></i> Back to Home</a>
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
