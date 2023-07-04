<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DRYME | DataTables</title>

    <link rel="icon" href="../../../image/logo_picture.png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../src/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../../src/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../../src/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../../src/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../src/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini dark-mode">
    <div class="wrapper">

        <?php
    include '../navbar.php';
    include '../sidebar.php'
  ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>DataTables</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data User</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#add" data-whatever="@getbootstrap"><i
                                                class="fa fa-user-plus"></i> Add User</button>
                                                
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Foto</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Telephone</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">outlet</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                      require '../../../config/connection.php';

                      if (isset($_POST["cari"])) {
                        // jika ada keyword pencarian 
                        $cari=$_POST['cari'];
                        $query_user= mysqli_query($conn,"SELECT * FROM user WHERE id_user LIKE '%$cari%' OR nama_user LIKE '%$cari%'");

                      }else{
                          //jika tidak ada keyword pencarian
                          if($_SESSION["role"]=='admin'){
                            $query_user= mysqli_query($conn,"SELECT * FROM user ");
                          } else {
                            $query_user= mysqli_query($conn,"SELECT * FROM user where id_outlet='".$_SESSION['id_outlet']."'");
                          }
               
               
                         
                      }
                      $no=1;
                      while($data_user = mysqli_fetch_array($query_user)){ 
                          $no++;
                    ?>
                                            <tr>    
                                                <th scope="col">
                                                    <img src="../../../image/user/<?=$data_user['foto_profile']?>"
                                                        width="50px" height="50px">
                                                </th>
                                                <td><?= $data_user["nama_user"]; ?></td>
                                                <td><?= $data_user["telp"]; ?></td>
                                                <td><?= $data_user["username"]; ?></td>
                                                <td><?= $data_user["alamat"]; ?></td>
                                                <td><?= $data_user["role"]; ?></td>
                                                <td>
                                                    <?php 
                      // foreign key joi ke primary key di id yag sama dari foerign ke disamakan dengan id di promary key ketika foreinkey sama dengan data yang dimasukan.
                        $query_outlet = mysqli_query($conn, "SELECT * FROM outlet WHERE id_outlet =".$data_user['id_outlet']);
                        $tampil_nama_outlet = "<ol>";
                                            while($data_outlet = mysqli_fetch_array($query_outlet)){
                                                $tampil_nama_outlet .= "<li>".$data_outlet['nama_outlet']."</li>";
                                            }
                                            $tampil_nama_outlet .= "</ol>";
                                            ?>
                                                    <?=$tampil_nama_outlet?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#edit<?= $data_user['id_user'] ?>" name="edit" data-whatever="@getbootstrap"><i
                                                            class="fa fa-pen"></i></button>
                                                    <button type="button" class="btn btn-danger" >
                                                        <a href="<?= BASE_URL?>backend/user/delete.php?id_user=<?=$data_user['id_user']?>"><i class="fa fa-trash " style="color:white!important"></i></a>
                                                    </button>
                                                </td>
                                            </tr>

                                <div class="modal fade" id="edit<?= $data_user['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header ">
                                            <h3 class="card-title">Edit User</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card card-primary">

                                                <!-- /.card-header -->
                                                <!-- form start -->
                                                <form action="<?= BASE_URL?>backend/user/edit.php" method="POST"
                                                    enctype="multipart/form-data">
                                                    <input type="hidden" name="id_user" value="<?= $data_user['id_user']?>">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="exampleInputNamaUser">Nama User</label>
                                                            <input type="text" name="nama_user" class="form-control"
                                                                id="exampleInputNamaUser" placeholder="Enter Nama User" value="<?= $data_user['nama_user']?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputAlamat">Alamat</label>
                                                            <input type="text" name="alamat" class="form-control"
                                                                id="exampleInputAlamat" placeholder="Enter Alamat" value="<?= $data_user['alamat']?> ">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputTelephone">Telephone</label>
                                                            <input type="text" name="telp" class="form-control"
                                                                id="exampleInputTelephone"
                                                                placeholder="Enter Telephone" value="<?= $data_user['telp']?> ">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputUsername">Username</label>
                                                            <input type="text" name="username" class="form-control"
                                                                id="exampleInputUsername" placeholder="Enter Username" value="<?= $data_user['username']?> ">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword">Password</label>
                                                            <input type="password" name="password" class="form-control"
                                                                id="exampleInputPassword" placeholder="Enter Password" value="<?= $data_user['password']?> ">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="role" class="form-label">role :</label>
                                                            <?php
                                                                $arr_role=array('admin'=>'admin','owner'=>'owner','kasir' =>'kasir');
                                                            ?>
                                                            <select name="role" class="form-control form" required>
                                                                <option></option>
                                                                <?php foreach ($arr_role as $key_role => $val_role):?>
                                                                <option value="<?=$key_role?>"><?=$val_role?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="outlet" class="form-label">outlet :</label>
                                                            <select name="id_outlet" class="form-control form" required>
                                                                <option></option>
                                                                <?php
                                include '../../../config/connection.php';
                                $sql = "SELECT * FROM outlet";
                                $show_outlet = mysqli_query($conn,$sql);
                                $no = 1;

                                while ($outlet = mysqli_fetch_array($show_outlet))
                                {
                                  echo "<option value='".$outlet['id_outlet']."'>".$outlet['nama_outlet']."</option>";
                                }
                              ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="formFile" class="form-label">Foto User :</label>
                                                            <div>
                                                                <img src="../../../image/user/<?php echo $data_user['foto_profile']; ?>" width="100px">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputFile">File input</label>
                                                            <div class="input-group">
                                                                <input class="form-control" type="file"
                                                                    name="foto_profile">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Upload</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->

                                                    <div class="modal-footer">
                                                        <button type="submit" value="edit"
                                                            class="btn btn-primary">Submit</button>
                                                        <button type="submit" class="btn btn-danger">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                            <?php
                            }
                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>

                            <!-- Modal Add -->
                            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addLabel"
                                aria-hidden="true">

                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header ">
                                            <h3 class="card-title">Add User</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card card-primary">

                                                <!-- /.card-header -->
                                                <!-- form start -->
                                                <form action="<?= BASE_URL?>backend/user/add.php" method="POST"
                                                    enctype="multipart/form-data">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="exampleInputNamaUser">Nama User</label>
                                                            <input type="text" name="nama_user" class="form-control"
                                                                id="exampleInputNamaUser" placeholder="Enter Nama User">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputAlamat">Alamat</label>
                                                            <input type="text" name="alamat" class="form-control"
                                                                id="exampleInputAlamat" placeholder="Enter Alamat">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputTelephone">Telephone</label>
                                                            <input type="text" name="telp" class="form-control"
                                                                id="exampleInputTelephone"
                                                                placeholder="Enter Telephone">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputUsername">Username</label>
                                                            <input type="text" name="username" class="form-control"
                                                                id="exampleInputUsername" placeholder="Enter Username">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword">Password</label>
                                                            <input type="password" name="password" class="form-control"
                                                                id="exampleInputPassword" placeholder="Enter Password">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="role" class="form-label">role :</label>
                                                            <?php
                                                                $arr_role=array('admin'=>'admin','owner'=>'owner','kasir' =>'kasir');
                                                            ?>
                                                            <select name="role" class="form-control form" required>
                                                                <option></option>
                                                                <?php foreach ($arr_role as $key_role => $val_role):?>
                                                                <option value="<?=$key_role?>"><?=$val_role?></option>
                                                                <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="outlet" class="form-label">outlet :</label>
                                                            <select name="id_outlet" class="form-control form" required>
                                                                <option></option>
                                                                <?php
                                include '../../../config/connection.php';
                                $sql = "SELECT * FROM outlet";
                                $show_outlet = mysqli_query($conn,$sql);
                                $no = 1;

                                while ($outlet = mysqli_fetch_array($show_outlet))
                                {
                                  echo "<option value='".$outlet['id_outlet']."'>".$outlet['nama_outlet']."</option>";
                                }
                              ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputFile">File input</label>
                                                            <div class="input-group">
                                                                <input class="form-control" type="file"
                                                                    name="foto_profile">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">Upload</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->

                                                    <div class="modal-footer">
                                                        <button type="submit" value="save"
                                                            class="btn btn-primary">Submit</button>
                                                        <button type="submit" class="btn btn-danger">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>

        <?php
    include '../footer.php'
  ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../../src/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../../src/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../../../src/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../src/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../../src/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../../src/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../../src/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../../src/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../../src/plugins/jszip/jszip.min.js"></script>
    <script src="../../../src/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../../src/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../../src/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../../src/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../../src/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../src/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../../src/dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
    </script>
</body>

</html>