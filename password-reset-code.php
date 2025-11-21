<?php
  session_start();
  include('db.php');

  use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require 'vendor/autoload.php';

   function send_pasword_reset($get_username,$get_email,$token){

     $mail = new PHPMailer(true);
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;  
    // $mail->SMTPDebug = 2;                    //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'zulqarnainc67@gmail.com';                     //SMTP username
    $mail->Password   = 'pniq fonb hius uazc';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('zulqarnainc67@gmail.com', 'zulqarnain');
    $mail->addAddress($get_email);               //Name is optional
   
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Password Notification';
    $email_template = "
      <h2>Password Reset Email </h2><br>
      <a href = 'http://localhost/loginSystem/password-change.php?token=$token&email=$get_email'>Click Me</a>
    ";
    $mail->Body    = $email_template;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'En Email sent to you check it';

    


   }







  if(isset($_POST['reset-password-btn'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $check_email_run = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($check_email_run) > 0){
        $row = mysqli_fetch_array($check_email_run);
        $get_username = $row['username'];
        $get_email = $row['email'];
        $update_token = "UPDATE users SET verify_token = '$token' WHERE email = '$get_email' LIMIT 1";
        $update_token_run = mysqli_query($conn, $update_token);

        if($update_token_run){
            send_pasword_reset($get_username, $get_email, $token);
             $_SESSION['status'] = "we sent an reset email to you";
            

        } else {
            $_SESSION['status'] = "something went wrong";
            header("location: password-reset.php");
            exit();
        }
        
    } else {
        $_SESSION['status'] = "no email found";
        header("location: password-reset.php");
        exit();
    }

    
  }
?>