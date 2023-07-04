<?php
    // include DB connection file
    include '../../config/connection.php';

    // mendapatkan nilai dari form
    $id_outlet=$_POST["id_outlet"];
    $nama_outlet = strtolower(stripslashes($_POST["nama_outlet"]));
    $alamat = strtolower(stripslashes($_POST ["alamat"]));
    $telp = strtolower(stripslashes($_POST ["telp"]));

	// query untuk mengupdate data
        $query = "UPDATE outlet SET nama_outlet='".$nama_outlet."', alamat='".$alamat."', telp='".$telp."' where id_outlet='".$id_outlet."'";

        // menjalankan query update data
        if (mysqli_query($conn, $query))
        {
            echo "<script>alert('Sukses edit outlet');location.href='../../frontend/user/outlet/table.php';</script>";
        }
        else
        {
            echo "<script>alert('Gagal edit outlet');location.href='../../frontend/user/outlet/table.php';</script>";        }

?>