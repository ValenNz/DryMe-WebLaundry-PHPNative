<?php
    if ($_GET['id_user']) {
        require '../../config/connection.php';
        $qry_hapus=mysqli_query($conn, "delete from user where id_user='".$_GET['id_user']."'");
        if ($qry_hapus) {
            echo "<script>alert ('Sukses hapus user'); location.href='../../frontend/user/user/table.php';</script>";
        }else {
            echo "<script>alert ('Gagal hapus user'); location.href='../../frontend/user/user/table.php';</script>";
        }
    }
?> 