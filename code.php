<?php
  session_start();
  include('db.php');

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  //Load Composer's autoloader (created by composer, not included with PHPMailer)
  require 'vendor/autoload.php';

  function sendemail_verify($username,$email,$verify_token){
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
    $mail->addAddress($email);               //Name is optional
   
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification From Zulqarnain';
    $email_template = "
      <h2>Verify your email with the below given link</h2><br>
      <a href = 'http://localhost/loginSystem/verify-email.php?token=$verify_token'>Click Me</a>
    ";
    $mail->Body    = $email_template;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} 

  if(isset($_POST['register_btn'])){
     $username = $_POST['username'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     $verify_token = md5(rand());
   

     //check email exists or not
     $check_email_query = "SELECT email FROM users WHERE email = '$email' LIMIT 1" ;
     $check_email_query_run = mysqli_query($conn, $check_email_query);

     if(mysqli_num_rows($check_email_query_run) > 0){
        $_SESSION['status'] = "Email ID Already Exists";
        header('location: /loginSystem/register.php');
     } else {
      //insert user into database
      $query = "INSERT INTO users (username,email,password,verify_token) VALUES ('$username','$email','$password','$verify_token')";
      $query_run = mysqli_query($conn, $query);

      if($query_run){
        sendemail_verify("$username","$email","$verify_token");
        $_SESSION['status'] = "Registeratin successfull! Please verify your email address";
        header('location: /loginSystem/register.php');
      } else {
        $_SESSION['status'] = "Registeration Failed";
        header('location: /loginSystem/register.php');
      }
     }

  }
?>