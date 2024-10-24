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
      
      if($_GET['from'] =="org"){ ?>
      <center>
        <form method="post" enctype="multipart/form-data" >
          <div class="row" style="width:60%">
              <div class="card">
                <div class="card-body" style="background-color:whitesmoke;width:100%;border-radius:12px;color:lightslategrey;">
                 <h4> - Barangay Official Details - </h4><br>
                  <div class="row mb-3">
                    <div class="col-lg-7">
                       <label for="hue-demo"style="float:left" >Official's Name</label>
                       <input type="text" class="form-control demo" placeholder="Enter name" name="name" autocomplete="off" required />
                    </div>
                    <div class="col-lg-5">
                      <label for="hue-demo" style="float:left">Official's Position</label> 
                      <select  class="form-control demo" name='pos'>
                      <?php 
                          $query = "SELECT * FROM tbl_org group by org_pos ";  
                          $result = mysqli_query($conn, $query);  
                          while($row = mysqli_fetch_array($result)) { ?>

                         <option ><?php echo $row['org_pos']; ?></option>
                       <?php } ?>
                      </select>
                  </div>
                  </div>
                 <div class="row mb-3">
                    <div class="col-lg-12">
                         <label for="hue-demo" style="float:left">Upload New Picture</label> 
                       <input type="file" class="form-control demo" name="pictureorg" autocomplete="off" required  />
                    </div>
                </div>
                     <div class="border-top">
                  <div class="card-body">
                    <button type="submit" class="btn btn-primary text-white" name="upd1"><i class="fas fa-save"></i>Save Details</button>
                    <a href="updatebrgy.php" class="btn btn-danger text-white"><i class="fas fa-arrow-alt-circle-left"></i>  Cancel </a>
                  </div>
                </div>

                  </div>
                </div>
            </div>
        </div>
      </FORM>
    <?php 

    if(isset($_POST['upd1'])){

        // If upload button is clicked ...

           $filename = $_FILES["pictureorg"]["name"];
           $orgname= $_POST['name'];
           $orgpos= $_POST['pos'];

           
      if( $filename !=""){
          $tempname = $_FILES["pictureorg"]["tmp_name"];    
          $folder = "../../img/brgy/".$filename;
          
          $extension = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($extension, ['jpg','JPG','png','PNG','JPEG'])) { 
          ?>
              <script>
                 alert("Your uploaded file is not an image. It only accept .jpg extension.")
             </script>
          <?php  
        }else{

             $sql = "INSERT INTO `tbl_org`( `org_pos`, `org_name`, `org_pic`, `date_added`) VALUES ('".$orgpos."','".$orgname."','".$filename."','".$dat."');";
              mysqli_query($conn, $sql);
                
              // Now let's move the uploaded image into the folder: image
              if (move_uploaded_file($tempname, $folder))  {
                 ?>
                <script>
                       alert("Successfully added!");
                      window.location.replace("addwebsite.php?from=org");
                  </script>
                  <?php
              }else{
                  $msg = "Failed to upload image";
            }
          }
        }else{
         $sql = "INSERT INTO `tbl_org`( `org_pos`, `org_name`, `org_pic`, `date_added`) VALUES ('".$orgpos."','".$orgname."','','".$dat."');";
              mysqli_query($conn, $sql);
        ?>
                  <script>
                       alert("Successfully added!");
                      window.location.replace("addwebsite.php?from=org");
                  </script>
                  <?php
       } 
     } 
     }// end of official details edit 
     


    //add faq websitw
      if($_GET['from'] =="faq"){ ?>
      <center>
        <form method="post" enctype="multipart/form-data" >
          <div class="row" style="width:60%">
              <div class="card">
                <div class="card-body" style="background-color:whitesmoke;width:100%;border-radius:12px;color:lightslategrey;">
                 <h4> - Barangay FAQ's Details - </h4><br>
                 <div class="row mb-3">
                    <div class="col-lg-12">
                         <label for="hue-demo" style="float:left">Question</label> 
                        <input type="text" class="form-control demo" placeholder="Enter question" name="question" autocomplete="off" required />
                    </div>
                </div>
               <div class="row mb-3">
                    <div class="col-lg-12">
                       <label for="hue-demo"style="float:left" >Answer</label>
                       <textarea class="form-control demo" name="answer" rows='5'  placeholder="Enter answer"></textarea>
                       <input type="hidden" class="form-control demo" placeholder="Enter name" name="idd" autocomplete="off" required />
                    </div>
                  </div>
               
                     <div class="border-top">
                  <div class="card-body">
                    <button type="submit" class="btn btn-primary text-white" name="upd2"><i class="fas fa-save"></i> Save Details</button>
                    <a href="updatefaq.php" class="btn btn-danger text-white"><i class="fas fa-arrow-alt-circle-left"></i>  Cancel </a>
                  </div>
                </div>

                  </div>
                </div>
            </div>
        </div>
      </FORM>
    <?php 

    if(isset($_POST['upd2'])){

        // If upload button is clicked ...

           $question= $_POST['question'];
           $answer= $_POST['answer'];
           $faqid= $_POST['idd'];

           
    
         $sql = "INSERT INTO `tbl_faq`(`purpose`, `question`, `answer`, `date_added`) VALUES('faq','".$question."','".$answer."','".$dat."'); ";
         mysqli_query($conn, $sql);
        ?>
                  <script>
                      alert("Successfully added!");
                      window.location.replace("addwebsite.php?from=faq");
                  </script>
                  <?php
       } 

     }  // end of official details edit 
     




     //add faq website 
    if($_GET['from'] =="pay"){ ?>
      <center>
        <form method="post" enctype="multipart/form-data" >
          <div class="row" style="width:60%">
              <div class="card">
                <div class="card-body" style="background-color:whitesmoke;width:100%;border-radius:12px;color:lightslategrey;">
                 <h4> - Barangay Payments - </h4><br>
                 <div class="row mb-3">
                    <div class="col-lg-12">
                         <label for="hue-demo" style="float:left">Question</label> 
                        <input type="text" class="form-control demo" placeholder="Enter question" name="question" autocomplete="off" required />
                    </div>
                </div>
               <div class="row mb-3">
                    <div class="col-lg-12">
                       <label for="hue-demo"style="float:left" >Answer</label>
                       <textarea class="form-control demo" name="answer" rows='5'  placeholder="Enter answer" ></textarea>
                       <input type="hidden" class="form-control demo" placeholder="Enter name" name="idd" autocomplete="off" required />
                    </div>
                  </div>
               
                     <div class="border-top">
                  <div class="card-body">
                    <button type="submit" class="btn btn-primary text-white" name="upd2"><i class="fas fa-save"></i> Save Details</button>
                    <a href="updatefaq.php" class="btn btn-danger text-white"><i class="fas fa-arrow-alt-circle-left"></i>  Cancel </a>
                  </div>
                </div>

                  </div>
                </div>
            </div>
        </div>
      </FORM>
    <?php 

    if(isset($_POST['upd2'])){

        // If upload button is clicked ...

           $question= $_POST['question'];
           $answer= $_POST['answer'];
           $faqid= $_POST['idd'];

           
    
         $sql = "INSERT INTO `tbl_faq`(`purpose`, `question`, `answer`, `date_added`) VALUES('faq','".$question."','".$answer."','".$dat."'); ";
         mysqli_query($conn, $sql);
        ?>
                  <script>
                      alert("Successfully added!");
                      window.location.replace("addwebsite.php?from=faq");
                  </script>
                  <?php
       } 

     }  // end of official details edit 
     
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
