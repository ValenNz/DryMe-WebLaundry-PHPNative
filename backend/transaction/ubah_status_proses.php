<?php
    include "../../config/connection.php";
    $get_order = mysqli_query($conn, "select * from transaksi where id_transaksi = '".$_GET['id_transaksi']."'");
    $status_order = mysqli_fetch_array($get_order);
    if ($status_order['status_order'] != NULL) {
        $update_status = mysqli_query($conn, "update transaksi set status_order = '".$_GET['status_order']."' where id_transaksi = '".$_GET['id_transaksi']."'");
        echo "<script>alert('Sukses mengupdate status bayar');location.href='../../frontend/user/transaction/table.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate status bayar');location.href='../../frontend/user/transaction/table.php';</script>";    
    }
?>