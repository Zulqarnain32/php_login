<?php
 session_start();
 include('db.php');
 if(isset($_POST['login-btn'])){

    if(!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
        $login_query_run = mysqli_query($conn, $login_query);

        if(mysqli_num_rows($login_query_run) > 0){
            $row = mysqli_fetch_array($login_query_run);
            // echo $row['verify_status'];
            if($row['verify_status'] == "1"){
                echo "you are a verified user";
                $_SESSION['autheticated'] = TRUE;
                $_SESSION['auth_user'] = [
                    'username' => $row['username'],
                    'email' => $row['email'],
                    'password' => $row['password']
                ];

                $_SESSION['status'] = "User Login Successfully";
                header("location: /loginSystem/dashboard.php");


            } else {
                $_SESSION['status'] = "Please verify your email first";
                header("location: /loginSystem/login.php");

            }


        } else {
            $_SESSION['status'] = "invalid email or password";
            header("location: /loginSystem/login.php");
        }


    } else {
        $_SESSION['status'] = "all fields are required";
        // header("location: /loginSystem/login.php");
    }
  

 } else {
    echo "login button error";
 }
?>