<!DOCTYPE html>
<?php include 'conn.php';
session_start();
if(!isset($_SESSION["user_id_2"]))
header("location:../index.php");
           $uname= $_SESSION["uname01_2"];
           $empname= $_SESSION["empname_2"];
           $userid= $_SESSION["user_id_2"];
           $position= $_SESSION["userpos_2"];
 ?>
 
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Milawid Services</title>
 <link rel="icon" type="image/png" sizes="16x16" href="../images/milawid_logo.png" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
<?php include'../include/navbar.php'; ?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../images/milawid_logo.png"  alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: ">
      <span class="brand-text font-weight-light">Milawid Service</span>
    </a>

  <?php include'../include/sidebar.php'; ?>

  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Services</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Barangay Complaint</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <div class="card">
           <!-- /.card-header -->
              <div class="card-body">
                  <div class='table-responsive'>
                 <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Date</th>
                   <!-- <th>Request Control Number</th> -->
                    <th>Control Number</th>
                    <th>Date Received</th>
                    <th>Schedule Date</th>
                    <th>Date Closed</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
            <?php
            $sqlrt = "SELECT * FROM `tbl_complaint` where fromuser ='".$uname."' ";
            $processQueryrt = $conn->query($sqlrt);
            while ($resultQueryrt = $processQueryrt->fetch_assoc()){
              $dd = $resultQueryrt['datereceived']; 
              $dd2 = $resultQueryrt['date_closed']; 
              $dd3 = $resultQueryrt['visitsched'];
              $cnum = $resultQueryrt['com_ctrl'];
              $rnum = $resultQueryrt['reqnum'];
              $stat = $resultQueryrt['status'];
              $photoupload = $resultQueryrt['upload'];
            ?>
                 <tr>
                  <td> <?php echo $resultQueryrt['datesent']; ?></td>
                 <td>
                    <b> Request #: </b><br>
                    <?php  echo $resultQueryrt['reqnum'];  ?><br>
                   <b> Official # :</b><br>
                   <?php if($resultQueryrt['com_ctrl']=="-"){ echo "No control number available";}
                         else{ echo $resultQueryrt['com_ctrl']; } ?>
                  </td>

                  <td> <?php if($dd ==""){echo "No available date."; }else{ echo $resultQueryrt['datereceived'];} ?></td>
                  <td> <?php if($dd3 ==""){echo "No available date."; }else{ echo "You were asked to visit the brgy on ". $resultQueryrt['visitsched'];} ?></td>

                   <td> <?php if($dd2 ==""){echo "No available date."; }else{ echo $resultQueryrt['date_closed'];} ?></td>
                  <td> <?php if($stat=="NEW" ){ echo "Waiting for acknowledgement of Official"; }elseif($stat=="CLOSED" ){ echo "Case was already closed"; }elseif($stat=="DECLINE" ){ echo "Case was declined by barangay official In charge"; }else{ echo "On going investigation"; }?></td>
                  <td>
                    <?php if($stat=="NEW" ){?>
                    <a href="cancelrequest.php?id=<?php echo $rnum; ?>" onclick="return confirm('Are you sure you want to cancel your request?')"  class="badge btn-warning">Cancel Request</a>
                  <?php }elseif($stat=="DECLINE" ){?>
                   <img src="img/<?php echo 'decline.png'; ?>" alt="" width="30" class="img-fluid"> <?php }elseif($stat=="CLOSED"){?>
                      <img src="img/<?php echo 'closed.png'; ?>" alt="" width="30" class="img-fluid">
                    <?php } elseif($stat=="OPEN"){?>
                      <img src="img/<?php echo 'private-investigator.png'; ?>" alt="" width="30" class="img-fluid">
                    <?php } ?>
                  </td>
                  </tr>
            <?php } ?>
                  </tbody>
                </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Barangay Milawid Services @2022 - Capstone Project</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
