<?php  
   $host = "localhost";
   $user_name = "root";
   $password = "";
   $database = "latihan"; 
   $koneksi = mysqli_connect($host,$user_name,$password,$database)
              or die("Koneksi database gagal : ". mysqli_connect_error());
?>
