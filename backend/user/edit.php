<?php
    // include DB connection file
    include '../../config/connection.php';

    // mendapatkan nilai dari form
    $id_user=$_POST["id_user"];
    $nama_user = strtolower(stripslashes($_POST["nama_user"]));
    $alamat = strtolower(stripslashes($_POST ["alamat"]));
    $telp = strtolower(stripslashes($_POST ["telp"]));
    $username = strtolower(stripslashes($_POST ["username"]));
    $password = strtolower(stripslashes($_POST ["password"]));
    $role = strtolower(stripslashes($_POST ["role"]));
    $id_outlet=$_POST["id_outlet"];

    $nama_folder    = "image/user";
    $file_name      = $_FILES["foto_profile"]["name"];
    $tmp            = $_FILES["foto_profile"]["tmp_name"];
    $path           = "../../$nama_folder/$file_name";
    $tipe_file      = array("image/jpeg","image/png","image/jpg");

    // $query = "UPDATE user SET nama_user='".$nama_user.", alamat='".$alamat."', telp='".$telp."', username='".$username."', password='".$password."',id_outlet='".$id_outlet."', role='".$role."' where id_user='".$id_user."'";

    // syarat upload foto
    if(!in_array($_FILES["foto_profile"]["type"],$tipe_file) && $file_name != "")
    {
        echo "<script>alert('Cek kembali ekstensi file anda (*.jpg,*.gif,*.png)');location.href='../../frontend/user/user/table.php';</script>";
    }
    else if(in_array($_FILES["foto_profile"]["type"],$tipe_file) && $file_name != "")
    {
        // jika foto_profile diubah
        $query_foto_profile = "SELECT foto_profile FROM user WHERE id_user = $id_user";
        $result       = mysqli_query($conn, $query_foto_profile);
        $hasil        = mysqli_fetch_assoc($result);
        $foto_profile       = $hasil['foto_profile'];

        // menghapus foto_profile lama
        unlink('../../image/user/'. $foto_profile);
        
        // upload foto_profile baru
        move_uploaded_file($tmp,$path);
        
        // query untuk mengupdate data + foto_profile
	    $query = "UPDATE user SET nama_user='".$nama_user."', alamat='".$alamat."', telp='".$telp."', username='".$username."', password='".md5($password)."', id_outlet='".$id_outlet."', role='".$role."', foto_profile='".$file_name."' where id_user='".$id_user."'";

        // menjalankan query isi data
        if (mysqli_query($conn, $query))
        {
            echo "<script>alert('Sukses edit data');location.href='../../frontend/user/user/table.php';</script>";
        }
        else
        {
            echo "<script>alert('Gagal edit data');location.href='../../frontend/user/user/table.php';</script>";
        }
    }
    else if($file_name == "")
    {
	// query untuk mengupdate data
        $query = "UPDATE user SET nama_user='".$nama_user."', alamat='".$alamat."', telp='".$telp."', username='".$username."', password='".md5($password)."', id_outlet='".$id_outlet."', role='".$role."' where id_user='".$id_user."'";

        // menjalankan query update data
        if (mysqli_query($conn, $query))
        {
            echo "<script>alert('Sukses edit data');location.href='../../frontend/user/user/table.php';</script>";
        }
        else
        {
            echo "<script>alert('Gagal edit data');location.href='../../frontend/user/user/table.php';</script>";        }
    }

    mysqli_close($conn);
?>