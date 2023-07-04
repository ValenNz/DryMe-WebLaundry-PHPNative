<?php 
  define('BASE_URL', 'http://localhost:81/DryMe-WebLaundry/');
  if($_SESSION['status_login'] != true) {
    header('location:../login.php');
}
?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= BASE_URL ?>image/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">DryMe</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img  src="<?= BASE_URL ?>image/user/<?=$_SESSION['foto_profile']?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= BASE_URL?>frontend/profile.php" class="d-block"><?=$_SESSION['nama_user']?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href='<?= BASE_URL?>frontend/user/dashboard.php' class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <?php 
                if($_SESSION["role"]=='admin' or $_SESSION["role"]=='owner'){
              ?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Manage Data
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview ml-3">
                
                  <li class="nav-item">
                    <a href="<?= BASE_URL?>frontend/user/user/table.php" class="nav-link">
                      <i class="fas fa-user nav-icon "></i>
                      <p>User Data</p>
                    </a>
                  </li>

                  <li class="nav-item">
                  <a href="<?= BASE_URL?>frontend/user/paket/table.php" class="nav-link">
                    <i class="fas fa-box nav-icon"></i>
                    <p>Paket Data</p>
                  </a>
                </li>

                <?php 
                    if($_SESSION["role"]=='admin'){
                ?>
                  <li class="nav-item">
                    <a href="<?= BASE_URL?>frontend/user/outlet/table.php" class="nav-link">
                      <i class="fas fa-store nav-icon"></i>
                      <p>Outlet Data</p>
                    </a>
                  </li>

                <?php 
                  }else{
                  
                  }
                ?>

              </ul>
            </li>
          <?php 
                }else {

                }
              ?>
          <li class="nav-item">
            <a href="<?= BASE_URL?>frontend/user/transaction/table.php" class="nav-link">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                Transaction Data
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= BASE_URL?>backend/logout.php" class="nav-link">
              <i class="nav-icon fas fa-arrow-alt-circle-left"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->