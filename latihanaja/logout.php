<?php 
  session_start();
  session_destroy();
  print "Thank you ...";
  header("location:Login.php");
?>a