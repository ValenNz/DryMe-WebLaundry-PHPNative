<?php 
$conn = mysqli_connect('localhost', 'root', '','nz_dryme_phpnative');

if(mysqli_connect_errno()){
    printf("Connect failed: %n", mysqli_connect_error());
}  

?>