<?php 
include 'include/conn.php';
session_start();
if(!isset($_SESSION["userpos"]))
header("location:index.php");

date_default_timezone_set('Asia/Manila');
$dat= date('Y-m-d H:i:s');

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
<style>
.chip {
  display: inline-block;
  padding: 0 25px;
  height: 50px;
  font-size: 16px;
  line-height: 50px;
  border-radius: 25px;
  background-color: #f1f1f1;
}

.chip img {
  float: left;
  margin: 0 10px 0 -25px;
  height: 50px;
  width: 50px;
  border-radius: 50%;
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
    
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <?php if($_SESSION["userpos"] =='ADMIN02'){ ?>
                    <li class="breadcrumb-item"><a href="dashboard02.php">Home</a></li>
                    <?php }else{ ?>
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <?php } ?>
                    <li class="breadcrumb-item active" aria-current="page">
                    Edit page
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
   <?php
           $style1 = "style='align:left;box-shadow: 1px 1px;'  ";
           $style2 = "style='background-color:;font-size: 12px;' ";
  
     //start of portfolio

      if($_GET['from'] =="port"){ ?>
      <center>
        <form method="post" enctype="multipart/form-data" >
          <div class="row" style="width:60%">
              <div class="card">
                <div class="card-body" style="background-color:whitesmoke;width:100%;border-radius:12px;color:lightslategrey;">
                 <h4> - Barangay Portfolio - </h4><br>
                 <div class="row mb-3">
                    <div class="col-lg-12">
                         <label for="hue-demo" style="float:left">Upload Image <small>(jpg,jpeg,png,JPG,PNG,JPEG)</small></label> 
                        <input type="file" class="form-control demo" name='imgup' autocomplete="off" required />
                    </div>
                </div>
               
                     <div class="border-top">
                  <div class="card-body">
                    <button type="submit" class="btn btn-primary text-white" name="updpic"><i class="fas fa-save"></i> Upload Picture</button>
                    <a href="updateportfolio.php" class="btn btn-danger text-white"><i class="fas fa-arrow-alt-circle-left"></i>  Cancel </a>
                  </div>
                </div>

                  </div>
                </div>
            </div>
        </div>
      </FORM>
    <?php 

    if(isset($_POST['updpic'])){

        // If upload button is clicked ...

           $imgg = $_FILES['imgup']["name"];
           
         if( $imgg !=""){

          $tempnamez = $_FILES['imgup']["tmp_name"];
          $folderz = "../../img/brgy/".$imgg;
          
          $extensionz = pathinfo($imgg, PATHINFO_EXTENSION);
        if (!in_array($extensionz, ['jpg','jpeg','JPG','png','PNG','JPEG'])) { 
          ?>
              <script>
                 alert("Your uploaded file is not an image. It only accept .jpg extension.")
             </script>
          <?php  
        }else{

              // Now let's move the uploaded image into the folder: image
              if (move_uploaded_file($tempnamez, $folderz))  {

                 $sqlx = "INSERT INTO `tbl_portfolio`(`img_port`) VALUES('".$imgg."')";
                 mysqli_query($conn, $sqlx);
                 ?>
                  <script>
                      alert("Successfully added!");
                      window.location.replace("addportfolio.php?from=port");
                  </script>
                  <?php
              }else{
                  $msg = "Failed to upload image";
            }
          }
        }
      }
}
?>
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


<script type="text/javascript">
    function Validate() {
        var password = document.getElementById("psw").value;
        var confirmPassword = document.getElementById("pass2").value;
        if (password != confirmPassword) {
           document.getElementById("demo").innerHTML = "<p style='color:red'><strong>Password don't match!</strong></p>"
        }else{
             document.getElementById("demo").innerHTML = "<p style='color:green'><strong>Password match!</strong></p>"
        }

    }
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
