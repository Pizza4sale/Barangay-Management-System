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
        <?php
        if($_SESSION["userpos"] =='ADMIN02'){ 
           include 'include/sidebar2.php';
        }else{
           include 'include/sidebar.php';
        } ?>
      <!-- End Of Sidebar  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Services Record</h4>
              <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <?php if($_SESSION["userpos"] =='ADMIN02'){ ?>
                    <li class="breadcrumb-item"><a href="dashboard02.php">Home</a></li>
                    <?php }else{ ?>
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <?php } ?>
                    <li class="breadcrumb-item active" aria-current="page">
                      Website Notification
                    </li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid" >
      <div class='row'>
        <div class='column'>
          <div class="tab" style="border-radius: 0px 10px 30px 30px;width:17%;height:260%;background-color:white ">

            <?php  if($_SESSION["userpos"] =='ADMIN02'){  ?>
            
            <button class="tablinks" onclick="openCity(event, 'ab')" id="defaultOpen" style="font-size: 13px;  ">Clearance
            </button>
            <button class="tablinks" onclick="openCity(event, 'cd')" style="font-size: 13px;">Business Permit
            </button>
            <button class="tablinks" onclick="openCity(event, 'ef')" style="font-size: 13px;">Residency 
            </button>
             <button class="tablinks" onclick="openCity(event, 'ij')" style="font-size: 13px;">Solo Parent
            </button>
             <button class="tablinks" onclick="openCity(event, 'kl')" style="font-size: 13px;">Indigency
            </button>
             <button class="tablinks" onclick="openCity(event, 'mn')" style="font-size: 13px;">Low Income
            </button> 
            <button class="tablinks" onclick="openCity(event, 'gh')" style="font-size: 13px;">Complaints
            </button>

            <?php }else{ ?> 

              <button class="tablinks" onclick="openCity(event, 'ab')" id="defaultOpen" style="font-size: 13px;  ">Clearance
            <?php $sqlw1 = "SELECT count(cnum) as num FROM tbl_request WHERE type='brgyclearance' and status='Active' and type='brgyclearance' ";
            $processQueryw1 = $conn->query($sqlw1);
            while ($resultQuerwy = $processQueryw1->fetch_assoc())
            { echo  $numm = "(".$resultQuerwy['num'].")"; }
             ?>
            </button>
            <button class="tablinks" onclick="openCity(event, 'cd')" style="font-size: 13px;">Permit 
              <?php $sqlb = "SELECT count(cnum) as num FROM tbl_request WHERE type='permit' and status='Active' and type='permit' ";
            $processQueryb = $conn->query($sqlb);
            while ($resultQuerb = $processQueryb->fetch_assoc())
            {echo  $nummb = "(".$resultQuerb['num'].")"; } ?>
            </button>
            <button class="tablinks" onclick="openCity(event, 'ef')" style="font-size: 13px;">Residency 
            <?php $sqln = "
              SELECT COUNT(r.cnum) as num FROM tbl_request r
              LEFT JOIN tbl_payments p
                ON r.cnum = p.cnum
              WHERE r.type = 'residency'
                AND (r.status = 'Active' OR r.status = 'For Releasing')
                AND p.status = 'VERIFIED_PAID';
            ";
            $processQueryn = $conn->query($sqln);
            while ($resultQuern = $processQueryn->fetch_assoc())
            {echo  $nummn = "(".$resultQuern['num'].")"; } ?>
            </button>
            <button class="tablinks" onclick="openCity(event, 'gh')" style="font-size: 13px;">Complaints
             <?php $sqlx = "SELECT count(cnum) as num FROM tbl_request WHERE type='complaints' and status='Active' or status='For Releasing'  and type='complaints' ";
            $processQueryx = $conn->query($sqlx);
            while ($resultQuerx = $processQueryx->fetch_assoc())
            { echo  $nummx = "(".$resultQuerx['num'].")"; } ?>
            </button>
             <button class="tablinks" onclick="openCity(event, 'ij')" style="font-size: 13px;">Solo Parent
             <?php $sqlx = "SELECT count(cnum) as num FROM tbl_request WHERE type='soloparent' and status='Active' and type='soloparent' ";
            $processQueryx = $conn->query($sqlx);
            while ($resultQuerx = $processQueryx->fetch_assoc())
            {echo  $nummx = "(".$resultQuerx['num'].")"; } ?>
            </button>
             <button class="tablinks" onclick="openCity(event, 'kl')" style="font-size: 13px;">Indigency
             <?php $sqlx = "
              SELECT COUNT(r.cnum) as num FROM tbl_request r
              LEFT JOIN tbl_payments p
                ON r.cnum = p.cnum
              WHERE r.type = 'indigency'
                AND (r.status = 'Active' OR r.status = 'For Releasing')
                AND p.status = 'VERIFIED_PAID';
             ";
            $processQueryx = $conn->query($sqlx);
            while ($resultQuerx = $processQueryx->fetch_assoc())
            {echo  $nummx = "(".$resultQuerx['num'].")"; } ?>
            </button>
             <button class="tablinks" onclick="openCity(event, 'mn')" style="font-size: 13px;">Low Income
             <?php $sqlx = "SELECT count(cnum) as num FROM tbl_request WHERE type='lowincome' and status='Active' and type='lowincome' ";
            $processQueryx = $conn->query($sqlx);
            while ($resultQuerx = $processQueryx->fetch_assoc())
            {echo  $nummx = "(".$resultQuerx['num'].")"; } ?>
            </button>

            <?php } ?>
            
          </div>
          <?php
           $style1 = "style='color:white;font-size: 12px;padding:10px' ";
           $style2 = "style='color:black;font-size: 12px;' ";
          ?>
        </div>
      <div class="column">
      <?php if($_SESSION['userpos'] =='ADMIN02'){ ?>
      <!-- Clearance -->
        <div id="ab" style="border-radius:10px; margin-left:220px; margin-top:-218px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table strip" style="font-size:12px;color:black" >
                      <thead>
                        <tr style="background-color:#166A98;">
                          <th <?php echo $style1; ?>><b>Control Number</b></th>
                          <th <?php echo $style1; ?>><b>Requestor Name</b></th>
                          <th <?php echo $style1; ?>><b>Requirements</b></th>
                          <th <?php echo $style1; ?>><b>Preview File</b></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                   $sql1 = "SELECT * FROM tbl_brgyclearance where captain='okay' ";
                     $processQuery1 = $conn->query($sql1);
                     while ($resultQuery = $processQuery1->fetch_assoc())
                    { 
                      ?>
                      <tr>
                          <td style="width:20%"><b style='color:red'><?php echo $resultQuery['ctrl_num']; ?></b></td>
                          <td><?php echo strtoupper($resultQuery['lname'].",".$resultQuery['fname']); ?></td>
                          <td><?php if($resultQuery['fileupload']==""){echo "No File Uploaded";}else{ ?>
                            <a href="../../user/pages/file/<?php echo $resultQuery['fileupload']; ?>" target="_blank"><?php echo substr($resultQuery['fileupload'],0,15); ?></a>

                         <?php } ?>
                          </td>
                         <td><a target="_blank" href="pdf/generatebgclearance.php?id=<?php echo $resultQuery['ctrl_num']; ?>" class="badge btn-success"> <img src="img/<?php echo 'immigration.png'; ?>" alt="" width="30" class="img-fluid"></a></td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
          <!-- Permit -->
          <div id="cd" style="border-radius: 10px; margin-left:220px; margin-top:-218px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                     <table id="example2" class="table strip" style="font-size:12px;color:black" >
                      <thead>
                        <tr style="background-color:#166A98;">
                          <th <?php echo $style1; ?>><b>Control Number</b></th>
                          <th <?php echo $style1; ?>><b>Requestor Name</b></th>
                          <th <?php echo $style1; ?>><b>Business Details</b></th>
                          <th <?php echo $style1; ?>><b>Preview File</b></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                   $sql1 = "SELECT * FROM tbl_permit where captain='okay' ";
                     $processQuery1 = $conn->query($sql1);
                     while ($resultQuery = $processQuery1->fetch_assoc())
                    { 
                      ?>
                      <tr>
                          <td style="width:20%"><b style='color:red'>
                            <?php echo $resultQuery['permit_num']; ?>
                          </b></td>
                           <td><?php echo strtoupper($resultQuery['lname'].",".$resultQuery['fname']); ?></td>
                           <td>
                              <b> Business Name: </b> <?php echo $resultQuery['business_name']; ?>
                              <br> <b> Contact: </b> <?php echo $resultQuery['phone_num']; ?></td>
                         
                           <td><a target="_blank" style="font-size: 13px;background-color:#3498DB" href="pdf/generatepermit.php?id=<?php echo $resultQuery['permit_num']; ?>" class="badge btn-success"> <img src="img/<?php echo 'immigration.png'; ?>" alt="" width="30" class="img-fluid"></a></td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
          <!-- Residency -->
            <div id="ef" style="border-radius: 10px; margin-left:220px; margin-top:-218px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example3" class="table strip" style="font-size:12px;color:black" >
                      <thead>
                        <tr style="background-color:#166A98;">
                          <th <?php echo $style1; ?>><b>Control Number</b></th>
                          <th <?php echo $style1; ?>><b>Requestor Name</b></th>
                          <th <?php echo $style1; ?>><b>Voter Status</b></th>
                          <th <?php echo $style1; ?>><b>Preview File</b></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                   $sql1 = "SELECT * FROM tbl_residency where captain='okay' ";
                     $processQuery1 = $conn->query($sql1);
                     while ($resultQuery = $processQuery1->fetch_assoc())
                    { 
                      ?>
                      <tr>
                          <td style="width:20%"><b style='color:red'>
                            <?php echo $resultQuery['res_ctrl']; ?>
                          </b></td>
                           <td><?php echo strtoupper($resultQuery['res_lname'].",".$resultQuery['res_name']); ?>
                              <br><b> Contact: </b> <?php echo $resultQuery['res_number']; ?>
                            </td>
                          <td>
                              <b> <?php echo strtoupper($resultQuery['voter']); ?> </b> <br>
                              <a href="../../user/pages/file/<?php echo $resultQuery['reqfile']; ?>" target="_blank"><?php echo substr($resultQuery['reqfile'],0,15); ?></a>
                          </td>
                          <td><a target="_blank" style="font-size: 13px;background-color:#3498DB" href="pdf/generateresidence.php?id=<?php echo $resultQuery['res_ctrl']; ?>" class="badge btn-success"> <img src="img/<?php echo 'immigration.png'; ?>" alt="" width="30" class="img-fluid"></a></td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
          <!-- Complaints -->
          <div id="gh" style="border-radius: 10px; margin-left:220px; margin-top:-218px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example4" class="table strip" style="font-size:12px;color:black" >
                      <thead>
                        <tr style="background-color:#166A98;">
                          <th <?php echo $style1; ?>><b>Control Number</b></th>
                          <th <?php echo $style1; ?>><b>Complaint Details</b></th>
                          <th <?php echo $style1; ?>><b>Evidences</b></th>
                          <th <?php echo $style1; ?>><b>Report</b></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                   $sql1 = "SELECT * FROM tbl_complaint where captain='okay' ";
                     $processQuery1 = $conn->query($sql1);
                     while ($resultQuery = $processQuery1->fetch_assoc())
                    { 
                      ?>
                      <tr>
                         <td style="width: 20%">
                          <b style='color:red'> <?php echo $resultQuery['com_ctrl']; ?> </b>
                          </td>
                          <td style="width: 40%">
                            <b> Complainant: </b> <?php echo $resultQuery['from']; ?>  <br>
                            <b>Contact: </b> <?php echo $resultQuery['phoneno']; ?> <br> 
                            <b>Complainee: </b> <?php echo $resultQuery['to']; ?> </td>
                          <td ><a href="../../user/pages/file/<?php echo $resultQuery['upload']; ?>" target="_blank"><?php echo substr($resultQuery['upload'],0,15); ?></a></td>
                           <td>
                            <a target="_blank" style="font-size: 13px;background-color:#3498DB"  href="pdf/generate_complain.php?id=<?php echo $resultQuery['com_ctrl']; ?>" class="badge"> <img src="img/<?php echo 'immigration.png'; ?>" alt="" width="30" class="img-fluid"></a>
                            </td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>

          <!-- solo parent -->

            <div id="ij" style="border-radius: 10px; margin-left:220px;margin-top:-218px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                     <table id="example5" class="table strip" style="font-size:12px;color:black" >
                      <thead>
                        <tr style="background-color:#166A98;">
                          <th <?php echo $style1; ?>><b>Control Number</b></th>
                          <th <?php echo $style1; ?>><b>Requestor</b></th>
                          <th <?php echo $style1; ?>><b>Details</b></th>
                          <th <?php echo $style1; ?>><b>Preview File</b></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                   $sql1 = "SELECT * FROM tbl_soloparent where captain='okay' ";
                     $processQuery1 = $conn->query($sql1);
                     while ($resultQuery = $processQuery1->fetch_assoc())
                    { 
                      ?>
                      <tr>
                         <td style="width: 20%">
                          <b style='color:red'> <?php echo $resultQuery['reqnum']; ?> </b>
                          </td>
                         <td><?php echo strtoupper($resultQuery['lname'].",".$resultQuery['fname']); ?></td>
                         <td><b> Address: </b> <?php echo $resultQuery['address']; ?> <br>
                            <b> Contact: </b> <?php echo $resultQuery['phonenumber']; ?></td>
                         <td><a target="_blank" href="pdf/generatesoloparent.php?id=<?php echo $resultQuery['reqnum']; ?>" class="badge btn-success"> <img src="img/<?php echo 'immigration.png'; ?>" alt="" width="30" class="img-fluid"></a></td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        <!-- end of solo -->

          <!-- solo indigency -->

            <div id="kl" style="border-radius: 10px; margin-left:220px;margin-top:-218px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example6" class="table strip" style="font-size:12px;color:black" >
                      <thead>
                        <tr style="background-color:#166A98;">
                          <th <?php echo $style1; ?>><b>Control Number</b></th>
                          <th <?php echo $style1; ?>><b>Requestor</b></th>
                          <th <?php echo $style1; ?>><b>Details</b></th>
                          <th <?php echo $style1; ?>><b>Preview File</b></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                   $sql1 = "SELECT * FROM tbl_indigency where captain='okay' ";
                     $processQuery1 = $conn->query($sql1);
                     while ($resultQuery = $processQuery1->fetch_assoc())
                    { 
                      ?>
                      <tr>
                         <td style="width: 20%">
                          <b style='color:red'> <?php echo $resultQuery['reqnum']; ?> </b>
                          </td>
                         <td><?php echo strtoupper($resultQuery['lname'].",".$resultQuery['fname']); ?></td>
                         <td><b> Address: </b> <?php echo $resultQuery['address']; ?> <br>
                            <b> Contact: </b> <?php echo $resultQuery['phonenumber']; ?></td>
                         <td><a target="_blank" href="pdf/generateindigency.php?id=<?php echo $resultQuery['reqnum']; ?>" class="badge btn-success"> <img src="img/<?php echo 'immigration.png'; ?>" alt="" width="30" class="img-fluid"></a></td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        <!-- end of indigency -->

       
       <!-- low income -->

            <div id="mn" style="border-radius: 10px; margin-left:220px;margin-top:-218px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                   <table id="example7" class="table strip" style="font-size:12px;color:black" >
                      <thead>
                        <tr style="background-color:#166A98;">
                          <th <?php echo $style1; ?>><b>Control Number</b></th>
                          <th <?php echo $style1; ?>><b>Requestor</b></th>
                          <th <?php echo $style1; ?>><b>Details</b></th>
                          <th <?php echo $style1; ?>><b>Preview File</b></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                   $sql1 = "SELECT * FROM tbl_lowincome where captain='okay' ";
                     $processQuery1 = $conn->query($sql1);
                     while ($resultQuery = $processQuery1->fetch_assoc())
                    { 
                      ?>
                      <tr>
                         <td style="width: 20%">
                          <b style='color:red'> <?php echo $resultQuery['reqnum']; ?> </b>
                          </td>
                         <td><?php echo strtoupper($resultQuery['lname'].",".$resultQuery['fname']); ?></td>
                         <td><b> Address: </b> <?php echo $resultQuery['address']; ?> <br>
                            <b> Contact: </b> <?php echo $resultQuery['phonenumber']; ?></td>
                         <td><a target="_blank" href="pdf/generatelowincome.php?id=<?php echo $resultQuery['reqnum']; ?>" class="badge btn-success"> <img src="img/<?php echo 'immigration.png'; ?>" alt="" width="30" class="img-fluid"></a></td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        <!-- end of lowincome -->


      <?php } else {  

          $style1 = "style='color:white; font-size:12px; padding:10px' ";
          $style2 = "style='color:black; font-size:12px;' ";

        ?> 

        <!-- admin clearance -->
                  <div id="ab" style="border-radius: 10px; margin-left:220px; margin-top:-218px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:12px;color:black" >
                      <thead>
                        <tr style="background-color:#166A98;">
                          <th></th>
                          <th <?php echo $style1; ?>><b>DATE/TIME SENT</b></th>
                          <th <?php echo $style1; ?>><b>CTRL NUMBER</b></th>
                          <th <?php echo $style1; ?>><b>STATUS</b></th>
                          <th <?php echo $style1; ?>><b>PAYMENT</b></th>
                            <th <?php echo $style1; ?>></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                     $sql1 = "SELECT * FROM tbl_request WHERE type='brgyclearance'  and status='Active' and type='brgyclearance' ";
                     $processQuery1 = $conn->query($sql1);
                     while ($resultQuery = $processQuery1->fetch_assoc())
                    {   
                     if($resultQuery['request_type']!="OLD"){ $type='clearance'; }else{ $type='reclearance'; } 
                      $getqry = "SELECT * from tbl_payments where cnum='".$resultQuery['cnum']."' ";
                      $getres = $conn->query($getqry);
                      $resultQuery2 = $getres->fetch_assoc();

                          $s = "SELECT * from tbl_payments where cnum='".$resultQuery['cnum']."'  ";
                          $result = mysqli_query($conn,$s);
                          $count = mysqli_num_rows($result);
                      ?>
                      <tr>
                          <td><i style="color: red" class="fas fa-star"></i></td>
                          <td><?php echo $resultQuery['datesent']; ?></td>
                          <td><?php echo $resultQuery['cnum']; ?></td>
                          <td><b>Request Type: </b><?php echo $resultQuery['request_type']; ?><br>
                          <b>Status: </b> 
                          <?php if($resultQuery['status'] =='For Releasing'){ echo '<br>For Approval'; }
                                elseif($resultQuery['status'] =='Active'){ echo '<br>For Verification'; } ?></td>
                          <td><?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) {
                             echo "Already paid via ".strtoupper($resultQuery2['payment_type']); }else{  echo "Will pay via Cash or upon visit"; }
                          }else{ echo "Waiting for payment";} ?></td>
                          <td style="width:10%">
                          <?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) { ?>
                          <a style="font-size: 12px;border-radius: 8px" href="payment_ref_edit.php?cnum=<?php echo $resultQuery['cnum']; ?>&oldcnum=<?php echo $resultQuery['oldcnum']; ?>&from=<?php echo $type; ?>" class="badge btn-danger"> &nbsp View Payment &nbsp </a>
                        <?php }else{ ?>
                              <a onclick="return confirm('Are you sure you want to process this Barangay Clearance Request <?php echo $resultQuery['cnum']; ?> ? ')" style="font-size: 12px;border-radius: 8px" href="payment_ref.php?cnum=<?php echo $resultQuery['cnum']; ?>&oldcnum=<?php echo $resultQuery['oldcnum']; ?>&from=<?php echo $type; ?>" class="badge btn-danger"> &nbsp Add Payment &nbsp </a>
                          <?php } } else { ?>
                            <a style="font-size: 12px;border-radius: 8px" href="clearance2.php?cnum=<?php echo $resultQuery['cnum']; ?>&oldcnum=<?php echo $resultQuery['oldcnum']; ?>&from=<?php echo $type; ?>" class="badge btn-primary"> &nbsp Verify Details &nbsp </a>
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
        <!-- end of admin clearance -->

        <!-- admin permit -->
          <div id="cd" style="border-radius: 10px; margin-left:220px; margin-top:-218px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:12px;color:black" >
                      <thead>
                         <tr style="background-color:#166A98;">
                          <th></th>
                          <th <?php echo $style1; ?>><b>DATE/TIME SENT</b></th>
                          <th <?php echo $style1; ?>><b>CTRL NUMBER</b></th>
                          <th <?php echo $style1; ?>><b>STATUS</b></th>
                          <th <?php echo $style1; ?>><b>PAYMENT</b></th>
                          <th <?php echo $style1; ?>></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                     $sql1 = "SELECT * FROM tbl_request WHERE type='permit' and status='Active' and type='permit' ";
                     $processQuery1 = $conn->query($sql1);
                     while ($resultQuery = $processQuery1->fetch_assoc())
                    { 
                      $getqry = "SELECT * from tbl_payments where cnum='".$resultQuery['cnum']."' ";
                      $getres = $conn->query($getqry);
                      $resultQuery2 = $getres->fetch_assoc();

                        $s = "SELECT * from tbl_payments where cnum='".$resultQuery['cnum']."'  ";
                          $result = mysqli_query($conn,$s);
                          $count = mysqli_num_rows($result);

                      ?>
                      <tr>
                          <td><i style="color: red" class="fas fa-star"></i></td>
                          <td><?php echo $resultQuery['datesent']; ?></td>
                          <td><?php echo $resultQuery['cnum']; ?></td>
                          <td><b>Request Type: </b><?php echo $resultQuery['request_type']; ?><br>
                           <b>Status: </b> 
                          <?php if($resultQuery['status'] =='For Releasing'){ echo '<br>For Approval'; }
                                elseif($resultQuery['status'] =='Active'){ echo '<br>For Verification'; } ?></td>
                          <td><?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) {
                             echo "Already paid via ".strtoupper($resultQuery2['payment_type']); }else{  echo "Will pay via Cash or upon visit"; }
                          }else{ echo "Waiting for payment";} ?></td>
                          <td style="width:10%">
                          <?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) { ?>
                          <a style="font-size: 12px;border-radius: 8px" href="payment_ref_edit.php?cnum=<?php echo $resultQuery['cnum']; ?>&oldcnum=A&from=permit" class="badge btn-danger"> &nbsp View Payment &nbsp </a>
                        <?php }else{ ?>
                              <a onclick="return confirm('Are you sure you want to process this Barangay Business Permit Request <?php echo $resultQuery['cnum']; ?> ? ')"style="font-size: 12px;border-radius: 8px"  href="payment_ref.php?cnum=<?php echo $resultQuery['cnum']; ?>&oldcnum=A&from=permit" class="badge btn-danger"> &nbsp Add Payment &nbsp</a>
                          <?php } } else { ?>
                            <a style="font-size: 12px;border-radius: 8px" href="permit2.php?cnum=<?php echo $resultQuery['cnum']; ?>&oldcnum=<?php echo $resultQuery['oldcnum']; ?>&from=permit" class="badge btn-primary"> &nbsp Verify Details &nbsp </a>
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
        <!-- end of admin permit -->

        <!-- admin residency -->
            <div id="ef" style="border-radius: 10px; margin-left:220px; margin-top:-218px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:12px;color:black" >
                      <thead>
                         <tr style="background-color:#166A98;">
                          <th></th>
                          <th <?php echo $style1; ?>><b>DATE/TIME SENT</b></th>
                          <th <?php echo $style1; ?>><b>CTRL NUMBER</b></th>
                          <th <?php echo $style1; ?>><b>STATUS</b></th>
                          <th <?php echo $style1; ?>><b>PAYMENT</b></th>
                          <th <?php echo $style1; ?>></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                    //  $sqlx = "SELECT * FROM tbl_request WHERE type='residency' and status='Active' or status='For Releasing' and type='residency' ";
                    $sqlx = "
                      SELECT r.*, p.payment_type FROM tbl_request r
                      LEFT JOIN tbl_payments p
                        ON r.cnum = p.cnum
                      WHERE r.type = 'residency'
                        AND (r.status = 'Active' OR r.status = 'For Releasing')
                        AND p.status = 'VERIFIED_PAID';
                    ";
                     $processQueryx = $conn->query($sqlx);
                     while ($resultQuerx = $processQueryx->fetch_assoc())
                    { 

                      // $getqry = "SELECT * from tbl_payments where cnum='".$resultQuerx['cnum']."' ";
                      // $getres = $conn->query($getqry);
                      // $resultQuery2 = $getres->fetch_assoc();

                      //   $s = "SELECT * from tbl_payments where cnum='".$resultQuerx['cnum']."'  ";
                      //   $result = mysqli_query($conn,$s);
                      //   $count = mysqli_num_rows($result);

                      ?>
                      <tr>
                          <td><i style="color: red" class="fas fa-star"></i></td>
                          <td><?php echo $resultQuerx['datesent']; ?></td>
                          <td><?php echo $resultQuerx['cnum']; ?></td>
                          <td><b>Request Type: </b><?php echo $resultQuerx['request_type']; ?><br>
                          <b>Status: </b> 
                          <?php if($resultQuerx['status'] =='For Releasing'){ echo '<br>For Approval'; }
                                elseif($resultQuerx['status'] =='Active'){ echo '<br>For Verification'; } ?></td>
                         <td><?php 
                          if(!empty($resultQuerx['payment_type']))
                          { if($resultQuerx['payment_type']=="gcash" || $resultQuerx['payment_type']=="paymaya" ) {
                             echo "Already paid via ".strtoupper($resultQuerx['payment_type']); }else{  echo "Will pay via Cash or upon visit"; }
                          }else{ "Waiting for payment";} ?></td>
                          <td style="width:10%">
                          <?php 
                          if(!empty($resultQuerx['payment_type']))
                          { if($resultQuerx['payment_type']=="gcash" || $resultQuerx['payment_type']=="paymaya" ) { ?>
                          <a style="font-size: 12px;border-radius: 8px" href="residence2.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=A&from=residency" class="badge btn-primary"> &nbsp Verify Details &nbsp</a>
                        <?php }else{ ?>
                              <a onclick="return confirm('Are you sure you want to process this  Barangay Residency Request <?php echo $resultQuery['cnum']; ?> ? ')" style="font-size: 12px;border-radius: 8px" href="payment_ref.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=A&from=residency" class="badge btn-danger">&nbsp Add Payment &nbsp </a>
                          <?php } } ?>
                          </td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        <!-- end of admin residency -->

        <!-- admin complaints -->
          <div id="gh" style="border-radius: 10px; margin-left:220px; margin-top:-218px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="color:darkgrey;font-size:12px;color:black" >
                      <thead>
                         <tr style="background-color:#166A98;">
                          <th></th>
                          <th <?php echo $style1; ?>><b>DATE/TIME SENT</b></th>
                          <th <?php echo $style1; ?>><b>CONTROL NUMBER</b></th>
                          <th <?php echo $style1; ?>><b>STATUS</b></th>
                          <th <?php echo $style1; ?>></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                     $sqlv = "SELECT * FROM tbl_request WHERE type='complaints' and status='Active' or status='For Releasing' and type='complaints' ";
                     $processQueryv = $conn->query($sqlv);
                     while ($resultQuerv = $processQueryv->fetch_assoc())
                    { ?>
                      <tr>
                          <td><i style="color: red" class="fas fa-star"></i></td>
                          <td><?php echo $resultQuerv['datesent']; ?></td>
                          <td><?php echo $resultQuerv['cnum']; ?></td>
                          <td><b>Request Type: </b><?php echo $resultQuerv['request_type']; ?><br>
                           <b>Status: </b> 
                          <?php if($resultQuerv['status'] =='For Releasing'){ echo '<br>For Approval'; }
                                elseif($resultQuerv['status'] =='Active'){ echo '<br>For Verification'; } ?></td>
                          <td style="width:10%"><a style="font-size: 12px;border-radius: 8px" href="viewcomplaint.php?cnum=<?php echo $resultQuerv['cnum']; ?>&from=newcomp&oldcnum=<?php echo 'A'; ?>" class="badge btn-primary"> &nbsp View Complain &nbsp</a></td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        <!-- end of admin complaints -->

        <!-- admin solo parent -->

            <div id="ij" style="border-radius: 10px; margin-left:220px; margin-top:-218px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:12px;color:black" >
                      <thead>
                         <tr style="background-color:#166A98;">
                          <th></th>
                          <th <?php echo $style1; ?>><b>DATE/TIME SENT</b></th>
                          <th <?php echo $style1; ?>><b>CTRL NUMBER</b></th>
                          <th <?php echo $style1; ?>><b>STATUS</b></th>
                          <th <?php echo $style1; ?>><b>PAYMENT</b></th>
                          <th <?php echo $style1; ?>></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                     $sqlx = "SELECT * FROM tbl_request WHERE type='soloparent' and status='Active' and type='soloparent' ";
                     $processQueryx = $conn->query($sqlx);
                     while ($resultQuerx = $processQueryx->fetch_assoc())
                    { 

                      $getqry = "SELECT * from tbl_payments where cnum='".$resultQuerx['cnum']."' ";
                      $getres = $conn->query($getqry);
                      $resultQuery2 = $getres->fetch_assoc();

                        $s = "SELECT * from tbl_payments where cnum='".$resultQuerx['cnum']."'  ";
                        $result = mysqli_query($conn,$s);
                        $count = mysqli_num_rows($result);

                      ?>
                      <tr>
                          <td><i style="color: red" class="fas fa-star"></i></td>
                          <td><?php echo $resultQuerx['datesent']; ?></td>
                          <td><?php echo $resultQuerx['cnum']; ?></td>
                          <td><b>Request Type: </b><?php echo $resultQuerx['request_type']; ?><br>
                           <b>Status: </b> 
                          <?php if($resultQuerx['status'] =='For Releasing'){ echo '<br>For Approval'; }
                                elseif($resultQuerx['status'] =='Active'){ echo '<br>For Verification'; } ?></td>
                         <td><?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) {
                             echo "Already paid via ".strtoupper($resultQuery2['payment_type']); }else{  echo "Will pay via Cash or upon visit"; }
                          }else{ echo "Waiting for payment";} ?></td>
                          <td style="width:10%">
                          <?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) { ?>
                          <a style="font-size: 12px;border-radius: 8px" href="payment_ref_edit.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=A&from=soloparent" class="badge btn-danger"> &nbsp View Payment  &nbsp </a>
                        <?php }else{ ?>
                              <a onclick="return confirm('Are you sure you want to process this Solo Parent Request <?php echo $resultQuery['cnum']; ?> ? ')"  style="font-size: 12px;border-radius: 8px" href="payment_ref.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=A&from=soloparent" class="badge btn-danger"> &nbsp Add Payment &nbsp</a>
                          <?php } } else { ?>
                            <a style="font-size: 12px;border-radius: 8px" href="soloparent_edit.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=<?php echo $resultQuerx['oldcnum']; ?>&from=soloparent" class="badge btn-primary"> &nbsp Verify Details &nbsp </a>
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
        <!-- end of admin solo -->

        <!-- admin indigency -->

            <div id="kl" style="border-radius: 10px; margin-left:220px; margin-top:-218px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:12px;color:black" >
                      <thead>
                         <tr style="background-color:#166A98;">
                          <th></th>
                          <th <?php echo $style1; ?>><b>DATE/TIME SENT</b></th>
                          <th <?php echo $style1; ?>><b>CTRL NUMBER</b></th>
                          <th <?php echo $style1; ?>><b>STATUS</b></th>
                          <th <?php echo $style1; ?>><b>PAYMENT</b></th>
                          <th <?php echo $style1; ?>></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                     $sqlx = "
                      SELECT r.*, p.payment_type FROM tbl_request r
                      LEFT JOIN tbl_payments p
                        ON r.cnum = p.cnum
                      WHERE r.type = 'indigency'
                        AND (r.status = 'Active' OR r.status = 'For Releasing')
                        AND p.status = 'VERIFIED_PAID';
                     ";
                     $processQueryx = $conn->query($sqlx);
                     while ($resultQuerx = $processQueryx->fetch_assoc())
                    { 

                      // $getqry = "SELECT * from tbl_payments where cnum='".$resultQuerx['cnum']."' ";
                      // $getres = $conn->query($getqry);
                      // $resultQuery2 = $getres->fetch_assoc();

                      //   $s = "SELECT * from tbl_payments where cnum='".$resultQuerx['cnum']."'  ";
                      //   $result = mysqli_query($conn,$s);
                      //   $count = mysqli_num_rows($result);

                      ?>
                      <tr>
                          <td><i style="color: red" class="fas fa-star"></i></td>
                          <td><?php echo $resultQuerx['datesent']; ?></td>
                          <td><?php echo $resultQuerx['cnum']; ?></td>
                          <td><b>Request Type: </b><?php echo $resultQuerx['request_type']; ?><br>
                           <b>Status: </b> 
                          <?php if($resultQuerx['status'] =='For Releasing'){ echo '<br>For Approval'; }
                                elseif($resultQuerx['status'] =='Active'){ echo '<br>For Verification'; } ?></td>
                         <td><?php 
                          if(!empty($resultQuerx['payment_type']))
                          { if($resultQuerx['payment_type']=="gcash" || $resultQuerx['payment_type']=="paymaya" ) {
                             echo "Already paid via ".strtoupper($resultQuerx['payment_type']); }else{  echo "Will pay via Cash or upon visit"; }
                          }else{ "Waiting for payment";} ?></td>
                          <td style="width:10%">
                          <?php 
                          if(!empty($resultQuerx['payment_type']))
                          { if($resultQuerx['payment_type']=="gcash" || $resultQuerx['payment_type']=="paymaya" ) { ?>
                          <a style="font-size: 12px;border-radius: 8px" href="indigency_edit.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=A&from=indigency" class="badge btn-primary"> &nbsp Verify Details  &nbsp </a>
                        <?php }else{ ?>
                              <a onclick="return confirm('Are you sure you want to process this Indigency Request <?php echo $resultQuerx['cnum']; ?> ? ')"  style="font-size: 12px;border-radius: 8px" href="payment_ref.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=A&from=indigency" class="badge btn-danger"> &nbsp Add Payment &nbsp</a>
                          <?php } } ?>
                          </td>
                        </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        <!-- end of admin indigency -->

       
       <!-- admin low income -->

            <div id="mn" style="border-radius: 10px; margin-left:220px; margin-top:-218px" class="tabcontent">
            <div class="card" style="border-radius: 10px;">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <div class="table-responsive">
                    <table id="example" class="table display" style="font-size:12px;color:black" >
                      <thead>
                         <tr style="background-color:#166A98;">
                          <th></th>
                          <th <?php echo $style1; ?>><b>DATE/TIME SENT</b></th>
                          <th <?php echo $style1; ?>><b>CTRL NUMBER</b></th>
                          <th <?php echo $style1; ?>><b>STATUS</b></th>
                          <th <?php echo $style1; ?>><b>PAYMENT</b></th>
                          <th <?php echo $style1; ?>></th>
                        </tr>
                      </thead>
                      <tbody>
                <?Php 
                     $sqlx = "SELECT * FROM tbl_request WHERE type='lowincome' and status='Active'  and type='lowincome' ";
                     $processQueryx = $conn->query($sqlx);
                     while ($resultQuerx = $processQueryx->fetch_assoc())
                    { 

                      $getqry = "SELECT * from tbl_payments where cnum='".$resultQuerx['cnum']."' ";
                      $getres = $conn->query($getqry);
                      $resultQuery2 = $getres->fetch_assoc();

                        $s = "SELECT * from tbl_payments where cnum='".$resultQuerx['cnum']."'  ";
                        $result = mysqli_query($conn,$s);
                        $count = mysqli_num_rows($result);

                      ?>
                      <tr>
                          <td><i style="color: red" class="fas fa-star"></i></td>
                          <td><?php echo $resultQuerx['datesent']; ?></td>
                          <td><?php echo $resultQuerx['cnum']; ?></td>
                          <td><b>Request Type: </b><?php echo $resultQuerx['request_type']; ?><br>
                          <b>Status: </b> 
                          <?php if($resultQuerx['status'] =='For Releasing'){ echo '<br>For Approval'; }
                                elseif($resultQuerx['status'] =='Active'){ echo '<br>For Verification'; } ?></td> 
                         <td><?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) {
                             echo "Already paid via ".strtoupper($resultQuery2['payment_type']); }else{  echo "Will pay via Cash or upon visit"; }
                          }else{ echo "Waiting for payment";} ?></td>
                          <td style="width:10%">
                          <?php 
                          if($count!= 0)
                          { if($resultQuery2['payment_type']=="gcash" || $resultQuery2['payment_type']=="paymaya" ) { ?>
                          <a style="font-size: 12px;border-radius: 8px" href="payment_ref_edit.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=A&from=lowincome" class="badge btn-danger"> &nbsp View Payment  &nbsp </a>
                        <?php }else{ ?>
                              <a onclick="return confirm('Are you sure you want to process this Indigency Request <?php echo $resultQuery['cnum']; ?> ? ')"  style="font-size: 12px;border-radius: 8px" href="payment_ref.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=A&from=lowincome" class="badge btn-danger"> &nbsp Add Payment &nbsp</a>
                          <?php } } else { ?>
                            <a style="font-size: 12px;border-radius: 8px" href="lowincome_edit.php?cnum=<?php echo $resultQuerx['cnum']; ?>&oldcnum=<?php echo $resultQuerx['oldcnum']; ?>&from=lowincome" class="badge btn-primary"> &nbsp Verify Details &nbsp </a>
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
        <!-- end of lowincome -->

      <?php } ?>
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
    $(document).ready(function() {
       $('#example2',).dataTable( {
       "lengthMenu": [10, 20,50,100],
       "pageLength": 10,
       "bFilter": true,
       "order":[0,'asc']
     } );
     } );
     $(document).ready(function() {
       $('#example3',).dataTable( {
       "lengthMenu": [10, 20,50,100],
       "pageLength": 10,
       "bFilter": true,
       "order":[0,'asc']
     } );
     } );
      $(document).ready(function() {
       $('#example4',).dataTable( {
       "lengthMenu": [10, 20,50,100],
       "pageLength": 10,
       "bFilter": true,
       "order":[0,'asc']
     } );
     } );
       $(document).ready(function() {
       $('#example5',).dataTable( {
       "lengthMenu": [10, 20,50,100],
       "pageLength": 10,
       "bFilter": true,
       "order":[0,'asc']
     } );
     } );
        $(document).ready(function() {
       $('#example6',).dataTable( {
       "lengthMenu": [10, 20,50,100],
       "pageLength": 10,
       "bFilter": true,
       "order":[0,'asc']
     } );
     } );

         $(document).ready(function() {
       $('#example7',).dataTable( {
       "lengthMenu": [10, 20,50,100],
       "pageLength": 10,
       "bFilter": true,
       "order":[0,'asc']
     } );
     } );
</script>