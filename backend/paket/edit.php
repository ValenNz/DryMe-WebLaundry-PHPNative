<?php
    // include DB connection file
    include '../../config/connection.php';

    // mendapatkan nilai dari form
    $id_paket=$_POST["id_paket"];
    $nama_paket = strtolower(stripslashes($_POST["nama_paket"]));
    $jenis = strtolower(stripslashes($_POST ["jenis"]));
    $harga = strtolower(stripslashes($_POST ["harga"]));

	// query untuk mengupdate data
        $query = "UPDATE paket SET nama_paket='".$nama_paket."', jenis='".$jenis."', harga='".$harga."' where id_paket='".$id_paket."'";

        // menjalankan query update data
        if (mysqli_query($conn, $query))
        {
            echo "<script>alert('Sukses edit paket');location.href='../../frontend/user/paket/table.php';</script>";
        }
        else
        {
            echo "<script>alert('Gagal edit paket');location.href='../../frontend/user/paket/table.php';</script>";        }

?>