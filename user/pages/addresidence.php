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
              <form method="post" action="saveresidency.php"  enctype="multipart/form-data">
              <div class="card-body p-0">
                <div class="bs-stepper" style="padding-right: 20px;padding-left: 20px;" >
                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#logins-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Barangay Residency - New Application</span>
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
                       <input type="text" name="fname" class="form-control" value='<?php echo $fname; ?>' autocomplete="off" placeholder="First Name" required>
                      </div>
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">Middle Name</label>
                        <input type="text" name="mname" class="form-control" value='<?php echo $mname; ?>' placeholder="Middle Name" autocomplete="off" >
                      </div>
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Last Name</label>
                        <input type="text" class="form-control" name="lname" value='<?php echo $lname; ?>' placeholder="Last Name" autocomplete="off" required>
                      </div>
                    </div>
                    <!------ -->
                    <div class="row">
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Birthday</label>
                      <input type="date" name="bdate" class="form-control" value='<?php echo $bday; ?>' required>
                      </div>
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Civil Status</label>
                       <select type="text" name="civil" class="form-control" required>
                           <option selected disabled>-</option>
                           <option>Single</option>
                           <option>Married</option>
                            <option>Widowed</option>
                      </select>
                      </div>
                     <div class="col-md-4 form-group" >
                     <label for="exampleInputEmail1" style="color:gray" >*Are you a registered Voter?</label>
                       <select type="text" name="voter" class="form-control" required>
                        <option selected disabled="">- SELECT OPTION -</option>
                        <option value="yes">Yes, I am a registered voter</option>
                        <option value="no">No, I am not registered</option>
                      </select>
                    </div>
                  </div>
                    <!------ -->
                     <div class="row">
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">* House Number</label>
                       <input type="text"name="street" class="form-control" placeholder="Sitio/Purok/Zone/Building No."  autocomplete="off" required>
                      </div>
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Barangay</label>
                      <input type="text" name="brgy" class="form-control" placeholder="Barangay" value="Milawid" autocomplete="off" required>
                      </div>
                      <div class="col-md-2 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*City/Province</label>
                      <input type="text"  class="form-control" name="sal" value="Panukulan" autocomplete="off" readonly>
                      </div>
                      <div class="col-md-2 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Country</label>
                      <input type="text" class="form-control" name="phil"  value="Philippines" readonly>
                      </div>
                    </div>
                  <!------ -->
                     <div class="row">
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">* Phone number</label>
                       <input type="text" name="phone" class="form-control" data-inputmask='"mask": "(999) 9999-9999"'  data-mask  autocomplete="off" >
                      </div>
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">Email Address</label>
                      <input type="email" name="email" class="form-control" value='<?php echo $email ?>' placeholder="juan@sample.com" autocomplete="off" >
                      </div>
                      <div class="col-md-4 form-group" >
                        <label for="exampleInputEmail1" style="color:gray">*Upload Requirements <small>(PNG/JPG/PDF)</small></label>
                        <input type="file" name="attached" class="form-control" >
                      </div>
                    </div>
                    <!------ --><br>

                      <button type="submit" name="finish" class="btn btn-primary">Process My Request &nbsp >></button>
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
