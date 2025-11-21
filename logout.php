<?php
 session_start();
 unset($_SESSION['autheticated']);
 unset($_SESSION['auth_user']);
 echo "you are successfully logout";
 header("location: login.php");
 exit(0);
?>