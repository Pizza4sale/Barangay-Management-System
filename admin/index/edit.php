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
           if($_GET['from'] =="account"){
           $query = "SELECT distinct * FROM tbl_user where user_id ='".$_GET['id']."' ";  
           $result = mysqli_query($conn, $query);  
           while($row = mysqli_fetch_array($result)) { ?>
      <center>
        <form method="post">
          <div class="row" style="width:60%">
              <div class="card">
                <div class="card-body" style="background-color:whitesmoke;width:100%;border-radius:12px;color:lightslategrey;">
                 <h4> - SYSTEM USER ACCOUNT - </h4><br>
               <div class="row mb-3">
                    <div class="col-lg-8">
                       <label for="hue-demo"style="float:left" ><b style="color: red" >*</b> Employee Name</label>
                       <input type="text" class="form-control demo" placeholder="Enter name" value="<?php echo $row['name']; ?>" name="empname" autocomplete="off" required />
                    </div>
                    <div class="col-lg-4">
                      <label for="hue-demo" style="float:left"><b style="color: red" >*</b> Employee Birthday</label> 
                    <input type="date"  class="form-control demo"   value="<?php echo $row['bday']; ?>"name="bday" autocomplete="off"required />
                  </div>
                  </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <label for="hue-demo" style="float:left"><b style="color: red" >*</b> Username</label>
                       <input type="text" class="form-control demo"  value="<?php echo $row['username']; ?>" placeholder="Enter username" id="uname" onkeyup="checkuname()"  name="uname" autocomplete="off" required  />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                      <label for="hue-demo" style="float:left"><b style="color: red" >*</b> Enter Password</label>
                      <input type="password" id="psw" class="form-control demo" name="psw" autocomplete="off" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                  </div>
                  <div class="col-lg-6">
                      <label for="hue-demo" style="float:left"><b style="color: red" >*</b> Re-Enter Password</label>
                     <input type="password" placeholder="Re-enter password"class="form-control demo" autocomplete="off" name="pass2" id="pass2" onkeyup="Validate()" required>
                     <p id="demo"></p>
                  </div>
                    </div>
                     <div class="border-top">
                  <div class="card-body">
                    <button type="submit" class="btn btn-primary text-white" name="signup"><i class="fas fa-save"></i> Update User</button>
                    <a href="newaccount.php" class="btn btn-danger text-white"><i class="fas fa-arrow-alt-circle-left"></i> Back </a>
                  </div>
                </div>

                  </div>
                </div>
            </div>
        </div>
      </FORM>
    <?php } 

if(isset($_POST['signup'])){
            $insert ="UPDATE `tbl_user` SET `username` = '".$_POST['uname']."', `password`='".$_POST['pass2']."', `name`='".$_POST['empname']."', `bday`='".$_POST['bday']."' WHERE user_id='".$_GET['id']."' ";
            $res = mysqli_query($conn, $insert);
            ?>
            <script>
                alert("Created user successfully!");
                  window.location.replace("newaccount.php");
            </script>
<?php  }  
  }elseif($_GET['from']=="news"){
           $style1 = "style='align:left' ";
           $style2 = "style='background-color:;font-size: 12px;' ";
           
           $query = "SELECT  * FROM tbl_brgy where brgy_id='".$_GET['id']."' "; 
           $result = mysqli_query($conn, $query);  
           while($row = mysqli_fetch_array($result)) { ?>
      <center>
        <form method="post"  enctype="multipart/form-data">
          <div class="row" style="width:90%">
                <div class="card-body" style="background-color:whitesmoke;width:100%;border-radius:12px;color:lightslategrey;">
                 <h4> - BARANGAY UPDATES - </h4><br><BR>
               <div class="row mb-3">
                 <div class="col-lg-6">
                      <label for="hue-demo" style="float:left"><small><b>Barangay Title</b></small></label> 
                       <input type="hidden" class="form-control demo"  value="<?php echo $row['brgy_id']; ?>" name="id"  />
                        <input type="hidden" class="form-control demo"  value="news" name="from"  />
                    <textarea  class="form-control demo" name="detail2" rows="6" autocomplete="off"required /><?php echo $row['brgy_title']; ?></textarea> 
                  </div>
                    <div class="col-lg-6">
                       <label for="hue-demo"style="float:left" ><small><b>Barangay Details</b></small></label>
                       <textarea class="form-control demo" name="detail" rows="6" autocomplete="off"required /><?php echo $row['brgy_details']; ?></textarea> 
                    </div>
                  </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <label for="hue-demo" style="float:left"><small><b>Upload Image (only if applicable jpg,png) </b></small></label>
                       <input type="file" class="form-control demo"   name="uploadfile"  /><BR>
                       <img src= "<?php echo "img/".$row['news_img']; ?>" style="width: 50%" >
            
                    </div>
                    <div class="col-lg-6">
                        <div class="border-top">
                  <div class="card-body">
                    <button type="submit" style="width: 30%" class="btn btn-primary text-white" name="upload"><i class="fas fa-save"></i>   Save</button>
                    <a href="news.php" style="width: 30%" class="btn btn-danger text-white"><i class="fas fa-arrow-alt-circle-left"></i> Back </a>
                  </div>
                </div>
                    </div>
                </div>
                  </div>
                </div>
            </div>
        </div>
      </FORM>
    <?php } } elseif($_GET['from']=="job"){
           $style1 = "style='align:left' ";
           $style2 = "style='background-color:;font-size: 12px;' ";
           
          $query = "SELECT  * FROM tbl_job where jobid='".$_GET['id']."' ";  
           $result = mysqli_query($conn, $query);  
           while($row = mysqli_fetch_array($result)) { ?>
      <center>
        <form method="post"  enctype="multipart/form-data">
          <div class="row" style="width:90%">
              <div class="card">     <span class="label success">Success</span>
                <div class="card-body" style="background-color:#ebebeb;color:#4d4d4d">

               <div class="row mb-3">
                 <div class="col-lg-5">
                      <label for="hue-demo" style="float:left"><b>Job Title</b></label> 
                       <input type="hidden" class="form-control demo"  value="<?php echo $row['jobid']; ?>" name="id"  />
                        <input type="hidden" class="form-control demo"  value="news" name="from"  />
                    <input type="text" class="form-control demo" name="detail2" value="<?php echo $row['job_title']  ?>"autocomplete="off" readonly />
                    <label for="hue-demo"style="float:left" ><b>Job Description</b></label>
                       <textarea class="form-control demo" name="jobdesc" rows="6" autocomplete="off"required /><?php echo $row['job_details']  ?></textarea> 
                        <div class="border-top">
                      <div class="card-body">
                        <button type="submit" style="width: 30%" class="btn btn-primary text-white" name="upd"><i class="fas fa-save"></i>  Save</button>
                        <a href="jobs.php" style="width: 30%" class="btn btn-danger text-white"><i class="fas fa-arrow-alt-circle-left"></i> Back </a>
                      </div>
                    </div>
                  </div>
                    <div class="col-lg-7">
                       <label for="hue-demo"style="float:left" ><b>Job Qualification</b></label>
               <?php    
                      $query = "SELECT  * FROM `tbl_jobquali` where job_id='".$_GET['id']."'";  
                      $result = mysqli_query($conn, $query);  
                      while($row = mysqli_fetch_array($result))  
                       {   ?>
                        <textarea name="jqua[]" style="width:80%" rows="1" ><?php echo $row['jqualify'] ; ?></textarea>
                        <textarea name="jd[]" style="width:100%" rows="1" hidden><?php echo $row['q_id'] ; ?></textarea>
                        <a href="delete.php?id=<?php echo $row['q_id'];?>&from=job&type=removejob" style="color:white" class="btn-danger badge" >X</a>
                     <?php } ?>
                      <table  style="width:90%" cellspacing="0"  id="dynamic_field">  
                      <tr> 
                        <td ><label for="psw"><b>Add new qualification</b></label><input  <?php echo $style1; ?>type="text" class="form-control input-sm" name="qualify[]" id="qualify[]" placeholder="..." autocomplete="off"  >
                        </td>
                         <td><button type="button" class="badge btn-success" name="add" id="add" ><i class="fa  fa-check-circle"></i></button></td>  
                      </tr>
                      </table>
                    </div>
                  </div>
                  </div>
                </div>
            </div>
        </div>
      </FORM>
    <?php } } ?>
       </div>
        <!-- ============================================================== -->
