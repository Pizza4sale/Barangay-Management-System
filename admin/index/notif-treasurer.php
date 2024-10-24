<?php 
include 'include/conn.php';
session_start();
if(!isset($_SESSION["userpos"]))
header("location:../../user/pages/index.php");

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


    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin5">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <?php include'include/navbar02.php'; ?>
      </nav>
    </header>
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
      <!-- ============================================================== -->
      <!-- Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Staff Dashboard</h4>
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php if($_SESSION["userpos"] =='ADMIN02'){ ?>
                  <li class="breadcrumb-item"><a href="dashboard02.php">Home</a></li>
                  <?php }else{ ?>
                  <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                  <?php } ?>
                  <li class="breadcrumb-item active" aria-current="page">
                    Dashboard
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- ============================================================== -->
      <!-- End Bread crumb and right sidebar toggle -->
      <!-- Container fluid  -->
      <!-- ============================================================== -->
      <div class="container-fluid">
        <div class="card" style="border-radius: 10px;">
          <div class="card-body">
            <h5 class="card-title"></h5>
            <div class="table-responsive">
              <table id="example" class="table display" style="font-size:12px;color:black" >
                <thead>
                  <tr>
                    <th><b>Control Number</b></th>
                    <th><b>Payment Date</b></th>
                    <th><b>Account Name</b></th>
                    <th><b>Type</b></th>
                    <th><b>Payment Type</b></th>
                    <th><b>Reference Number</b></th>
                    <th><b>Amount</b></th>
                    <th><b>View Payment</b></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM tbl_payments WHERE status != 'VERIFIED_PAID'";
                    $cmd = $conn->prepare($sql);
                    $cmd->execute();
                    
                    $result = $cmd->get_result();
                    $results = $result->fetch_all(MYSQLI_ASSOC);

                    $cmd->close();
                  ?>
                  <?php foreach($results as $row): ?>
                    <tr>
                      <td class="align-middle"><?php echo $row['cnum'] ?></td>
                      <td class="align-middle"><?php echo date('d/m/Y', strtotime($row['datepaid'])) ?></td>
                      <td class="align-middle"><?php echo $row['name'] ?></td>
                      <td class="align-middle"><?php echo $row['typee'] ?></td>
                      <td class="align-middle"><?php echo $row['payment_type'] ?></td>
                      <td class="align-middle"><?php echo $row['refnum'] ?></td>
                      <td class="align-middle"><?php echo $row['amount'] ?></td>
                      <td class="align-middle">
                        <a href="/admin/index/payment_ref-treasurer.php?cnum=<?php echo $row['cnum'] ?>&from=<?php echo strtolower($row['typee']) ?>&oldcnum=<?php echo $row['oldcnum'] ?>" class="btn btn-sm rounded btn-danger">View Payment</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- ============================================================== -->
      <!-- End Container fluid  -->
      <!-- ============================================================== -->
      <!-- footer -->
      <!-- ============================================================== -->
      <footer class="footer text-center">
        
      </footer>
      <!-- ============================================================== -->
      <!-- End footer -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
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
    });
   </script>
  </body>
</html>