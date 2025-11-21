
<?php
session_start();

if (!isset($_SESSION['autheticated'])) {
    $_SESSION['status'] = "Please login to visit dashboard page";
    header("Location: login.php");
    exit();
}
?>

