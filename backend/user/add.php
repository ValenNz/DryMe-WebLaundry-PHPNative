<?php
if($_POST){
    require "../../config/connection.php";

    $nama_user = strtolower(stripslashes($_POST["nama_user"]));
    $alamat = strtolower(stripslashes($_POST["alamat"]));
    $telp = strtolower(stripslashes($_POST["telp"]));
    $username = strtolower(stripslashes($_POST["username"]));
    $password = strtolower(stripslashes($_POST ["password"]));
    $role = strtolower(stripslashes($_POST["role"]));
    $id_outlet = strtolower(stripslashes($_POST["id_outlet"]));
    $file_name  = "";


    if($_FILES['foto_profile']['name']){
        $file_name = $_FILES['foto_profile']['name'];
        $foto_file = $_FILES['foto_profile']['tmp_name'];

        $detail_file = pathinfo($file_name);
        $foto_ekstensi = $detail_file['extension'];
        // Array ( [dirname] => . [basename] => Romi Satrio Wahono.jpg [extension] => jpg [filename] => Romi Satrio Wahono )
        $ekstensi_yang_diperbolehkan = array("jpg","jpeg","png","gif");
        if(!in_array($foto_ekstensi,$ekstensi_yang_diperbolehkan)){
            $error = "Ekstensi yang diperbolehkan adalah jpg, jpeg, png dan gif";
        }

    }

    if (empty($error)) {
        if($file_name){
            $direktori = "../../image/user/";

            @unlink($direktori."/$foto"); //delete data

            $file_name = "user".time()."_".$file_name;
            move_uploaded_file($foto_file,$direktori."/".$file_name);

            $foto = $file_name;
        }else {
            $default = '../../image/user/default_picture_user.jpeg';
            $default = $file_name;

        }

        $sql1= "INSERT INTO user(nama_user,alamat, telp, username, password,id_outlet, role, foto_profile) value ('".$nama_user."','".$alamat."','".$telp."','".$username."','".md5($password)."','".$id_outlet."','".$role."','".$file_name."')";
        
        $q1         = mysqli_query($conn, $sql1);
        if ($q1) {
            echo "<script>alert('Sukses menambahkan user');location.href='../../frontend/user/user/table.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan user');location.href='../../frontend/user/user/table.php';</script>";
        }
    }
}
    
?>
