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
                      Barangay Official
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
            <button class="tablinks" onclick="openCity(event, 'ab')" id="defaultOpen"><i class="fas fa-puzzle-piece"> </i> List of Jobs</button>
            <button class="tablinks" onclick="openCity(event, 'cd')"><i class=" fas fa-user-plus"></i> Add New Jobs</button>

          </div>
          <?php
           $style1 = "style='color:black;font-size: 13px;height:4px;' ";
           $style2 = "style='color:black;font-size: 12px;' ";
          ?>
          <div id="ab" class="tabcontent">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:13px;color:black;" >
                      <thead>
                        <tr>
                           <th <?php echo $style1; ?>><b></b></th>
                           <th <?php echo $style1; ?>><b>BARANGAY POSITION</b></th>
                           <th <?php echo $style1; ?>><b>OFFICIAL NAME</b></th>
                           <th></th>
                           <th></th>
                        </tr>
                      </thead>
                      <tbody>
               <?php    
                     //Code for displayed user in a table
                      $query = "SELECT distinct * FROM tbl_org order by org_id DESC";   
                      $result = mysqli_query($conn, $query);  
                      while($row = mysqli_fetch_array($result)) { ?>
                      <tr>
                          <td style="width:120px"> <img src= "<?php echo "../../img/brgy/".$row['org_pic']; ?>" style="width: 30%" ></td> 
                          <td style="width:100px"><?php echo $row["org_pos"]; ?></td>
                          <td style="width:120px"><?php echo $row["org_name"]; ?></td>
                          <td style="width:20px"><a href="" class="badge btn-success" >Accept</a></td>
                          <td style="width:20px"><a href="" class="badge btn-danger" >Delete</a></td>
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
        <form method="post"><br>
         <CENTER> <div class="row" style="width:70%">
              <div class="card" style="background-color:whitesmoke;width:90%;border-radius:12px;color:lightslategrey;">
                <div class="card-body">
               <div class="row mb-3">
                    <div class="col-lg-12">
                       <label for="hue-demo" style="float:left"><b>Job Title</b></label> 
                    <textarea  class="form-control demo" name="jobname"  rows="2"  placeholder="Type here..." autocomplete="off"required <?php echo $style1; ?>/></textarea> 
                    </div>
                  </div>
                <div class="row mb-3">
                   <div class="col-lg-12">
                       <label for="hue-demo" style="float:left"><b>Job Description</b></label> 
                    <textarea  class="form-control demo" name="jobdesc" rows="4" placeholder="Type here..." autocomplete="off"required <?php echo $style1; ?>/></textarea> 
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">

                   <table  style="width:110%" cellspacing="0"  id="dynamic_field">  
                      <tr> 
                        <td ><label for="psw"><b>Job Qualification</b></label><input  <?php echo $style1; ?>type="text" class="form-control input-sm" name="qualify[]" id="qualify[]" placeholder="..." autocomplete="off"  required>
                        </td>
                         <td><button type="button" class="badge btn-success"name="add" id="add" >+</button></td>  
                      </tr>
                      </table>
                  </div>
                
                    </div>
                     <div class="border-top">
                  <div class="card-body">
                    <button type="submit" class="btn btn-primary text-white" name="savejob"><i class="fas fa-save"></i> Save</button>
                    <a href="jobs.php" class="btn btn-danger text-white"> <i class="fas fa-arrow-alt-circle-left"></i>  Cancel </a>
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

if(isset($_POST['savejob'])){

  $sql1 = "SELECT num FROM tbl_increments WHERE type= 'job' ";
  $processQuery1 = $conn->query($sql1);
  while ($resultQuery = $processQuery1->fetch_assoc())
  { $num = $resultQuery['num'];}

$num1 = $num + 1;

if($num1 >=10){
  $nn = 3;
}else{
  $nn=3;
}

$n = str_pad($num1,$nn, '0', STR_PAD_LEFT);

$jobid = "JB-".$n;

$savejob = "INSERT INTO `tbl_job`(jobid,`job_title`, `job_details`, `posted_date`, `closed_date`, `status`) VALUES ('".$jobid."','".$_POST['jobname']."','".$_POST['jobdesc']."',CURDATE(),'','OPEN')";
 $updd = $conn->query($savejob);
 
 foreach ($_POST['qualify'] as $key => $value_dept) {
 $savejobdec = "INSERT INTO `tbl_jobquali`(`job_id`, `jobname`, `jqualify`)  VALUES ('".$jobid."','".$_POST['jobname']."','".$value_dept."')";
 $updddec = $conn->query($savejobdec);
}


if($updd){
  if($updddec){
    $upd_incre = "UPDATE `tbl_increments` SET num = num + 1 WHERE type = 'job' ";
       $upddinc = $conn->query($upd_incre);

?>
   <script>
            alert("You have successfully added a new job");
           window.location.replace("jobs.php");
       </script>

<?php  
 }
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


<script>
        /*datwpicker*/
      jQuery(".mydatepicker").datepicker();
      jQuery("#datepicker-autoclose").datepicker({
        autoclose: true,
        todayHighlight: true,
      });
      var quill = new Quill("#editor", {
        theme: "snow",
      });

</script>

  <!-- Dynamically add -->
  <script>  
 $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" class="form-control input-sm" name="qualify[]" id="qualify[]" placeholder="..." autocomplete="off" style="box-shadow: 1px 1px;" required></td><td><button type="button" name="remove" id="'+i+'" class="badge btn-danger btn_remove"><i class="fa  fa-times-circle"></i></button></td></tr>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
 
 });  
 </script>
