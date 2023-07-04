<?php
    include "../../config/connection.php";
    $update_status = mysqli_query($conn, "update transaksi set status_bayar = 'lunas', tgl_bayar = '".date('Y-m-d')."' where id_transaksi = '".$_GET['id_transaksi']."'");
    if ($update_status) {
        echo "<script>alert('Sukses mengupdate status bayar');location.href='../../frontend/user/transaction/table.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate status bayar');location.href='../../frontend/user/transaction/table.php';</script>";
    }
?>