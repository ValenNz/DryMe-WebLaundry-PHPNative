<?php
    session_start();
    include "../../config/connection.php";
   

    if ( $cart=@$_SESSION['cart'] === null) {
        echo '<script>alert("Pembelian gagal");location.href="../../frontend/user/transaction/table.php"</script>';
    } 
    
    if($cart=@$_SESSION['cart']){
        $id_costumer = $_POST['id_costumer'];
        if(count($cart)>0 and $id_costumer != NULL){
            $tgl_bayar=5; //satuan hari
            $tgl_harus_bayar=date('Y-m-d',mktime(0,0,0,date('m'),(date('d')+$tgl_bayar),date('Y')));
            mysqli_query($conn,"INSERT INTO transaksi (id_outlet, id_costumer, id_user, tgl_transaksi, batas_waktu, tgl_bayar, status_bayar, status_order) VALUES ('".$_SESSION['id_outlet']."', '".$id_costumer."', '".$_SESSION['id_user']."', '".date('Y-m-d')."','".$tgl_harus_bayar."', '".date('Y-m-d')."', 'belum lunas', 'baru')");
            $id=mysqli_insert_id($conn);
            foreach ($cart as $key_produk => $val_produk) {
                mysqli_query($conn,"INSERT INTO detail_transaksi(id_transaksi, id_paket, qty) VALUES ('".$id."','".$val_produk['id_paket']."', '".$val_produk['qty']."')");
            }
            unset($_SESSION['cart']);
                echo '<script>alert("Pembelian berhasil");location.href="../../frontend/user/transaction/table.php"</script>';
        }else {
            echo '<script>alert("Belum diisi semua");location.href="../../frontend/user/transaction/table.php"</script>';
        }
    }
?>