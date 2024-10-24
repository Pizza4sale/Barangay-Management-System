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
                      Covid Records
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
            <button class="tablinks" onclick="openCity(event, 'ab')" style="width:30%" id="defaultOpen"><i class="fas fa-clipboard-list"></i> Covid 19 Patient Status</button>
            <button class="tablinks" onclick="openCity(event, 'cd')" style="width:30%"><i class="fas fa-plus-circle"></i> New Covid Case</button>

          </div>
          <?php
           $style1 = "style='color:black;font-size: 13px;height:4px;' ";
           $style2 = "style='color:black;font-size: 12px;' ";
           $style3="style='color:red' ";
           $style4="style='color:green' ";
           $style5="style='color:grey' ";
          ?>
          <div id="ab" class="tabcontent">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:13px;color:black;" >
                      <thead>
                        <tr>
                           <th></th>
                           <th><b>PATIENT NAME</b></th>
                           <th <?php echo $style1; ?>><b>GENDER</b></th>
                           <th <?php echo $style1; ?>><b>AGE</b></th>
                           <th <?php echo $style1; ?>><b>CIVIL</b></th>
                           <th <?php echo $style1; ?>><b>ADDRESS</b></th>
                           <th <?php echo $style1; ?>><b></b></th>
                        </tr>
                      </thead>
                      <tbody>
               <?php    
                     //Code for displayed user in a table
                      $query = "SELECT distinct * FROM tbl_covid order by status DESC";   
                      $result = mysqli_query($conn, $query);  
                      while($row = mysqli_fetch_array($result)) { ?>
                      <tr >
                          <td ><i  <?php if($row["status"] == "NEW"){ echo $style5; }
                                elseif($row["status"] == "RECOVERED"){ echo $style4;}
                                else{ echo $style3; } ?> class="fas fa-star"></i></td>
                          <td style="width:200px" > <?php echo strtoupper($row["patient_name"]); ?></td>

                          <td style="width:50px"><?php echo $row["gender"]; ?></td>
                          <td style="width:50px"><?php echo $row["age"]; ?></td>
                          <td style="width:60px"><?php echo $row["civil"]; ?></td>
                          <td style="width:200px"><?php echo $row["homeaddress"]; ?></td>
                          <td style="width:50px" >
                        <?php if($row["status"] == "NEW"){ ?>
                          <a class="badge btn-warning" onclick="return confirm('Are you sure you want to declare this patient as RECOVERED?')"  style="font-size: 13px;width:100%"  href="healthstat.php?from=covid&type=recovered&id=<?php echo $row['covid_id'];?>">RECOVERED</a>
                         <a class="badge btn-danger" onclick="return confirm('Are you sure you want to declare this patient as DEATH?')"   style="font-size: 13px;width:100%"  href="healthstat.php?from=covid&type=death&id=<?php echo $row['covid_id'];?>">DEATH</a>
                         <?php } ?>
                         </td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
<?php
$style1 = "style='box-shadow: 1px 1px;'";
?>
          <div id="cd" class="tabcontent">
             <div class="card">

   <form method="post">
     <div class="row" style="width:100%">
              <div class="card" style="background-color:whitesmoke;width:100%;border-radius:12px;color:lightslategrey;">
                <div class="card-body">
               <div class="row mb-3">
                    <div class="col-lg-8">
                     <label><small class="text-muted">Patient Name</small></label> 
                    <input type="text" name="pname" class="form-control" placeholder="Dela Cruz, Juan" autocomplete="off" required>
                    </div>
                </div>
                  <div class="row mb-3">
                    <div class="col-lg-3">
                     <label><small class="text-muted">Birthday</small></label >
                     <input type="date" name="bdate" class="form-control"  required>
                  </div>
                    <div class="col-lg-2">
                        <label><small class="text-muted">Age (yrs)</small></label> 
                     <input type="number" name="age" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="col-lg-3">
                     <label><small class="text-muted">Civil Status</small></label> 
                     <select type="text" name="civil" class="form-control" required>
                      <option selected disabled="">Civil Status</option>
                      <option>Single</option>
                      <option>Married</option>
                      <option>Widowed</option>
                    </select>
                    </div>
                  </div>
                 <div class="row mb-3">
                  <div class="col-lg-2">
                     <label><small class="text-muted">Gender</small></label ><Br>
                     <input type="radio" style="font-size: 15px;" value="Female" name="gender"> Female
                     <input type="radio" style="font-size: 15px;" value="Male" name="gender"> Male
                  </div>

                    <div class="col-lg-6">
                     <label><small class="text-muted">Home Address</small></label >
                   <input type="text" name="address" class="form-control" placeholder="Home Address" autocomplete="off" required>
                  </div>
                 </div>
                    </div>
                     <div class="border-top">
                  <div class="card-body">
                    <button type="submit" name='savecovid1' class="btn btn-primary text-white"><i class="fas fa-save"></i> Add Patient</button>
                    <a href="covid.php" class="btn btn-danger text-white"><i class="fas fa-arrow-alt-circle-left"></i>  Cancel </a>
                  </div>
                </div>

                  </div>
                </div>
            </div>
        </div>
      </FORM>

      <?php
      date_default_timezone_set('Asia/Manila');
    $dat= date('Y-m-d H:i:s');
if(isset($_POST['savecovid1'])){

$savecovid = "INSERT INTO `tbl_covid`(`patient_name`, `birthday`, `age`, `civil`, `homeaddress`, `status`, `date_end`, `date_start`,gender) VALUES('".$_POST['pname']."','".$_POST['bdate']."','".$_POST['age']."','".$_POST['civil']."','".$_POST['address']."','NEW','','". $dat."','".$_POST['gender']."')";
 $updd = $conn->query($savecovid);


if($updd){

?>
   <script>
            alert("You have successfully added a new covid case patient");
           window.location.replace("covid.php");
       </script>

<?php  
 }
} ?>

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
