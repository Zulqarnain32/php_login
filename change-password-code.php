<?php
session_start();
include('db.php');

if (isset($_POST['update_password_btn'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = mysqli_real_escape_string($conn, $_POST['newpassword']);
    $token = mysqli_real_escape_string($conn, $_POST['token']);

    // Check if token exists and not expired
    $query = "SELECT * FROM users 
              WHERE email='$email' AND verify_token='$token'
              LIMIT 1";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {

        $row = mysqli_fetch_array($query_run);

        // Check expiry
        if (strtotime($row['reset_token_expire']) < time()) {
            $_SESSION['status'] = "Your reset link has expired!";
            header("location: password-reset.php");
            exit();
        }

        // Update password
        $update_password = "UPDATE users 
                            SET password='$new_password', 
                                verify_token=NULL,
                                reset_token_expire=NULL 
                            WHERE email='$email' LIMIT 1";

        $update_password_run = mysqli_query($conn, $update_password);

        if ($update_password_run) {
            $_SESSION['status'] = "Password updated successfully!";
            header("location: dashboard.php");
            exit();
        } else {
            $_SESSION['status'] = "Error updating password!";
            header("location: password-change.php?token=$token&email=$email");
            exit();
        }

    } else {
        $_SESSION['status'] = "Invalid or used token!";
        header("location: password-reset.php");
        exit();
    }

} else {
    $_SESSION['status'] = "Unauthorized access!";
    header("location: password-reset.php");
    exit();
}
