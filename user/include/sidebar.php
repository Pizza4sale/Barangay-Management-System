<?php 
  function isActive($path) {
    echo stripos($_SERVER['REQUEST_URI'], $path) ? 'active' : '';
  }
?>
  <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/team.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo  $empname= $_SESSION["empname_2"]; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form 
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-cont rol form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
-->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link <?php isActive('index.php') ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
            
          </li>
          <!-- <li class="nav-item">
            <a href="clearancehistory.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Barangay Clearance
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="permithistory.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Business Permit
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="residencehistory.php" class="nav-link <?php isActive('residencehistory.php') ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Barangay Residency
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="lowincomehistory.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Certificate of Low Income
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="indigencyhistory.php" class="nav-link <?php isActive('indigencyhistory.php') ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Certificate of Indigency
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="soloparenthistory.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Certificate of Solo parent
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="complainthistory.php" class="nav-link <?php isActive('complainthistory.php') ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Complaints
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="profile.php" class="nav-link <?php isActive('profile.php') ?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profile
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->