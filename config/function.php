<?php 
include 'connection.php';

function user_foto($id_user){
    $sql1   = "select * from user where id_user = '$id_user'";
    $q1     = mysqli_query($conn,$sql1);
    $data_user     = mysqli_fetch_array($q1);
    $foto_profile   = $data_user['foto_profile'];

    if($foto_profile){
        return $foto_profile;
    }else{
        return 'user_default_picture.png';
    }
}
?>

