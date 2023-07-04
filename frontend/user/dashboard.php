<?php 
  define('BASE_URL', 'http://localhost:81/DryMe-WebLaundry/');
  session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DRYME | Laundry</title>

  <link rel="icon" href="../../image/logo_picture.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../src/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../src/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../src/dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="../../image/logo_picture.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <?php
    include 'navbar.php';
    include 'sidebar.php';
    INCLUDE '../../config/connection.php';

    if($_SESSION["role"]=='admin'){
      $get_user = mysqli_query($conn, "SELECT * FROM user" );
      $count_user = mysqli_num_rows($get_user);

      $get_costumer = mysqli_query($conn, "SELECT * FROM costumer");
      $count_costumer = mysqli_num_rows($get_costumer);

      $get_transaksi = mysqli_query($conn, "SELECT * FROM transaksi");
      $count_transaksi = mysqli_num_rows($get_transaksi);
      
      $get_transaksi_lunas = mysqli_query($conn, "SELECT * FROM transaksi where status_bayar='lunas'");
      $count_transaksi_lunas = mysqli_num_rows($get_transaksi_lunas);

      $get_proses_baru = mysqli_query($conn, "SELECT * FROM transaksi  where status_order='baru' ");
      $count_proses_baru = mysqli_num_rows($get_proses_baru);

      $get_proses_proses = mysqli_query($conn, "SELECT * FROM transaksi  where status_order='diproses'");
      $count_proses_proses = mysqli_num_rows($get_proses_proses);

      $get_proses_selesai = mysqli_query($conn, "SELECT * FROM transaksi  where status_order='selesai'");
      $count_proses_selesai = mysqli_num_rows($get_proses_selesai);

      $get_proses_ambil = mysqli_query($conn, "SELECT * FROM transaksi  where status_order='diambil'");
      $count_proses_ambil = mysqli_num_rows($get_proses_ambil);
    } else {
      $get_user = mysqli_query($conn, "SELECT * FROM user where id_outlet='".$_SESSION['id_outlet']."'" );
      $count_user = mysqli_num_rows($get_user);

      $get_costumer = mysqli_query($conn, "SELECT * FROM costumer where id_outlet='".$_SESSION['id_outlet']."'");
      $count_costumer = mysqli_num_rows($get_costumer);

      $get_transaksi = mysqli_query($conn, "SELECT * FROM transaksi where id_outlet='".$_SESSION['id_outlet']."'");
      $count_transaksi = mysqli_num_rows($get_transaksi);
      
      $get_transaksi_lunas = mysqli_query($conn, "SELECT * FROM transaksi where status_bayar='lunas' and id_outlet='".$_SESSION['id_outlet']."' ");
      $count_transaksi_lunas = mysqli_num_rows($get_transaksi_lunas);

      $get_proses_baru = mysqli_query($conn, "SELECT * FROM transaksi  where status_order='baru' and id_outlet='".$_SESSION['id_outlet']."'  ");
      $count_proses_baru = mysqli_num_rows($get_proses_baru);

      $get_proses_proses = mysqli_query($conn, "SELECT * FROM transaksi  where status_order='diproses' and id_outlet='".$_SESSION['id_outlet']."' ");
      $count_proses_proses = mysqli_num_rows($get_proses_proses);

      $get_proses_selesai = mysqli_query($conn, "SELECT * FROM transaksi  where status_order='selesai' and id_outlet='".$_SESSION['id_outlet']."' ");
      $count_proses_selesai = mysqli_num_rows($get_proses_selesai);

      $get_proses_ambil = mysqli_query($conn, "SELECT * FROM transaksi  where status_order='diambil' and id_outlet='".$_SESSION['id_outlet']."' ");
      $count_proses_ambil = mysqli_num_rows($get_proses_ambil);
    }

  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">New</span>
                <span class="info-box-number"><?=$count_proses_baru?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Process</span>
                <span class="info-box-number"><?=$count_proses_proses?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Selesai</span>
                <span class="info-box-number"><?=$count_proses_selesai?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Ambil</span>
                <span class="info-box-number"><?=$count_proses_ambil?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">costumer</span>
                <span class="info-box-number"><?=$count_costumer?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number"><?=$count_transaksi?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Lunas</span>
                <span class="info-box-number"><?=$count_transaksi_lunas?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
          <?php 
            include 'footer.php';
          ?>      
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../../src/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../../src/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../src/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../src/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../../src/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../../src/plugins/raphael/raphael.min.js"></script>
<script src="../../src/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../../src/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../../src/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../../src/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../src/dist/js/pages/dashboard2.js"></script>
</body>
</html>
