<?php
session_start();
include('db.php');
if (isset($_POST['update_password_btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $new_password = mysqli_real_escape_string($conn, $_POST['newpassword']);
    echo $new_password;
    echo "ty";

    $get_user_record = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $get_user_record_run = mysqli_query($conn, $get_user_record);

    if (mysqli_num_rows($get_user_record_run) > 0) {
        echo "<br> user record";
        $row = mysqli_fetch_array($get_user_record_run);
        $get_user =  $row['username'];
        $get_user_password =  $row['password'];
        echo "<br> old password  was $get_user_password";
        echo "<br> new passwor is $new_password";

        $update_user_password = "UPDATE users SET password = '$new_password' WHERE email = '$email' LIMIT 1";
        $update_user_password_run = mysqli_query($conn, $update_user_password);

        echo "<br> password has been updated <br>";

        if (mysqli_affected_rows($conn) > 0) {
            echo "password updated";
            $_SESSION['status'] = "Password Updated Successfully!";
            header('location: dashboard.php');
            exit();
        } else {
            echo "password couldn't change";
            $_SESSION['status'] = "password couldn't be updated try again";
            exit();
        }
    } else {
        echo "problem";
        $_SESSION['status'] = "something went wrong in sql query";
        exit();
    }
} else {
    echo "something went wrong with update form";
}
