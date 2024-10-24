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
                     Create Complaint Report
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
        $sqlrt01 = "SELECT * FROM `tbl_complaint` where com_ctrl='".$_GET['cnum']."' ";
        $processQueryrt01 = $conn->query($sqlrt01);
        while ($resultQueryrt01 = $processQueryrt01->fetch_assoc())
        {   ?> 
        <form method="post" >
           <div class="card" style="background-color:#25304E;width:90%;border-radius:12px" >
                 <h2  style="padding-left:-10px;font-size:20px;background-color: #0C4AF3;" class="badge rounded-pill"> &nbsp Barangay Complaint - Control No.: <?php echo $_GET['cnum']; ?> &nbsp </h2>
                   <div class="row mb-3" style="padding-left: 20px;">
                    <div class="col-lg-3">
                    <input type="hidden" name="cnum" class="form-control" value="<?php echo $_GET['cnum']; ?>" >
                   </div>
                   <br>
              <div class="row mb-3" style="padding-left : 30px;padding-right : 30px;">
                  <div class="col-lg-4">
                     <label><small class="text-muted">Prepared By</small></label >
                    <input type="text" class="form-control" name="prepared" autocomplete="off" >
                  </div>
                  <div class="col-lg-12 mt-4">
                    <label  class="text-muted">- - - PLEASE PROVIDE INFORMATION BELOW - - - </label >
                   <table  style="width:100%" cellspacing="8"  id="dynamic_field">  
                      <tr> 
                        <td ><label><small class="text-muted">Action Taken</small></label ><textarea placeholder="Type here . . " class="form-control input-sm" row="0.5" name="taken[]" id="taken[]" required></textarea></td>
                        <td></td>
                        <td  style="width:30%"><label><small class="text-muted">Verified By</small></label ><input type="text" class="form-control input-sm" name="assist[]" id="assist[]" placeholder="..." autocomplete="off"  required>
                        </td>
                        <td></td>
                        <td style="width:20%"><label><small class="text-muted">Date</small></label ><input type="date" class="form-control input-sm" name="date[]" id="date[]" placeholder="..." autocomplete="off"  required>
                        </td>
                         <td><button type="button" class="badge btn-success"name="add" id="add" >+</button></td>  
                      </tr>
                      </table>
                  </div>
                   <div class="col-lg-12 mt-4">
                     <label><small class="text-muted">Action Results</small></label >
                    <textarea placeholder="Type here . . " style="box-shadow: 1px 1px;" class="form-control input-sm" row="1" name="result" required></textarea>
                  </div>
                <div class="row mb-3 mt-4" style="padding-left:  20px;">
                  <center>
                 <button onclick="return confirm('Are you sure you want to process this request ?')" name="report" type="submit" style="width:20%;color:white;" class="btn btn-primary" name=""><i class="fas fa-save"></i> Save Report</button>
                 <a href="complain_file.php" style="width:25%;color:white;" class="btn btn-danger" > <i class="fas fa-arrow-alt-circle-left"></i> Back to Home</a>
                </div>
                  
      <?php
          if(isset($_POST['report'])){ 

            $idial= count($_POST["taken"]);   
            if($idial > 0) {  
              for($i=0; $i<$idial; $i++) {  
                if(trim($_POST["taken"][$i] != ''))  {
                    
                    $taken=mysqli_real_escape_string($conn, $_POST["taken"][$i]);
                    $assist=mysqli_real_escape_string($conn, $_POST["assist"][$i]);
                    $datee=mysqli_real_escape_string($conn, $_POST["date"][$i]);

                    $ins ="INSERT INTO `tbl_complaindetails`(`com_ctrl`, `action_date`, `action_taken`, `action_result`, `assistedby`, `encodedby`) VALUES ('".$_POST['cnum']."','".$datee."','".$taken."','".$_POST['result']."','".$assist."','".$_POST['prepared']."')";
                    $updd = $conn->query($ins);
                    ?>
                        <script>
                           alert ("Successfully saved your report.");
                           window.location.replace("complain_file.php"); 
                        </script>
                  <?php     
                  }
                } 
              }
            }
           ?>
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
  <!-- Dynamically add -->
  <script>  
 $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td ><textarea placeholder="Type here . . " style="box-shadow: 1px 1px;" class="form-control input-sm" row="1" name="taken[]" id="taken[]"></textarea></td><td></td><td ><input style="box-shadow: 1px 1px;" type="text" class="form-control input-sm" style="width:30%" name="assist[]" id="assist[]" placeholder="..." autocomplete="off" ></td><td></td><td><input style="box-shadow: 1px 1px;"  type="date" class="form-control input-sm" name="date[]" id="date[]" style="width:20%"placeholder="..." autocomplete="off" ></td><td><button type="button" name="remove" id="'+i+'" class="badge btn-danger btn_remove"><i class="fa  fa-times-circle"></i></button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
 
 });  
 </script>
