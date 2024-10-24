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
          <?php include 'include/navbar.php'; ?>
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
                      User Accounts
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
            <button class="tablinks" onclick="openCity(event, 'ab')" style="width:30%" id="defaultOpen"><i class=" fas fa-users"></i> System Account</button>
            <button class="tablinks" onclick="openCity(event, 'cd')" style="width:30%" ><i class=" fas fa-user-plus"></i> Add New Account</button>

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
                    <table id="example" class="table display" style="font-size:13px;color:black" >
                      <thead>
                        <tr>
                           <th></th>
                           <th <?php echo $style1; ?>><b>NAME</b></th>
                           <th <?php echo $style1; ?>><b>POSITION</b></th>
                           <th <?php echo $style1; ?>><b>BIRTHDAY</b></th>
                           <th <?php echo $style1; ?>><b>USERNAME</b></th>
                           <th <?php echo $style1; ?>><b>DATE REGISTERED</b></th>
                           <th></th>
                           <th></th>
                        </tr>
                      </thead>
                      <tbody>
               <?php    
                     //Code for displayed user in a table
                      $query = "SELECT distinct * FROM tbl_user where position != 'USER' order by user_id ";  
                      $result = mysqli_query($conn, $query);  
                      while($row = mysqli_fetch_array($result)) { ?>
                      <tr>
                          <td><i style="color: red" class="fas fa-star"></i></td>
                          <td><?php echo $row["name"]; ?></td>
                          <td><?php echo $row["position"] ?></td>
                          <td><?php echo $row["bday"]; ?></td>
                          <td><?php echo $row["username"]; ?></td>
                           <td><?php echo $row["datereq"]; ?></td>
                          <td style="width:5%">
                              <a style="font-size: 13px;" href="edit.php?id=<?php echo $row["user_id"]; ?>&from=account" class="badge btn-success"><i class="fas fa-edit"></i> Edit </a>
                          </td>
                          <td style="width:5%">
                          <a onclick="return confirm('Are you sure you want to his/her account <?php echo $row["name"]; ?> ? ')" style="font-size: 13px;" href="delete.php?id=<?php echo $row["user_id"]; ?>&from=account" class="badge btn-danger"><i class="fas fa-user-times"></i> Delete</a>
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
             <div class="card" >
        <form method="post"><br>
         <CENTER> <div class="row" style="width:70%">
              <div class="card" style="background-color:whitesmoke;width:90%;border-radius:12px;color:lightslategrey;">
                 
                <div class="card-body">
               <div class="row mb-3">
                    <div class="col-lg-8">
                       <label for="hue-demo"style="float:left;" ><b style="color:red">*</b> Employee Name</label>
                       <input type="text" class="form-control demo" placeholder="Enter Name" name="empname" autocomplete="off" required <?php echo $style1; ?>  />
                    </div>
                    <div class="col-lg-4">
                      <label for="hue-demo" style="float:left"><b style="color: red" >*</b> Employee Birthday</label>
                    <input type="date"  class="form-control demo"  name="bday" autocomplete="off" required <?php echo $style1; ?> />
                  </div>
               </div>
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <label for="hue-demo" style="float:left"><b style="color: red" >*</b> Username</label>
                       <input type="text" class="form-control demo" placeholder="Enter username" id="uname" onkeyup="checkuname()"  name="uname" autocomplete="off" required  <?php echo $style1; ?> />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-6">
                      <label for="hue-demo" style="float:left"><b style="color: red" >*</b> Enter Password</label>
                      <input type="password" <?php echo $style1; ?> id="psw" class="form-control demo" autocomplete="off" name="psw"  required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"  placeholder="Enter password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                  </div>
                  <div class="col-lg-6">
                      <label for="hue-demo" style="float:left"><b style="color: red" >*</b> Re-Enter Password</label>
                     <input type="password" <?php echo $style1; ?> placeholder="Re-enter password"class="form-control demo" autocomplete="off" name="pass2" id="pass2" onkeyup="Validate()" required>
                     <p id="demo"></p>
                  </div>
                    </div>
                     <div class="border-top">
                  <div class="card-body">
                    <button type="submit" class="btn btn-primary text-white" name="signup"> <i class="fas fa-save"></i> Save User </button>
                    <a href="newaccount.php" class="btn btn-danger text-white"><i class="fas fa-arrow-alt-circle-left"></i> Cancel </a>
                  </div>
                </div>

                  </div>
                </div>
            </div>
        </div>
      </FORM>

      <?php

    if(isset($_POST['signup'])){
      $query2 = "SELECT * FROM tbl_user where username='".$_POST['uname']."' ";  
      $result2 = mysqli_query($conn, $query2);  
      $row2 = mysqli_num_rows($result2);
    
     if($row2 !=0) { ?>
            <script>
                alert("Username already existed. Please choose other username");
           </script>
    <?php
        }else{
            $pass22 = md5(trim($_POST['pass2']));
            $insert ="INSERT INTO `tbl_user`( `username`, `password`, `name`, `position`, `bday`, `datereq`, `timereq`) 
            VALUES ('".$_POST['uname']."', '".$pass22."','".$_POST['empname']."','ADMIN','".$_POST['bday']."',CURDATE(),CURTIME())";
            $res = mysqli_query($conn, $insert);
            ?>
            <script>
                alert("Created user successfully!");
                 window.location.replace("newaccount.php");
            </script>
<?php  }  } ?>
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


<script type="text/javascript">
    function Validate() {
        var password = document.getElementById("psw").value;
        var confirmPassword = document.getElementById("pass2").value;
       if (password != confirmPassword) {
           document.getElementById("demo").innerHTML = "<p style='color:red;font-size:10px'><strong>Password don't match!</strong></p>"
        }else{
             document.getElementById("demo").innerHTML = "<p style='color:lightgreen;font-size:10px'><strong>Password match!</strong></p>"
        }

    }
</script>
