<?php 
include 'include/conn.php';
session_start();
if(!isset($_SESSION["userpos"]))
header("location:index.php");

if(isset($_POST['ok']))
{
    $queryx = mysqli_query($conn, "update `tbl_complaint` set visitsched='".$_POST['sched']."' where com_id = '".$_POST['iddd']."'");
}
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

    <!-- datetime picker -->
      <!-- Font Awesome -->
  <link rel="stylesheet" href="include/datetime/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="include/datetime/daterangepicker.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="include/datetime/tempusdominus-bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="include/datetime/adminlte.min.css">
  <!-- end datetimepicker -->

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
                    Barangay Complaints File
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
         
          <div class="tab" style="border-radius: 10px;">
            <button class="tablinks" style="border-radius: 30px;width:100%;"onclick="openCity(event, 'ab')" id="defaultOpen">Barangay Complaints Record &nbsp
            <?php $sqlw1 = "SELECT count(com_ctrl) as num FROM tbl_complaint where status='OLD' ";
            $processQueryw1 = $conn->query($sqlw1);
            while ($resultQuerwy = $processQueryw1->fetch_assoc())
            { echo  $numm = "(".$resultQuerwy['num'].")"; }
             ?>
              &nbsp &nbsp <a class="badge btn-warning" href="addnewcomplaint.php" style="color:white;font-size: 12px;"><b><i class=" fas fa-user-plus"></i></b></a>
            </button>
          </div>
          <?php
           $style1 = "style='color:white;font-size: 12px;height:2px;padding:5px' ";
           $style2 = "style='color:black;font-size: 12px;' ";
          ?>
          <div id="ab"  style="border-radius: 30px;background-color: darkgray;width:100%;" class="tabcontent">
            <div class="card" style="border-radius: 30px;height: 500px;">
                <div class="card-body" >
                  <div class="table-responsive" style="height: 500px;" >
                    <table  id="example" class="table display"  style="font-size:12px;color:black;" >
                      <thead>
                        <tr style="background-color:#36A3DF;">
                           <th <?php echo $style1; ?>><b>Control Number</b></th>
                           <th <?php echo $style1; ?>><b>Name</b></th>
                           <th <?php echo $style1; ?>><b>File Upload</b></th>
                           <th <?php echo $style1; ?>><b>Schedule</b></th>
                           <th <?php echo $style1; ?>><b></b></th>
                           <th <?php echo $style1; ?>><b></b></th>
                        </tr> 
                      </thead>
                      <tbody>
                <?Php 
                     $sql1 = "SELECT * FROM tbl_complaint where status !='NEW' and status !='DECLINE'  ";
                     $processQuery1 = $conn->query($sql1);
                     while ($resultQuery = $processQuery1->fetch_assoc())
                    { ?>
                      <tr>
                           <td style="width: 20%"><?php echo $resultQuery['com_ctrl']; ?></td>
                          <td style="width: 30%"><?php echo $resultQuery['from']; ?> 
                          <br> <b>Contact: </b> <?php echo $resultQuery['phoneno']; ?></td>
                          <td ><a href="../../user/pages/file/<?php echo $resultQuery['upload']; ?>" target="_blank">View Attachment</a></td>

                           <td style="width: 30%" >
                            <b> Schedule: </b> <?php echo $resultQuery['visitsched']; ?>
                            <?php if($resultQuery['status']!='CLOSED'){?> 
                            <form method='post'>
                              <input type="hidden" name="iddd" value="<?php echo $resultQuery['com_id']; ?>" >
                              <div  class="input-group date"  id="reservationdatetime<?php echo $resultQuery['com_id']; ?>" data-target-input="nearest">
                                  <input type="text" name="sched" value="<?php echo $resultQuery['visitsched']; ?>" class="form-control datetimepicker-input" data-target="#reservationdatetime<?php echo $resultQuery['com_id']; ?> " hidden/>
                                  <div class="input-group-append" data-target="#reservationdatetime<?php echo $resultQuery['com_id']; ?>" data-toggle="datetimepicker" >
                                      <div class="input-group-text"><i class="fa fa-calendar" ></i></div>
                                  </div>
                                  <button class="btn-success" name='ok' type='submit'><i class="fa fa-check" ></i></button>
                              </div>
                            </form>
                            <?php } ?>
                           </td>

                           <td>
                          <?php if($resultQuery['status'] =="OPEN"){ ?>
                            <a target="_blank" style="font-size: 13px;background-color:#3498DB" href="viewcomplaint_2.php?cnum=<?php echo $resultQuery['com_ctrl']; ?>&from=complain" class="badge"><i class="far fa-comments"> </i> Open File</a>
                            <br><Br ><a target="_blank" style="font-size: 13px;background-color:#3498DB" href="pdf/generate_complain.php?id=<?php echo $resultQuery['com_ctrl']; ?>" class="badge"><i class="fas fa-folder"> </i> Report &nbsp &nbsp</a>
                          <?php }elseif($resultQuery['status'] =="CLOSED"){ ?>
                            <a target="_blank" style="font-size: 13px;background-color:#3498DB"  href="pdf/generate_complain.php?id=<?php echo $resultQuery['com_ctrl']; ?>" class="badge"><i class="fas fa-folder"> </i> Report &nbsp &nbsp</a>
                          <?php } ?>
                            </td>

                             <td>
                            <?php if($resultQuery['status'] =="CLOSED"){ echo "";}else{ ?>
                            <a style="font-size: 13px;" onclick="return confirm('Are you sure you want to declare this case as CLOSED ?')" href="process.php?cnum=<?php echo $resultQuery['com_ctrl']; ?>&from=complain&type=caseclose" class="badge btn-danger"><i class='fa fa-times'></i> Case Close</a>
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

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

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

</script>


    <script>
   $(document).ready(function() {
    $('#example').DataTable();
    } );
   </script>

<!-- jQuery -->
<script src="include/datetime/jquery.min.js"></script>
<!-- InputMask -->
<script src="include/datetime/moment.min.js"></script>
<!-- date-range-picker -->
<script src="include/datetime/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="include/datetime/tempusdominus-bootstrap-4.min.js"></script>

<script>
   $(function () { 
 <?Php 
  $sql1xx = "SELECT * FROM tbl_complaint where status !='NEW' and status !='DECLINE'  ";
  $processQuery1xx = $conn->query($sql1xx);
  while ($resultQueryxx = $processQuery1xx->fetch_assoc())
 { ?>
  //Date and time picker
  $('#reservationdatetime<?php echo $resultQueryxx['com_id'];?>').datetimepicker({ icons: { time: 'far fa-clock' } });
<?php } ?>

 })
</script>