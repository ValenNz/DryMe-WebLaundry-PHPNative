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
                                <li class="breadcrumb-item active">Data transaction</li>
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
                                                class="fa fa-user-plus"></i> Add Transacrion</button>
                                                
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Telephone</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Paket Laundry - Qty - Harga</th>
                                                <th scope="col">Total Harga</th>
                                                <th scope="col">Tanggal Transaksi</th>
                                                <th scope="col">Batas Waktu</th>
                                                <th scope="col">Tanggal Bayar</th>
                                                <th scope="col">Status Bayar</th>
                                                <th scope="col">Status Paket</th>
                                                <th scope="col">Aksi</th>
                                                <th scope="col">Nota</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                      require '../../../config/connection.php';

                      $qry_histori = mysqli_query($conn, "SELECT transaksi.*, costumer.*, user.* from transaksi join user ON user.id_user = transaksi.id_user join costumer ON costumer.id_costumer = transaksi.id_costumer order by id_transaksi desc ");
                      $no = 0;

                      while ($dt_histori = mysqli_fetch_array($qry_histori)) {
                        $total = 0;

                        $no++;
                        $paket_dibeli = "<ol>";
                        $qry_paket = mysqli_query($conn,"SELECT * from  detail_transaksi join paket on paket.id_paket=detail_transaksi.id_paket where id_transaksi = ".$dt_histori['id_transaksi']);
                        while($dt_paket=mysqli_fetch_array($qry_paket)){ //perulangan untuk menampilkan detail transaksi dan subtotalnmya
                            $subtotal = 0;
                            $subtotal += $dt_paket['harga'] * $dt_paket['qty'];
                            $paket_dibeli .= "<li>".$dt_paket['nama_paket']."&nbsp;&nbsp;-&nbsp;&nbsp;".$dt_paket['qty']."&nbsp;&nbsp;-&nbsp;&nbsp;"."Rp. ".number_format($subtotal, 2, ',', '.').""."</li>";
                            $total += $dt_paket['harga'] * $dt_paket['qty'];
                        }
                        $paket_dibeli.="</ol>";
                    ?>
                                            <tr>    
                                                <th><?= $no ?></th>
                                                <td><?= $dt_histori["nama_costumer"]?></td>
                                                <td><?= $dt_histori["telp"]?></td>
                                                <td><?= $dt_histori["alamat"]?></td>
                                                <td><?= $paket_dibeli?></td>
                                                <td><?= $total?></td>
                                                <td><?= $dt_histori["tgl_transaksi"]?></td>
                                                <td><?= $dt_histori["batas_waktu"]?></td>
                                                <td><?= $dt_histori["tgl_bayar"]?></td>
                                                <td><?= $dt_histori['status_bayar']?></td>
                                                    <td><?= $dt_histori['status_order']?></td>
                                                <td>
                            <?php
                            if ($dt_histori['status_bayar'] == "belum lunas") {
                            ?>
                            <a href="<?= BASE_URL?>backend/transaction/ubah_status_lunas.php?id_transaksi=<?=$dt_histori['id_transaksi']?>"><button>Lunas</button></a> | 
                            <?php
                            } else {
                            ?>
                            <a href="#"><button class = "done">✔</button></a> | 
                            <?php
                            }
                            ?>
                            <?php
                            if ($dt_histori['status_order'] == "baru") {
                            ?>
                            <a href="<?= BASE_URL?>backend/transaction/ubah_status_proses.php?id_transaksi=<?=$dt_histori['id_transaksi']?>&status_order=diproses" class = "proses"><button>Diproses</button></a>
                            <?php
                            } elseif ($dt_histori['status_order'] == "diproses") {
                            ?>
                            <a href="<?= BASE_URL?>backend/transaction/ubah_status_proses.php?id_transaksi=<?=$dt_histori['id_transaksi']?>&status_order=selesai" class = "selesai"><button>Selesai</button></a>
                            <?php
                            } elseif ($dt_histori['status_order'] == "selesai") {
                            ?>
                            <a href="<?= BASE_URL?>backend/transaction/ubah_status_proses.php?id_transaksi=<?=$dt_histori['id_transaksi']?>&status_order=diambil" class = "ambil" ><button>Diambil</button></a>
                            <?php
                            } elseif ($dt_histori['status_order'] == "diambil") {
                            ?>
                            <a href="#"><button class = "done">✔</button></a>
                            <?php
                            }
                            ?>
                        </td>
                        <?php
                        if ($dt_histori['status_bayar'] == "lunas" and $dt_histori['status_order'] == "diambil") {
                        ?>
                        <td><a href="<?= BASE_URL?>backend/transaction/nota.php?id_transaksi=<?=$dt_histori['id_transaksi']?>"><button>✔</button></a></td>
                        <?php
                        } else {
                        ?>
                        <td><button>❌</button></td>
                        <?php
                            }
                        ?>     
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
                                                                $arr_role=array('admin'=>'admin','petugas'=>'petugas','kasir' =>'kasir');
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
                                            <h3 class="card-title">Add transaction</h3>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card card-primary">

                                                <!-- /.card-header -->
                                                <!-- form start -->
                                                <form action="<?= BASE_URL?>backend/transaction/add.php" method="POST"
                                                    enctype="multipart/form-data">
                                                   
                                                    <table id="example1" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">No</th>
                                                                <th scope="col">Nama Paket</th>
                                                                <th scope="col">Harga</th>
                                                                <th scope="col">Qty</th>
                                                                <th scope="col">Total Harga</th>
                                                                <th scope="col">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        $total = 0;
                                                        if (@$_SESSION['cart']){
                                                        foreach ($_SESSION['cart'] as $key_paket => $val_paket): 
                                                            $subtotal = $val_paket['qty'] * $val_paket['harga'];
                                                            $total += $subtotal;
                                                        ?>
                                                        <tbody>
                                                            <tr>
                                                                <td class = "no"><?=($key_paket+1)?></td>
                                                                <td class = "nama"><?=$val_paket['nama_paket']?></td>
                                                                <td class = "harga">
                                                                    <?php
                                                                        echo "Rp. ".number_format($val_paket['harga'], 2, ',', '.')."";
                                                                    ?>
                                                                </td>
                                                                <td><?=$val_paket['qty']?></td>
                                                                <td>
                                                                    <?php
                                                                        echo "Rp. ".number_format($val_paket['total_harga'], 2, ',', '.')."";
                                                                    ?>
                                                                </td>
                                                                <td class = "x"><a href="hapus_cart.php?id_paket=<?=$key_paket?>" onclick = "return confirm('Anda yakin menghapus ini?');"><strong>X</strong></a></td>
                                                            </tr>
                                                            <?php endforeach ?>
                                                            <tr>
                                                                <td colspan = "3">Total</td>
                                                                <td colspan = "3">
                                                                    <?php
                                                                        echo "Rp. ".number_format($total, 2, ',', '.')."";
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>

                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="exampleInputPaket">Paket</label>
                                                            <?php
                                                                    include "../../../config/connection.php";
                                                                    $qry_paket=mysqli_query($conn,"select * from paket");
                                                                    while($data_paket=mysqli_fetch_array($qry_paket)){?>
                                                                    <form action="<?= BASE_URL?>backend/transaction/add.php" method="post">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title"><?=$data_paket['nama_paket']?></h5>
                                                                            <p class="card-text">
                                                                                <?php
                                                                                    echo "Rp. ".number_format($data_paket['harga'], 2, ',', '.')."";
                                                                                ?>
                                                                            </p>
                                                                            <input type="hidden" name = "id_paket" value = "<?=$data_paket['id_paket']?>">
                                                                            <input class = "jml" type="number" min = "1" value = "1" name = "jml_beli"><br>
                                                                            <input class = "button" type="submit" value = "Tambah">
                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                <?php
                                                                    }
                                                                ?>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputCostumer">Costumer</label>
                                                                    <form action="<?= BASE_URL?>backend/transaction/checkout.php" method = "post">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                            <select name="id_costumer" id="">
                                                                            <option value=""></option>
                                                                            <?php
                                                                                include "../../../config/connection.php";
                                                                                $qry_costumer=mysqli_query($conn,"select * from costumer");
                                                                                $no=0;
                                                                                while($data_costumer=mysqli_fetch_array($qry_costumer)){
                                                                                $no++;?>
                                                                                <option value="<?=$data_costumer['id_costumer']?>"><?=$data_costumer['nama_costumer']?></option>
                                                                            <?php
                                                                                }
                                                                            ?>
                                                                            </select> <br> <br>
                                                                            
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                        <button type="submit" value="save"
                                                            class="btn btn-primary">Submit</button>
                                                        <button type="submit" class="btn btn-danger">Close</button>
                                                    </div>
                                                                    </form>
                                                            </div>
                                                        </div>
                                                    <!-- /.card-body -->

                                                   
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