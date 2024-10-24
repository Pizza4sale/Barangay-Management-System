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
                      Resident Records
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
            <button class="tablinks" onclick="openCity(event, 'ab')" style="width:30%"id="defaultOpen"><i class=" fas fa-users"></i> New Resident</button>
            <button class="tablinks" onclick="openCity(event, 'cd')" style="width:30%"><i class=" fas fa-user-plus"></i> Add New Resident</button>

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
                           <th <?php echo $style1; ?>><b>ID</b></th>
                           <th <?php echo $style1; ?>><b>Residents Name</b></th>
                           <th <?php echo $style1; ?>><b>Birthday</b></th>
                           <th <?php echo $style1; ?>><b>Civil Status</b></th>
                           <th <?php echo $style1; ?>><b>Address</b></th>
                           <th <?php echo $style1; ?>><b>Voter Status</b></th>
                           <th <?php echo $style1; ?>><b>Contact No.</b></th>
                           <th></th>
                           <th></th>
                        </tr>
                      </thead>
                      <tbody>
               <?php    
                     //Code for displayed user in a table
                      $query = "SELECT * FROM tbl_resident ";  
                      $result = mysqli_query($conn, $query);  
                      while($row = mysqli_fetch_array($result)) { ?>
                      <tr>
                          <td><?php echo $row["id"]; ?></td>
                          <td><?php echo $row["lname"].", ".$row["fname"]." ".$row["mname"]; ?></td>
                          <td><?php echo $row["bday"]; ?></td>
                          <td><?php echo $row["civilstat"]; ?></td>
                          <td><?php echo $row["purok"]." ".$row["brgy"]." ".$row["city"]." ".$row["country"]; ?></td>
                          <td><?php echo $row["voter"]; ?></td>
                          <td><?php echo $row["contact"]; ?></td>
                          <td style="width:5%">
                              <a style="font-size: 13px;" href="editresident.php?id=<?php echo $row["id"]; ?>" class="badge btn-success"><i class="fas fa-edit"></i> Edit </a>
                               <a onclick="return confirm('Are you sure you want to this resident?')" style="font-size: 13px;" href="delete.php?id=<?php echo $row["id"]; ?>&from=resi" class="badge btn-danger"><i class="fas fa-user-times"></i> Delete</a>
                          </td>
                          <td style="width:5%">
                            <?php  if($_SESSION['userpos']!='ADMIN02'){ ?>
                               <a style="font-size: 13px;" href="select_transaction.php?id=<?php echo $row["id"]; ?>" class="badge btn-warning"><i class="fas fa-edit"></i> Transact </a>
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
             <div class="card" >
        <form method="post"><br>
         <CENTER> <div class="row" >
              <div class="card" style="background-color:whitesmoke;width:100%;border-radius:12px;color:lightslategrey;">
                 
                <div class="card-body">
               <div class="row mb-4">
                    <div class="col-lg-4">
                       <label for="hue-demo"style="float:left;" ><b style="color:red">*</b>First Name</label>
                       <input type="text" class="form-control demo" placeholder="..." name="fname" autocomplete="off" required <?php echo $style1; ?>  />
                    </div>
                    <div class="col-lg-4">
                       <label for="hue-demo"style="float:left;" ><b style="color:red"></b>Middle Name</label>
                       <input type="text" class="form-control demo" placeholder="..." name="mname" autocomplete="off" <?php echo $style1; ?>  />
                    </div>
                     <div class="col-lg-4">
                       <label for="hue-demo"style="float:left;" ><b style="color:red"></b>Last Name</label>
                       <input type="text" class="form-control demo" placeholder="..." name="lname" autocomplete="off" <?php echo $style1; ?>  />
                    </div>
               </div>
                <div class="row mb-3">
                  <div class="col-lg-4">
                      <label for="hue-demo" style="float:left"><b style="color: red" >*</b>Birthday</label>
                    <input type="date"  class="form-control demo"  name="bday" autocomplete="off" required <?php echo $style1; ?> />
                  </div>
                  <div class="col-lg-4">
                       <label for="hue-demo"style="float:left;" ><b style="color:red">*</b>Birth Place</label>
                       <input type="text" class="form-control demo" placeholder="..." name="bplace" autocomplete="off" required <?php echo $style1; ?>  />
                    </div>
                    <div class="col-lg-4">
                        <label for="hue-demo" style="float:left"><b style="color: red" >*</b>Civil Status</label>
                       <select name="civil"  class="form-control demo" required <?php echo $style1; ?>>
                        <option selected disabled></option>
                          <option value="Single">- Single</option>
                          <option value="Married">- Married</option>
                          <option value="Widowed">- Widowed</option>
                        </select>
                    </div>
                </div>
                 <div class="row mb-4">
                    <div class="col-lg-4">
                       <label for="hue-demo"style="float:left;" ><b style="color:red">*</b>Voter Status</label>
                        <select name="voter"  class="form-control demo" required <?php echo $style1; ?>>
                          <option selected disabled></option>
                          <option value="Registered Voter">- Registered Voter</option>
                          <option value="Not Registered Voter">- Not Registered Voter</option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                       <label for="hue-demo"style="float:left;" ><b style="color:red">*</b>Contact Number</label>
                        <input type="text" name="phone" class="form-control phone-inputmask" placeholder="0" autocomplete="off" required <?php echo $style1; ?>>
                    </div>
                     <div class="col-lg-4">
                       <label for="hue-demo"style="float:left;" ><b style="color:red">*</b>Gender</label>
                      <select name="gender"  class="form-control demo" required <?php echo $style1; ?>>
                          <option selected disabled></option>
                          <option value="Female">- Female</option>
                          <option value="Male">- Male</option>
                        </select>
                    </div>
               </div>
                <div class="row mb-4">
                    <div class="col-lg-4">
                       <label for="hue-demo"style="float:left;" ><b style="color:red">*</b>Occupation</label>
                        <input type="text" name="occu" class="form-control demo" placeholder="..." autocomplete="off" required <?php echo $style1; ?>>
                    </div>
                     <div class="col-lg-4">
                        <label for="hue-demo"style="float:left;" ><b style="color:red">*</b>Citizenship</label>
                        <input type="text" name="citizen" class="form-control demo" value="Filipino"  placeholder="..." autocomplete="off" required <?php echo $style1; ?>>
                    </div>
               </div>
                <div class="row mb-3">
                   <div class="col-lg-2">
                       <label for="hue-demo"style="float:left;" ><b style="color:red">*</b>Purok</label>
                       <input type="text" class="form-control demo" placeholder="..." name="purok" value="Purok" autocomplete="off" required <?php echo $style1; ?>  />
                    </div>
                    <div class="col-lg-2">
                       <label for="hue-demo"style="float:left;" ><b style="color:red"></b>Barangay</label>
                       <input type="text" class="form-control demo" placeholder="..." name="brgy" value="Milawid" autocomplete="off" <?php echo $style1; ?>  />
                    </div>
                     <div class="col-lg-4">
                       <label for="hue-demo"style="float:left;" ><b style="color:red"></b>City</label>
                       <input type="text" class="form-control demo" placeholder="..." name="city" value="Panukulan" autocomplete="off" <?php echo $style1; ?>  />
                    </div>
                    <div class="col-lg-4">
                       <label for="hue-demo"style="float:left;" ><b style="color:red"></b>Country</label>
                       <input type="text" class="form-control demo" placeholder="..." name="country" value="Philippines" autocomplete="off" <?php echo $style1; ?>  />
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

            $insert ="INSERT INTO `tbl_resident`(`fname`, `mname`, `lname`, `bday`, `civilstat`, `purok`, `brgy`, `city`, `country`, `voter`, `contact`, `gender`, `occupation`, `citizenship`, `bplace`)
            VALUES ('".strtoupper($_POST['fname'])."', '".strtoupper($_POST['mname'])."','".strtoupper($_POST['lname'])."','".$_POST['bday']."','".$_POST['civil']."','".$_POST['purok']."','".$_POST['brgy']."','".$_POST['city']."','".$_POST['country']."','".$_POST['voter']."','".$_POST['phone']."','".$_POST['gender']."','".$_POST['occu']."','".$_POST['citizen']."','".$_POST['bplace']."')              ";
            $res = mysqli_query($conn, $insert);
            ?>
            <script>
                alert("Registered successfully!");
                 window.location.replace("newresident.php");
            </script>
<?php  }  ?>
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
        <script src="../assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="../dist/js/pages/mask/mask.init.js"></script>

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