<?php 
    include'include/conn.php'; 
    date_default_timezone_set('Asia/Manila');
    $dat= date('Y-m-d H:i:s');

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
     $filename = $_FILES["uploadfile"]["name"];
     $det= $_POST['detail'];
     $title= $_POST['detail2'];
     $id=$_POST['id'];

     
if( $filename !=""){
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
    $folder = "img/".$filename;
    
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
  if (!in_array($extension, ['jpg'])) { 
    ?>
        <script>
           alert("Your uploaded file is not an image. It only accept .jpg extension.")
       </script>
    <?php  
  }else{

        $sql = "UPDATE tbl_brgy SET news_img ='".$filename."',`brgy_title`='".$title."',`brgy_details`='".$det."',`posted_date`='".$dat."' WHERE brgy_id='".$_GET['id']."' ";
        mysqli_query($conn, $sql);
          
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder))  {
           ?>
           <script>
                alert("Successfully updated the barangay news update!");
                window.location.replace("edit.php?id=<?Php echo $id; ?>&from=news");
            </script>
            <?php
        }else{
            $msg = "Failed to upload image";
      }
    }
  }else{
    $sql = "UPDATE tbl_brgy SET brgy_details='".$det."', brgy_title='".$title."',posted_date ='".$dat."' WHERE brgy_id='".$_GET['id']."' ";
   mysqli_query($conn, $sql);
  ?>
            <script>
                alert(" 1uccessfully updated the barangay news update!");
                window.location.replace("edit.php?id=<?Php echo $id; ?>&from=news");
            </script>
            <?php
  }  }

    if(isset($_POST['signup'])){
    
            $insert ="UPDATE `tbl_user` SET `username` = '".$_POST['uname']."', `password`='".$_POST['pass2']."', `name`='".$_POST['empname']."', `bday`='".$_POST['bday']."' WHERE user_id='".$_GET['id']."' ";
            $res = mysqli_query($conn, $insert);
            ?>
            <script>
                alert("Created user successfully!");
                  window.location.replace("newaccount.php");
            </script>
<?php  } 


