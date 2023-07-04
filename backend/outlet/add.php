<?php
if($_POST){
    require "../../config/connection.php";

    $nama_outlet = strtolower(stripslashes($_POST["nama_outlet"]));
    $alamat = strtolower(stripslashes($_POST["alamat"]));
    $telp = strtolower(stripslashes($_POST["telp"]));


    
        $sql1= "INSERT INTO outlet(nama_outlet,alamat, telp) value ('".$nama_outlet."','".$alamat."','".$telp."')";
        
        $q1         = mysqli_query($conn, $sql1);
        if ($q1) {
            echo "<script>alert('Sukses menambahkan outlet');location.href='../../frontend/user/outlet/table.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan outlet');location.href='../../frontend/user/outlet/table.php';</script>";
        }
    }
    
?>
