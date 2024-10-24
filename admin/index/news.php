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
                      Webiste News / Info
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
            <button class="tablinks" onclick="openCity(event, 'ab')" style="width:30%" id="defaultOpen"><i class="fas fa-sync-alt"></i> Barangay Updates</button>
            <button class="tablinks" onclick="openCity(event, 'cd')" style="width:30%"> <i class="fab fa-chrome"></i> Add New Updates</button>

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
                           <th></th>
                           <th <?php echo $style1; ?>><b>DATE</b></th>
                           <th <?php echo $style1; ?>><b>TITLE</b></th>
                           <th <?php echo $style1; ?>><b>DETAILS</b></th>
                           <th <?php echo $style1; ?>><b>STATUS</b></th>
                           <th <?php echo $style1; ?>><b></b></th>
                           <th></th>
                        </tr>
                      </thead>
                      <tbody>
               <?php    
                     //Code for displayed user in a table
                      $query = "SELECT  * FROM tbl_brgy order by brgy_id ";  
                      $result = mysqli_query($conn, $query);  
                      while($row = mysqli_fetch_array($result)) { ?>
                      <tr>
                          <td ><i style="color: red" class="fas fa-star"></i></td>
                          <td style="width:100px"><?php echo $row["posted_date"]; ?></td>
                          <td style="width:250px"><?php echo substr($row["brgy_title"],0,25)."..."; ?></td>
                          <td style="width:300px"><?php echo substr($row["brgy_details"],0,25)."..."; ?></td>
                          <td><?php echo $row["status"]; ?></td>
                          <td style="width:5%"><a style="font-size: 13px;" href="edit.php?id=<?php echo $row["brgy_id"]; ?>&from=news" class="badge btn-success"><i class="fas fa-edit"></i> Edit</a></td>
                          <td style="width:5%">
                          <a onclick="return confirm('Are you sure you want to delete this barangay update? ')" style="font-size: 13px;" href="delete.php?id=<?php echo $row["brgy_id"]; ?>&from=news" class="badge btn-danger"><i class="fas fa-trash"></i>  Delete</a>
                    
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
<br>
         <form method="post"  enctype="multipart/form-data">
         <CENTER> <div class="row" style="width:70%">
              <div class="card" style="background-color:whitesmoke;width:90%;border-radius:12px;color:lightslategrey;">
                <div class="card-body">
               <div class="row mb-3">
                    <div class="col-lg-12">
                       <label for="hue-demo" style="float:left"><b>Barangay Title</b></label> 
                    <textarea  class="form-control demo" name="title" rows="2" placeholder="Type here..." autocomplete="off"required <?php echo $style1; ?>/></textarea> 
                    </div>
                  </div>
                <div class="row mb-3">
                   <div class="col-lg-12">
                       <label for="hue-demo" style="float:left"><b>Barangay Details</b></label> 
                    <textarea  class="form-control demo" name="detail" rows="4" placeholder="Type here..." autocomplete="off"required <?php echo $style1; ?>/></textarea> 
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                   <label for="hue-demo" style="float:left"><b>Upload Image <small>('jpg','jpeg','png','JPG','JPEG','PNG') (only if applicable)</small></b></label>
                    <input type="file" class="form-control demo"   name="uploadfile"   <?php echo $style1; ?> />
                  </div>
                
                    </div>
                     <div class="border-top">
                  <div class="card-body">
                    <button type="submit" class="btn btn-primary text-white" name="addnews"> <i class="fas fa-save"></i> Save</button>
                    <a href="news.php" class="btn btn-danger text-white"><i class="fas fa-arrow-alt-circle-left"></i>   Cancel </a>
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

    if(isset($_POST['addnews'])){
    
     $filename = $_FILES["uploadfile"]["name"];

if( $filename !=""){
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
    $folder = "img/".$filename;
    
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
  if (!in_array($extension, ['jpg','jpeg','png','JPG','JPEG','PNG'])) { 
    ?>
        <script>
           alert("Your uploaded file is not an image. It only accept 'jpg','jpeg','png' extension.")
       </script>
    <?php  
  }else{

     if (move_uploaded_file($tempname, $folder))  {

           $insert ="INSERT INTO `tbl_brgy`( `brgy_title`, `brgy_details`, `posted_date`, `news_img`, `status`) VALUES ('".$_POST['title']."', '".$_POST['detail']."','".$dat."','".$filename."','OPEN')";
            $res = mysqli_query($conn, $insert);
            ?>
            <script>
                 alert("Successfully added the barangay update!");
                 window.location.replace("news.php");
            </script>
<?php  }else{  $msg = "Failed to upload image";

      } }  }else{

         $insert ="INSERT INTO `tbl_brgy`( `brgy_title`, `brgy_details`, `posted_date`, `status`) VALUES ('".$_POST['title']."', '".$_POST['detail']."','".$dat."','".$dat."','OPEN')";
            $res = mysqli_query($conn, $insert);
            ?>
            <script>
                alert("Successfully added the barangay update!");
                 window.location.replace("news.php");
            </script>
<?Php  } }?>
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

