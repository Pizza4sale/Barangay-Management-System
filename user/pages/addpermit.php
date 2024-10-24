<!DOCTYPE html>
<?php include 'conn.php';
session_start();
if(!isset($_SESSION["user_id_2"]))
header("location:../index.php");

$query22 = "SELECT * FROM tbl_user where user_id = '".$_SESSION["user_id_2"]."' ";  
$result234 = mysqli_query($conn, $query22);  
while($row = mysqli_fetch_array($result234))  
 {  
    $fname = $row['firstname'];
    $mname = $row['middlename'];
    $lname = $row['lastname'];
    $bday  = $row['bday'];
    $email = $row['emailadd'];
 }


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
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
   <?php include'../include/navbar.php'; ?>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index3.html" class="brand-link">
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
            <h1>Service Request</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">New Application</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          
           
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <form method="post" action="savepermit.php" enctype="multipart/form-data" >
              <div class="card-body p-0">
                <div class="bs-stepper" style="padding-right: 20px;padding-left: 20px;" >
                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#logins-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Barangay Business Permit - New Application</span>
                      </button>
                    </div>
                    <div class="line"></div>
                  </div>
                 
                  <div class="bs-stepper-content">
                    <!-- your steps content here -->
                    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                       <!------ -->
                      <div class="row">
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*First Name</label>
                       <input type="text" name="name" class="form-control" id="name" value='<?php echo $fname; ?>' placeholder="First Name" autocomplete="off" required>
                      </div>
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">Middle Name</label>
                       <input type="text" name="mname" class="form-control" id="name" value='<?php echo $mname; ?>' placeholder="Middle Name" autocomplete="off" >
                      </div>
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Last Name</label>
                       <input type="text" name="lname" class="form-control" value='<?php echo $lname; ?>' id="name" placeholder="Last Name" autocomplete="off" required>
                      </div>
                    </div>
                    <!------ -->
                    <div class="row">
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Tax Identification Number (Personal)</label>
                        <input type="text" name="tinn" data-inputmask='"mask": "999-999-999"' data-mask class="form-control" autocomplete="off" required>
                      </div>
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Mobile Number</label>
                       <input type="tel"  name="phone" data-inputmask='"mask": "(999) 9999-9999"'  data-mask class="form-control"> 
                      </div>
                     <div class="col-md-4 form-group" >
                      <label for="exampleInputEmail1" style="color:gray">Telephone Number</label>
                     <input type="text" name="telnum" class="form-control" data-inputmask='"mask": "(99) 999-9999"' data-mask  autocomplete="off">
                      </div>
                    </div>
                     <!------ -->
                      <div class="row">
                      <div class="col-md-5 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Corporate Name</label>
                       <input type="text" name="corponame" class="form-control" placeholder="Name of Corporation (per SEC Reg.)" autocomplete="off" required>
                      </div>
                      <div class="col-md-5 form-group">
                        <label for="exampleInputEmail1" style="color:gray" >*Business Trade Name</label>
                       <input type="text" name="busname" class="form-control" placeholder="Business Trade Name (per DTI Reg.)" autocomplete="off" required>
                      </div>
                      <div class="col-md-2 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Tax Identification Number (Business)</label>
                      <input type="text" name="btin" class="form-control"  data-inputmask='"mask": "999-999-999"' data-mask autocomplete="off" required>
                      </div>
                    </div>
                    <!------ -->
                     <div class="row">
                      <div class="col-md-8 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Business Address</label>
                       <input type="text" name="busaddress" class="form-control" placeholder="House # / Purok / Brgy / City / Province/ Country" autocomplete="off" required>
                      </div>
                      <div class="col-md-4 form-group" hidden>
                        <label for="exampleInputEmail1" style="color:gray">*Upload Requirements <small>(PNG/JPG/PDF)</small></label>
                      <input type="file" name="filereq" class="form-control">
                      </div>
                    </div>
                  <!------ -->
                     <div class="row">
                      <div class="col-md-8 form-group">
                        <label for="exampleInputEmail1" style="color:gray">Capital Breakdown</label>
                         <textarea class="form-control" name="breakdown" autocomplete="off" rows="4" placeholder="Type Here..."></textarea>
                       
                      </div>
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Type of Ownership</label>
                       <select type="text" name="owner" class="form-control" required>
                        <option selected disabled="">- SELECT OPTION -</option>
                        <option value="Single">Single Proprietor</option>
                        <option value="cooperative">Cooperative</option>
                        <option value="partner">Partnership</option>
                        <option value="others">Others</option>
                      </select><br>
                      <input type="text" name="others" style="border-bottom: 2px solid;" cautocomplete="off" class="form-control" placeholder="Other's Specify" >
                      </div>
                    </div><br>
                    <!------ -->
                   

                      <button type="submit" name="permitsave" class="btn btn-primary">Process My Request &nbsp >></button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
              
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
<!-- InputMask -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- BS-Stepper -->
<script src="../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })
</script>
</body>
</html>
