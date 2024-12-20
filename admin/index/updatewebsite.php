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

<style type="text/css">
img:hover {
  box-shadow: 0 0 2px 2px rgba(0, 140, 186, 0.5);
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
                      Barangay Updates
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
            <button class="tablinks" onclick="openCity(event, 'ab')" id="defaultOpen"><i class="fas fa-users"></i> Barangay Officials &nbsp <a href="addwebsite.php?from=org" class="badge btn-success" >+</a></button>
            <button class="tablinks" onclick="openCity(event, 'cd')" ><i class="fas fa-question"></i> Barangay FAQ's &nbsp <a href="addwebsite.php?from=faq" class="badge btn-success" >+</a></button>
           <!-- <button class="tablinks" onclick="openCity(event, 'ef')" ><i class="fas fa-star"></i> Barangay Others</button> -->
           <button class="tablinks" onclick="openCity(event, 'gh')" ><i class="fas fa-star"></i> Barangay Portfolio &nbsp <a href="addportfolio.php?from=port" class="badge btn-success" >+</a></button>
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
                           <th <?php echo $style1; ?>><b>Picture</b></th>
                           <th <?php echo $style1; ?>><b>Position Title</b></th>
                           <th <?php echo $style1; ?>><b>Name</b></th>
                           <th <?php echo $style1; ?>><b>Date Added</b></th>
                           <th <?php echo $style1; ?>><b></b></th>
                           <th></th>
                        </tr>
                      </thead>
                      <tbody>
               <?php    
                     //Code for displayed user in a table
                      $query = "SELECT  * FROM tbl_org order by org_id ";  
                      $result = mysqli_query($conn, $query);  
                      while($row = mysqli_fetch_array($result)) { ?>
                      <tr>
                          <td ><i style="color: red" class="fas fa-star"></i></td>
                          <td style="width:100px"><img src="../../img/brgy/<?php echo $row["org_pic"]; ?>" alt="" class="img-fluid"> </td>
                          <td style="width:200px"><?php echo $row["org_pos"]; ?></td>
                          <td style="width:200px"><?php echo $row["org_name"];?></td>
                          <td style="width:200px"><?php echo $row["date_added"]; ?></td>
                          <td style="width:5%"><a style="font-size: 13px;" href="edit_website.php?id=<?php echo $row["org_id"]; ?>&from=org" class="badge btn-success"><i class="fas fa-edit"></i> Edit</a></td>
                          <td style="width:5%">
                          <a onclick="return confirm('Are you sure you want to delete this barangay update? ')" style="font-size: 13px;" href="delete.php?id=<?php echo $row["org_id"]; ?>&from=org" class="badge btn-danger"><i class="fas fa-trash"></i>  Delete</a>
                    
                          </td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>


        <!-- FAQ -->
          <div id="cd" class="tabcontent">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:13px;color:black;" >
                      <thead>
                        <tr>
                           <th></th>
                           <th <?php echo $style1; ?>><b>Type</b></th>
                           <th <?php echo $style1; ?>><b>Question</b></th>
                           <th <?php echo $style1; ?>><b>Answer</b></th>
                           <th <?php echo $style1; ?>><b>Date Added</b></th>
                           <th <?php echo $style1; ?>><b></b></th>
                           <th></th>
                        </tr>
                      </thead>
                      <tbody>
               <?php    
                     //Code for displayed user in a table
                      $query1 = "SELECT  * FROM tbl_faq where purpose ='faq' order by id ";  
                      $result1 = mysqli_query($conn, $query1);  
                      while($row1 = mysqli_fetch_array($result1)) { ?>
                      <tr>
                          <td ><i style="color: red" class="fas fa-star"></i></td>
                          <td style="width:100px"><?php echo $row1["purpose"]; ?></td>
                          <td style="width:200px"><?php echo $row1["question"]; ?></td>
                          <td style="width:200px"><?php echo substr($row1["answer"],0,100);?></td>
                          <td style="width:200px"><?php echo $row1["date_added"]; ?></td>
                          <td style="width:5%"><a style="font-size: 13px;" href="edit_website.php?id=<?php echo $row1["id"]; ?>&from=faq" class="badge btn-success"><i class="fas fa-edit"></i> Edit</a></td>
                          <td style="width:5%">
                          <a onclick="return confirm('Are you sure you want to delete this barangay update? ')" style="font-size: 13px;" href="delete.php?id=<?php echo $row1["id"]; ?>&from=faq" class="badge btn-danger"><i class="fas fa-trash"></i>  Delete</a>
                    
                          </td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>


                 <!-- OTHERS -->
<?php 

$pop1 = "SELECT question FROM `tbl_faq` where purpose ='population' ";
$pop2 = mysqli_query($conn, $pop1);  
 while($pop11 = mysqli_fetch_array($pop2)) 
  { $pop = $pop11['question']; }

$pop1x = "SELECT * FROM `tbl_faq` where purpose ='voter' ";
$pop2x = mysqli_query($conn, $pop1x);  
 while($pop11x = mysqli_fetch_array($pop2x)) 
  { $reg = $pop11x['voter'];
    $nonreg = $pop11x['nonvoter']; }


  ?>

          <div id="ef" class="tabcontent">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <form method="post">
                    <div class="row mb-3">
                    <div class="col-lg-4">
                       <label for="hue-demo" style="float:left"><b>Population Count</b></label> 
                    <input  class="form-control" name="pop" value="<?php echo $pop; ?>"autocomplete="off">
                    </div>
                    <div class="col-lg-4">
                       <label for="hue-demo" style="float:left"><b>Registered Voters (count)</b></label> 
                    <input  class="form-control" name="reg" value="<?php echo $reg; ?>"autocomplete="off">
                    </div>
                    <div class="col-lg-4">
                      <label for="hue-demo" style="float:left"><b>Registered Non-Voters (count)</b></label> 
                    <input  class="form-control" name="nonreg" value="<?php echo $nonreg; ?>"autocomplete="off">
                    </div>
                  </div>
                    <div class="row mb-3">
                    <div class="col-lg-12">
                      <button type="submit" class="badge btn-primary text-white" name="upd3"><i class="fas fa-save"></i> Update Details</button>
                    </div>
                  </div>
                </form>
                </div>
              </div>
          </div>

        <?php 


         if(isset($_POST['upd3'])){

        // If upload button is clicked ...
           $pop1= $_POST['pop'];
           $reg1= $_POST['reg'];
           $nonreg1= $_POST['nonreg'];


              $sql = "UPDATE tbl_faq SET voter = '".$pop1."' WHERE purpose='population' ";
              mysqli_query($conn, $sql);
              
              $sqlx = "UPDATE tbl_faq SET voter = '".$reg1."', nonvoter ='".$nonreg1."' WHERE purpose='voter' ";
              mysqli_query($conn, $sqlx);
        ?>
                  <script>
                      alert("Successfully updated!");
                      window.location.replace("updatewebsite.php");
                  </script>
                  <?php
          }

         ?>

        <div id="gh" class="tabcontent">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                   <div class="row">
                   <div class="column">
                  <?php
                  $pop1xz = "SELECT * FROM `tbl_portfolio` ";
                  $pop2xz = mysqli_query($conn, $pop1xz);  
                   while($pop11xz = mysqli_fetch_array($pop2xz)) 
                    { $reg = $pop11xz['img_port'];


                  ?>
                    <a  href="delete.php?id=<?php echo $pop11xz['id']; ?>&from=port" onclick="return confirm('Are you sure you want to delete this picture? ')">
                      <img src="../../img/brgy/<?php echo $reg; ?>" class="img-fluid" style='width:150px;height:130px;padding: 5px; '>
                     </a>
                  <?php } ?>
                  
 </div> </div>
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
           document.getElementById("demo").innerHTML = "<p style='color:red'><strong>Password don't match!</strong></p>"
        }else{
             document.getElementById("demo").innerHTML = "<p style='color:green'><strong>Password match!</strong></p>"
        }

    }
</script>
