     <style >
       body{
   background-color: white;
}
     </style>     <div class="navbar-header" data-logobg="skin5">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->

            <?php if($_SESSION['userpos']=='ADMIN02'){ 
                    $link ='dashboard02.php';
                    $sidebar ="sidebar2.php";
                } else if ($_SESSION['userpos'] === 'TREASURER') {
                  $link = 'dashboard-treasurer.php';
                  $sidebar = 'sidebar.php';
                } else{
                   $link ='dashboard.php';
                   $sidebar ="sidebar.php";
                }

            ?>

            <a class="navbar-brand" href="<?php echo $link; ?>" style="background: #1f262d;!important; height: 64px;">
              <!-- Logo icon -->
              <b class="logo-icon ps-2">
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <img
                  src="../assets/images/milawid-logo.png"
                  alt="homepage"
                  class="light-logo"
                  width="40"
                />
              </b>
              <!--End Logo icon -->
              <!-- Logo text -->
              <span class="logo-text ms-2">
              <small><b>Barangay System</b></small>
              </span>
             
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a
              class="nav-toggler waves-effect waves-light d-block d-md-none"
              href="javascript:void(0)"
              ><i class="ti-menu ti-close"></i
            ></a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <div
            class="navbar-collapse collapse"
            id="navbarSupportedContent"
            data-navbarbg="skin5"
          >
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-start me-auto">
              <li class="nav-item d-none d-lg-block">
                <a
                  class="nav-link sidebartoggler waves-effect waves-light"
                  href="javascript:void(0)"
                  data-sidebartype="mini-sidebar"
                  ><i class="mdi mdi-menu font-24"></i
                ></a>
              </li>
              <!-- ============================================================== -->
              <!-- create new -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
               
            </ul>
            <!-- ============================================================== -->
              <!-- Messages -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
               
                <ul
                  class="
                    dropdown-menu dropdown-menu-end
                    mailbox
                    animated
                    bounceInDown
                  "
                  aria-labelledby="2"
                >
                  <ul class="list-style-none">
                    <li>
                     <!--  <div class="">
                        Message 
                        <a href="javascript:void(0)" class="link border-top">
                          <div class="d-flex no-block align-items-center p-10">
                            <span
                              class="
                                btn btn-success btn-circle
                                d-flex
                                align-items-center
                                justify-content-center
                              "
                              ><i class="mdi mdi-calendar text-white fs-4"></i
                            ></span>
                            <div class="ms-2">
                              <h5 class="mb-0">Event today</h5>
                              <span class="mail-desc"
                                >Just a reminder that event</span
                              >
                            </div>
                          </div>
                        </a>
                       Message
                        <a href="javascript:void(0)" class="link border-top">
                          <div class="d-flex no-block align-items-center p-10">
                            <span
                              class="
                                btn btn-info btn-circle
                                d-flex
                                align-items-center
                                justify-content-center
                              "
                              ><i class="mdi mdi-settings fs-4"></i
                            ></span>
                            <div class="ms-2">
                              <h5 class="mb-0">Settings</h5>
                              <span class="mail-desc"
                                >You can customize this template</span
                              >
                            </div>
                          </div>
                        </a>
 
                      </div>
                      -->
                    </li>
                  </ul>
                </ul>
              </li>
              <!-- ============================================================== -->
              <!-- End Messages -->
              <!-- ============================================================== -->

              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
                <a
                  class="
                    nav-link
                    dropdown-toggle
                    text-muted
                    waves-effect waves-dark
                    pro-pic
                  "
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <img
                    src="../assets/images/users/1.jpg"
                    alt="user"
                    class="rounded-circle"
                    width="31"
                  />
                </a>
                <ul 
                  class="dropdown-menu dropdown-menu-end user-dd animated"
                  aria-labelledby="navbarDropdown" >

                  <div class="dropdown-divider"></div>
                  <?php if($_SESSION['userpos']=='ADMIN02'){ ?>
                 <a onclick="document.getElementById('id01').style.display='block'" class="dropdown-item" ><i class="fa fa-user"></i> My Account</a>
                <?php } ?>
                <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="logout.php"
                    ><i class="fa fa-power-off me-1 ms-1"></i> Logout</a
                  >
                </ul>
              </li>
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
            </ul>
          </div>

   <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
       <!-- Change Password Modal-->
   <div id="id01" class="w3-modal">


    <div style='width:30%'  class="w3-modal-content">
      <div class="w3-container">
        <h3><b> My Account Details </b></h3><br>
        <?php
         $sqlx = "SELECT * FROM tbl_user WHERE user_id ='".$_SESSION['user_id']."' ";
         $processQueryx = $conn->query($sqlx);
         while ($resultQuerx = $processQueryx->fetch_assoc())
          { 
        ?>
          <form method="post" enctype="multipart/form-data" >
        <div class="form-group row">
          <label>Name</label>
          <input type="text" name='namee'  class="form-control" placeholder='Input name'  value="<?php echo $resultQuerx['name']; ?>" />
        </div>
        <div class="form-group row">
           <label>Username </label>
          <input type="text" name='uname' class="form-control" placeholder='Input username' value="<?php echo $resultQuerx['username']; ?>" />
          <label> Change Password </label>
          <input type="Password" name='pass' placeholder='*********' class="form-control"  />
        </div>
           <div class="form-group row">
           <label>Upload New Signature</label>
          <input type="file" name='sign' class="form-control" value="<?php echo $resultQuerx['name']; ?>" accept=".jpg " />
          <label> <small> Current Signature </small> </label>
          <center>
          <img src='pdf/examples/images/captain.jpg' style='width:40%;height:50%'>
         </center>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-6">
          <input onclick="document.getElementById('id01').style.display='none'" type="submit"  class=" btn btn-danger" style='width:100%' value='Cancel'>
        </div>
         <div class="col-md-6 col-lg-6">
          <input type="submit" name='sub' class="btn btn-success" style='width:100%;color:white' onclick="return confirm('Are you sure you want to update your account?')" value="Update">
        </div>
      </div>
    </form>
      <br>
      <?php } ?>
  
      </div>
    </div>
    <br><br><br>
  </div>

    <?php

    include'conn.php';

    date_default_timezone_set('Asia/Manila');
    $today = date('Y-m-d H:i:s');

    $sqlw1 = "SELECT * FROM tbl_request ";
    $processQueryw1 = $conn->query($sqlw1);
    while ($resultQuerwy = $processQueryw1->fetch_assoc())
     { $expiredate = $resultQuerwy['expiredate']; 

   if ($today>=$expiredate){
      $upd = "UPDATE `tbl_request` SET `status`='Expire' where cnum = '".$resultQuerwy['cnum']."' ";
      $updd = $conn->query($upd);
   }
 }

 if(isset($_POST['sub'])){
 
  if($_POST['pass'] == "" ){
  $upx= "UPDATE `tbl_user` SET `username`= '".$_POST['uname']."' ,`name`='".$_POST['namee']."' WHERE user_id ='".$_SESSION['user_id']."' " ;
  }else{
  $upx= "UPDATE `tbl_user` SET `username`= '".$_POST['uname']."' ,password='".md5($_POST['pass'])."' , `name`='".$_POST['namee']."' WHERE user_id ='".$_SESSION['user_id']."' " ;
  }

    $upddx = $conn->query($upx); 

  $newfilename= 'captain.jpg';
  move_uploaded_file($_FILES["sign"]["tmp_name"], "pdf/examples/images/" . $newfilename);
  echo "<meta http-equiv='refresh' content='0'>";
 }
  ?>