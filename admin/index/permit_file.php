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
       <?php
        if($_SESSION["userpos"] =='ADMIN02'){ 
           include 'include/sidebar2.php';
        }else{
           include 'include/sidebar.php';
        }
      ?>

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
                    Business Clearance / Permit File
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
         
          <div class="tab" style="border-radius: 10px;">
          <?php
            if($_SESSION["userpos"] =='ADMIN02'){ 
          ?>
            <button class="tablinks" style="border-radius: 30px;width:100%" onclick="openCity(event, 'cd')" id="defaultOpen">Business Permit Record
             </button>
            <?php }else{ ?> 
               <button class="tablinks" style="border-radius: 30px;width:100%" onclick="openCity(event, 'ab')" id="defaultOpen">Business Permit Record &nbsp 
            <?php $sqlw1 = "SELECT count(permit_num) as num FROM tbl_permit where status='OLD' ";
            $processQueryw1 = $conn->query($sqlw1);
            while ($resultQuerwy = $processQueryw1->fetch_assoc())
            {echo  $numm = "(".$resultQuerwy['num'].")"; }
             ?>
             </button>
            <?php } ?>
            
          </div>
          <?php
           $style1 = "style='color:white;font-size: 12px;height:2px;padding:5px' ";
           $style2 = "style='color:black;font-size: 12px;' ";
          ?>
          <div id="ab"  style="border-radius: 30px;background-color: darkgray;" class="tabcontent">
            <div class="card" style="border-radius: 30px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                       <br>
                    <form method="post" style='font-size: 12px;' >
                      <label> Select Date: </label>
                        <input type="date" name="from" required>
                        <input type="date" name="too" required>
                        <input class='btn-success' type='submit' name='show' value='Show'>
                    </form>
                    <br>
                    <?php  if(isset($_POST['show'])){ 
                            $sql1 = "SELECT * FROM tbl_permit where status='OLD' and captain ='okay' and datereleased BETWEEN '".$_POST['from']."' AND '".$_POST['too']."' ORDER by datereleased ASC";
                            }else{
                               $sql1 = "SELECT * FROM tbl_permit where status='OLD' and captain ='okay'  ORDER by datereleased ASC  ";
                            }
                      ?>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:13px;color:black" >
                      <thead>
                      <tr style="background-color:#36A3DF;">
                           <th></th>
                           <th <?php echo $style1; ?>><b>Date Issued</b></th>
                            <th <?php echo $style1; ?>><b>Permit Number</b></th>
                           <th <?php echo $style1; ?>><b>Business Name</b></th>
                           <th <?php echo $style1; ?>><b>Business Owner</b></th>
                           <th <?php echo $style1; ?>><b>Phone Number</b></th>
                           <th <?php echo $style1; ?>>_</th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                     $processQuery1 = $conn->query($sql1);
                     while ($resultQuery = $processQuery1->fetch_assoc())
                    { ?>
                      <tr>
                          <td><i style="color: red" class="fas fa-star"></i></td>
                          <td style="width:15%">
                             <?php if( $resultQuery['datereleased'] =="" ){ echo "<a style='font-size:12px' class='badge btn-danger'>&nbsp<b>** For Release</b>&nbsp</a>"; }
                            else{ echo $resultQuery['datereleased']; } ?>
                          </td>
                          <td><?php echo $resultQuery['permit_num']; ?></td>
                           <td><?php echo $resultQuery['business_name']; ?></td>
                          <td><?php echo $resultQuery['lname'].",".$resultQuery['fname']; ?></td>
                          <td><?php echo $resultQuery['phone_num']; ?></td>
                         
                           <td>
                          <?php if( $resultQuery['captain'] =="okay" ){ ?> 
                            <a target="_blank" style="font-size: 13px;background-color:#3498DB" href="pdf/generatepermit.php?id=<?php echo $resultQuery['permit_num']; ?>" class="badge btn-success"> <img src="img/<?php echo 'immigration.png'; ?>" alt="" width="30" class="img-fluid"></a>
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

          <!-- Captain -->

          <div id="cd"  style="border-radius: 30px;background-color: darkgray;" class="tabcontent">
            <div class="card" style="border-radius: 30px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:13px;color:black" >
                      <thead>
                        <tr style="background-color:#36A3DF;">
                            <th <?php echo $style1; ?>><b>Permit Number</b></th>
                           <th <?php echo $style1; ?>><b>Business Details</b></th>
                           <th <?php echo $style1; ?>><b>Related Documents</b></th>
                           <th <?php echo $style1; ?>>_</th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                     $sql1 = "SELECT * FROM tbl_permit where captain='wait' ";
                     $processQuery1 = $conn->query($sql1);
                     while ($resultQuery = $processQuery1->fetch_assoc())
                    { ?>
                      <tr>
                          <td><?php echo $resultQuery['permit_num']; ?></td>
                           <td>
                            <b>Business Name: </b> <?php echo $resultQuery['business_name']; ?> <br>
                            <b> Owner Name: </b> <?php echo $resultQuery['lname'].",".$resultQuery['fname']; ?><br>
                            <b> Phone Number: </b> <?php echo $resultQuery['phone_num']; ?></td>
                           <td>
                            
                        <a class="badge btn-danger" target="_blank" href="pdf/generatepermit.php?id=<?php echo $resultQuery['permit_num']; ?>" > View Permit File </a>
                         <br>
                      
                            <?php if($resultQuery['uploadreq']==""){echo "No File Uploaded";}else{ ?>
                            <a class="badge btn-warning" href="../../user/pages/file/<?php echo $resultQuery['uploadreq']; ?>" target="_blank"><?php echo substr($resultQuery['uploadreq'],0,20); ?></a>

                         <?php } ?></td>
                           <td> <a style="font-size: 13px;" onclick="return confirm('Are you sure you want to proceed with this request ?')" href='process.php?cnum=<?php echo $resultQuery['permit_num']; ?>&type=ppermit&cnum2=<?php echo $resultQuery['reqnum']; ?>' class="badge btn-success"><i class='fa fa-check'></i> Proceed </a></td>
                        </tr>
                    <?php } ?>
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