<?php
if($_POST){
    require "../../config/connection.php";

    $nama_paket = strtolower(stripslashes($_POST["nama_paket"]));
    $jenis = strtolower(stripslashes($_POST["jenis"]));
    $harga = strtolower(stripslashes($_POST["harga"]));


    
        $sql1= "INSERT INTO paket(nama_paket,jenis, harga) value ('".$nama_paket."','".$jenis."','".$harga."')";
        
        $q1         = mysqli_query($conn, $sql1);
        if ($q1) {
            echo "<script>alert('Sukses menambahkan paket');location.href='../../frontend/user/paket/table.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan paket');location.href='../../frontend/user/paket/table.php';</script>";
        }
    }
    
?>
