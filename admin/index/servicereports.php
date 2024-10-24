<?php 
include 'include/conn.php';
session_start();
if(!isset($_SESSION["userpos"]))
header("location:index.php");

date_default_timezone_set('Asia/Manila');
$logdate = date('Y-m-d');


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

<style type="text/css">
img:hover {
  box-shadow: 0 0 2px 2px rgba(0, 140, 186, 0.5);
}
</style>
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
      <?php include 'include/'.$sidebar; ?>
      <!-- End Of Sidebar  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title"></h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">

                     <?php if($_SESSION["userpos"] =='ADMIN02'){ ?>
                    <li class="breadcrumb-item"><a href="dashboard02.php">Home</a></li>
                    <?php }else{ ?>
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <?php } ?>

                    <li class="breadcrumb-item active" aria-current="page">
                      Service Reports
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'cd')" id='defaultOpen'><i class="fas fa-money-bill-wave"></i> Service Record &nbsp <!-- <a href="pdf/generate_payment.php" target="_blank" class="badge btn-success" >Print</a> --></button>
          </div>
          <?php
           $style1 = "style='color:black;font-size: 13px;height:4px;' ";
           $style2 = "style='color:black;font-size: 12px;' ";
          ?>
        <!-- FAQ -->
          <div id="cd" class="tabcontent">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <form method="post" >
                      <select name='services' onchange='this.form.submit()' class='form-control' style='width:25%;background-color:cadetblue;color:white' required >
                          <option selected disabled>Select Services</option>
                          <option value='brgyclearance'>Barangay Clearance</option>
                          <option value='permit'>Business Permit</option>
                          <option value='residency'>Barangay Residency</option>
                          <option value='soloparent'>Certificate of Solo Parent</option>
                          <option value='lowincome'>Certificate of Low Income</option>
                          <option value='indigency'>Certificate of Indigency </option>
                      </select>
                  </form>
                  <br>
                  <form method="get" target="_blank" action='pdf/generate_service.php' style='font-size: 12px;' >
                    <label> Select Released Date</label><br>
                      <input type="date" name="from" required>
                      <input type="date" name="too" required>
                      <?php 
                       if(isset($_POST['services'])){ 
                          $dc =$_POST['services'];
                       }else{
                          $dc ="";
                       }
                      ?>
                      <input type='text' name='services' value="<?php echo $dc; ?>" style='width:10%' readonly required>
                      <input class='btn-success' name='range' type='submit' value='Print Range'>
                  </form>
                  
                  <br>
                  <div class="table-responsive">
                     <table id="example" class="table display" style="font-size:13px;color:black;" >
                      <thead>
                        <tr>
                           <th <?php echo $style1; ?>><b>Control Number</b></th>
                           <th <?php echo $style1; ?>><b>Name</b></th>
                           <th <?php echo $style1; ?>><b>Date Requested</b></th>
                           <th <?php echo $style1; ?>><b>Date Released</b></th>
                        </tr>
                      </thead>
                      <tbody>
                    <?php if(isset($_POST['services'])){ 

                        if($_POST['services'] =='brgyclearance'){
                            $d = "tbl_brgyclearance";
                        }
                        elseif($_POST['services'] =='permit'){
                             $d = "tbl_permit";
                        }
                        elseif($_POST['services'] =='residency'){
                             $d = "tbl_residency";
                        }
                        elseif($_POST['services'] =='soloparent'){
                             $d = "tbl_soloparent";
                        }
                        elseif($_POST['services'] =='lowincome'){
                             $d = "tbl_lowincome";
                        }
                        elseif($_POST['services'] =='indigency'){
                             $d = "tbl_indigency";
                        }
                        //echo $_POST['services'];
                      $query1 = "SELECT  * FROM $d WHERE datereleased != '' ";  
                      $result1 = mysqli_query($conn, $query1);  
                      while($row1 = mysqli_fetch_array($result1)) { ?>
                      <tr>
                          <td style="width:200px">
                            <?php
                                if($_POST['services'] =='brgyclearance'){
                                   echo  $row1["ctrl_num"];
                                }
                                elseif($_POST['services'] =='permit'){
                                    echo  $row1["permit_num"];
                                }
                                elseif($_POST['services'] =='residency' ){
                                    echo  $row1["res_ctrl"];
                                }else{
                                     echo  $row1["reqnum"];
                                }
                              ?> 
                          </td>
                           <td style="width:200px">
                            <?php
                                if($_POST['services'] =='brgyclearance'){
                                  echo $row1["lname"].", ".$row1["fname"]." ".$row1["mname"];
                                }
                                elseif($_POST['services'] =='permit'){
                                    echo $row1["lname"].", ".$row1["fname"]." ".$row1["mname"];
                                }
                                elseif($_POST['services'] =='residency'){
                                   echo $row1["res_lname"].", ".$row1["res_name"]." ".$row1["res_mname"];
                                }else{
                                   echo $row1["lname"].", ".$row1["fname"]." ".$row1["mname"];
                                }
                              ?> 
                          </td>
                          <td style="width:200px"><?php echo $row1["datetimereq"]; ?></td>
                          <td style="width:200px"><?php echo $row1["datereleased"]; ?></td>
                        </tr>
                    <?php } } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>



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
        <script src="../assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
   $(document).ready(function() {
    $('#example').DataTable();
    } );
   </script>


  </body>
</html>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

$(document).ready(function() {
    $('table.display').DataTable();
} );
</script>
