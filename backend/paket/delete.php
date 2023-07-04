<?php
    if ($_GET['id_paket']) {
        require '../../config/connection.php';
        $qry_hapus=mysqli_query($conn, "delete from paket where id_paket='".$_GET['id_paket']."'");
        if ($qry_hapus) {
            echo "<script>alert ('Sukses hapus paket'); location.href='../../frontend/user/paket/table.php';</script>";
        }else {
            echo "<script>alert ('Gagal hapus paket'); location.href='../../frontend/user/paket/table.php';</script>";
        }
    }
?> 