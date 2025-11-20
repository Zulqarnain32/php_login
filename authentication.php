<?php
  session_start();
  if(!isset($_SESSION['autheticated'])){
    $_SESSION['status'] = "please login to visit dashboard page";
    header("location: /loginSystem/login.php");

  } else {
    echo "not authenticated";
  }
?>