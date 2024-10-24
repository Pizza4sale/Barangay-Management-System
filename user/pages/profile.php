<!DOCTYPE html>
<?php include 'conn.php';
session_start();
if(!isset($_SESSION["user_id_2"]))
header("location:../index.php");
           $uname= $_SESSION["uname01_2"];
           $empname= $_SESSION["empname_2"];
           $userid= $_SESSION["user_id_2"];
           $position= $_SESSION["userpos_2"];
$style1 = "style='box-shadow: 1px 1px;'";

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
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php 
          $sql = "SELECT * FROM tbl_user WHERE user_id = ?";
          $cmd = $conn->prepare($sql);
          $cmd->bind_param('i', $userid);
          $cmd->execute();

          $result = $cmd->get_result();
          $row = $result->fetch_assoc();

          $fname = strtolower($row['firstname']);
          $mname = strtolower($row['middlename']);
          $lname = strtolower($row['lastname']);

          $sql = "SELECT * FROM tbl_resident WHERE LOWER(fname) = ? AND LOWER(mname) = ? AND LOWER(lname) = ?";
          $cmd = $conn->prepare($sql);
          $cmd->bind_param('sss', $fname, $mname, $lname);
          $cmd->execute();
          
          $result = $cmd->get_result();
          $row = $result->fetch_assoc();
        ?>
        <div class="card" style="background-color:whitesmoke;width:100%;border-radius:12px;color:lightslategrey;">
                 
                 <div class="card-body">
                <div class="row mb-4">
                     <div class="col-lg-4">
                        <label for="hue-demo"style="float:left;" ><b style="color:red">*</b>First Name</label>
                        <input type="text" class="form-control demo" placeholder="..." name="fname" autocomplete="off" value="<?php echo $row['fname'] ?? '' ?>" disabled <?php echo $style1; ?>  />
                     </div>
                     <div class="col-lg-4">
                        <label for="hue-demo"style="float:left;" ><b style="color:red"></b>Middle Name</label>
                        <input type="text" class="form-control demo" placeholder="..." name="mname" autocomplete="off" disabled value="<?php echo $row['mname'] ?? '' ?>" <?php echo $style1; ?>  />
                     </div>
                      <div class="col-lg-4">
                        <label for="hue-demo"style="float:left;" ><b style="color:red"></b>Last Name</label>
                        <input type="text" class="form-control demo" placeholder="..." name="lname" autocomplete="off" disabled value="<?php echo $row['lname'] ?? ''; ?>" <?php echo $style1; ?>  />
                     </div>
                </div>
                 <div class="row mb-3">
                   <div class="col-lg-4">
                       <label for="hue-demo" style="float:left"><b style="color: red" >*</b>Birthday</label>
                     <input type="date"  class="form-control demo"  name="bday" autocomplete="off" disabled value="<?php echo $row['bday'] ?? date('Y-m-d') ?>" required <?php echo $style1; ?> />
                   </div>
                   <div class="col-lg-4">
                        <label for="hue-demo"style="float:left;" ><b style="color:red">*</b>Birth Place</label>
                        <input type="text" class="form-control demo" placeholder="..." name="bplace" autocomplete="off" disabled value="<?php echo $row['bplace'] ?? '' ?>" <?php echo $style1; ?>  />
                     </div>
                     <div class="col-lg-4">
                         <label for="hue-demo" style="float:left"><b style="color: red" >*</b>Civil Status</label>
                        <select name="civil"  class="form-control demo" disabled <?php echo $style1; ?>>
                         <option selected disabled></option>
                           <option value="Single" <?php echo ($row['civilstat'] ?? '') === 'Single' ? 'selected' : '' ?>>- Single</option>
                           <option value="Married" <?php echo ($row['civilstat'] ?? '') === 'Married' ? 'selected' : '' ?>>- Married</option>
                           <option value="Widowed"  <?php echo ($row['civilstat'] ?? '') === 'Widowed' ? 'selected' : '' ?>>- Widowed</option>
                         </select>
                     </div>
                 </div>
                  <div class="row mb-4">
                     <div class="col-lg-4">
                        <label for="hue-demo"style="float:left;" ><b style="color:red">*</b>Voter Status</label>
                         <select name="voter"  class="form-control demo" disabled <?php echo $style1; ?>>
                           <option selected disabled></option>
                           <option value="Registered Voter" <?php echo ($row['voter'] ?? '') === 'Registered Voter' ? 'selected' : '' ?>>- Registered Voter</option>
                           <option value="Not Registered Voter" <?php echo ($row['voter'] ?? '') === 'Not Registered Voter' ? 'selected' : '' ?>>- Not Registered Voter</option>
                         </select>
                     </div>
                     <div class="col-lg-4">
                        <label for="hue-demo"style="float:left;" ><b style="color:red">*</b>Contact Number</label>
                         <input type="text" name="phone" class="form-control phone-inputmask" placeholder="0" autocomplete="off" disabled value="<?php echo $row['contact'] ?? '' ?>" <?php echo $style1; ?>>
                     </div>
                      <div class="col-lg-4">
                        <label for="hue-demo"style="float:left;" ><b style="color:red">*</b>Gender</label>
                       <select name="gender"  class="form-control demo" disabled <?php echo $style1; ?>>
                           <option selected disabled></option>
                           <option value="Female" <?php echo ($row['gender'] ?? '') === 'Female' ? 'selected' : '' ?>>- Female</option>
                           <option value="Male" <?php echo ($row['gender'] ?? '') === 'Male' ? 'selected' : '' ?>>- Male</option>
                         </select>
                     </div>
                </div>
                 <div class="row mb-4">
                     <div class="col-lg-4">
                        <label for="hue-demo"style="float:left;" ><b style="color:red">*</b>Occupation</label>
                         <input type="text" name="occu" class="form-control demo" placeholder="..." autocomplete="off" disabled value="<?php echo $row['occupation'] ?? '' ?>" <?php echo $style1; ?>>
                     </div>
                      <div class="col-lg-4">
                         <label for="hue-demo"style="float:left;" ><b style="color:red">*</b>Citizenship</label>
                         <input type="text" name="citizen" class="form-control demo" value="Filipino"  placeholder="..." autocomplete="off" disabled value="<?php echo $row['citizenship'] ?? '' ?>" <?php echo $style1; ?>>
                     </div>
                </div>
                 <div class="row mb-3">
                    <div class="col-lg-2">
                        <label for="hue-demo"style="float:left;" ><b style="color:red">*</b>Purok</label>
                        <input type="text" class="form-control demo" placeholder="..." name="purok" autocomplete="off" disabled value="<?php echo $row['purok'] ?? '' ?>" <?php echo $style1; ?>  />
                     </div>
                     <div class="col-lg-2">
                        <label for="hue-demo"style="float:left;" ><b style="color:red"></b>Barangay</label>
                        <input type="text" class="form-control demo" placeholder="..." name="brgy" disabled value="<?php echo $row['brgy'] ?? '' ?>" autocomplete="off" <?php echo $style1; ?>  />
                     </div>
                      <div class="col-lg-4">
                        <label for="hue-demo"style="float:left;" ><b style="color:red"></b>City</label>
                        <input type="text" class="form-control demo" placeholder="..." name="city" disabled value="<?php echo $row['city'] ?? '' ?>" autocomplete="off" <?php echo $style1; ?>  />
                     </div>
                     <div class="col-lg-4">
                        <label for="hue-demo"style="float:left;" ><b style="color:red"></b>Country</label>
                        <input type="text" class="form-control demo" placeholder="..." name="country" disabled value="<?php echo $row['country'] ?? '' ?>" autocomplete="off" <?php echo $style1; ?>  />
                     </div>
                 </div>
 
                   </div>
                 </div>
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
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

</body>
</html>
