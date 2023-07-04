<?php 
  define('BASE_URL', 'http://localhost:81/DryMe-WebLaundry/'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DryMe | 404 Page not found</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../src/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../src/dist/css/adminlte.min.css">
</head>
<body >
    <!-- Main content -->
      <div class="error-page d-flex align-items-center justify-content-center mt-5">
        <h2 class="headline text-danger"> 404</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Page not found.</h3>

          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="<?= BASE_URL?>frontend/user/dashboard.php">return to dashboard</a> or try using the search form.
          </p>

        </div>
        <!-- /.error-content -->
      </div>

<!-- jQuery -->
<script src="../src/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../src/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../src/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../src/dist/js/demo.js"></script>
</body>
</html>
