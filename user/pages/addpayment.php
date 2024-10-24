<!DOCTYPE html>
<?php include 'conn.php';
session_start();
if(!isset($_SESSION["user_id_2"]))
header("location:../index.php");
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
            <h1>Service Payment</h1>
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
              <form method="post" action="savepayment.php" enctype="multipart/form-data">
              <div class="card-body p-0">
                <div class="bs-stepper" style="padding-right: 20px;padding-left: 20px;" >
                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#logins-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Add Payment For - <b style="font-size:20px"><?php echo $_GET['id']; ?></b></span>
                      </button>
                    </div>
                    <div class="line"></div>
                  </div>
                
                  <div class="bs-stepper-content">
                      <?php if(isset($_GET['error'])){ ?> 
                     <small style="color:red"><b>** Please select payment method first</b></small>
                  <?php } ?>
                    <!-- your steps content here -->
                    <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                       <!------ -->
                      <div class="row">
                      <div class="col-md-3 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Mode of Payment</label>
                       <select type="text" id='payment' name="payment" class="form-control" required>
                        <option selected value='1'>- SELECT OPTION -</option>
                        <option value="gcash">Gcash</option>
                        <option value="paymaya">Paymaya</option>
                      </select>
                      </div>
                      <div class="col-md-4 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Reference Number</label>
                       <input type="text" name="refnum" onInput="checkUname()" class="form-control" id="refnum" placeholder="-- --- --" autocomplete="off" required>
                      <span id="check-refnum" style="font-size: 12px"></span>  


                        <input type="hidden" name="from" value="<?php echo $_GET['from']; ?>">
                        <input type="hidden" name="idnum" value="<?php echo $_GET['id']; ?>">
                      </div>
                      <div class="col-md-2 form-group">
                        <label for="exampleInputEmail1" style="color:gray">*Amount</label>
                       <input type="number" name="pay" class="form-control" id="name" placeholder="Amount Paid" autocomplete="off" required>
                      </div>
                       <div class="col-md-3 form-group">
                        <label for="exampleInputEmail1" style="color:gray">Date of Payment</label>
                       <input type="date" name="pdate" class="form-control" id="name" placeholder="Last Name" autocomplete="off" required>
                      </div>
                    </div>
                      <!------ 
                      <div class="row">
                      <div class="col-md-7 form-group">
                       <label for="exampleInputEmail1" style="color:gray;font-size: 14px;">Upload Proof of payment ( jpg , png , JPG , jpeg )</label>
                       <input type="file" name="photo" class="form-control" required>
                      </div>
                    </div>
                  -->
                     <br>
                      <button id='subm' onclick="return confirm('Are you sure you want to process payment ?')" type="submit" class="btn btn-primary">Process My payment &nbsp >></button><br>
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

<script>

    function checkUname() {
        
        jQuery.ajax({
        url: "../../checkrefnum.php",
        data:'ref='+$("#refnum").val()+'&type='+$("#payment").val(),
        type: "POST",
        success:function(data){
            $("#check-refnum").html(data);
        },
        error:function (){}
        });
    }
    </script>


</body>
</html>
