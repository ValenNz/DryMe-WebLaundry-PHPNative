<?php 
    if($_POST){
        $username=$_POST['username'];
        $password=$_POST['password'];
        if(empty($username)){
            echo "<script>alert('Username tidak boleh kosong');location.href='../frontend/login.php';</script>";
        } elseif(empty($password)){
            echo "<script>alert('Password tidak boleh kosong');location.href='../frontend/login.php';</script>";
        } else {    
            include "../config/connection.php";
            $qry_login=mysqli_query($conn,"select * from user where username = '".$username."' and password = '".md5($password)."'");
            if(mysqli_num_rows($qry_login)>0){
                $dt_login=mysqli_fetch_array($qry_login);
                session_start();
                $_SESSION['id_user']=$dt_login['id_user'];
                $_SESSION['id_outlet']=$dt_login['id_outlet'];
                $_SESSION['nama_user']=$dt_login['nama_user'];
                $_SESSION['username']=$dt_login['username'];
                $_SESSION['alamat']=$dt_login['alamat'];
                $_SESSION['telp']=$dt_login['telp'];
                $_SESSION['role']=$dt_login['role'];
                $_SESSION['foto_profile']=$dt_login['foto_profile'];
                $_SESSION['status_login']=true;
                header("location: ../frontend/user/dashboard.php");
            } else {
                echo "<script>alert('Username dan Password tidak benar');location.href='../frontend/login.php';</script>";
            }
        }
    }
?>