if(isset($_POST['upd'])){

$savejob = "UPDATE `tbl_job` SET job_details='".$_POST['jobdesc']."' WHERE jobid='".$_POST['id']."' ";
 $updd = $conn->query($savejob);
 
$jd= count($_POST["jd"]);   
    if($jd > 0) {  
    for($i=0; $i<$jd; $i++) {  
      if(trim($_POST["jd"][$i] != ''))  {
        
        $jdd= mysqli_real_escape_string($conn, $_POST["jd"][$i]);
        $jqq=mysqli_real_escape_string($conn, $_POST["jqua"][$i]);

      if($jqq !=""){
          $savejobdec = "UPDATE `tbl_jobquali` SET jqualify='".$jqq."' WHERE q_id='".$jdd."' and job_id='".$_POST['id']."' ";
          $updddec = $conn->query($savejobdec);
       }else{

          $del2 = "DELETE FROM `tbl_jobquali` where  q_id='".$jdd."' and job_id='".$_POST['id']."' ";
          $del2 = $conn->query($del2);
       }

  }
}
}

$query = "SELECT distinct * FROM tbl_job where jobid='".$_POST['id']."'";  
$result = mysqli_query($conn, $query);  
while($row = mysqli_fetch_array($result))  
 {  $name= $row['job_title']; }

 foreach ($_POST['qualify'] as $key => $value_dept) {
   if($value_dept !=""){
 $savejobdec = "INSERT INTO `tbl_jobquali`(`job_id`, `jobname`, `jqualify`)  VALUES ('".$_POST['id']."','".$name."','".$value_dept."')";
 $updddec = $conn->query($savejobdec);
}
}

if($updd){
  if($updddec){
?>
   <script>
            alert("You have successfully added a new job");
           window.location.replace("edit.php?id=<?Php echo $_POST['id']; ?>&from=job");
       </script>

<?php    } } }  ?>

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
