<?php
session_start();
include('components/navbar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class = "flex items-center justify-center h-[calc(100vh-70px)]">
        <form action="password-reset-code.php" method = "POST" class="border border-gray-300 shadow-md p-4 w-[400px]">
            <h1 class = "text-center text-3xl mb-3">Reset Password</h1>
              <!-- reset message  -->
                     <?php
                      if(isset($_SESSION['status'])){
                          echo $_SESSION['status'];
                          unset($_SESSION['status']);
                      }
                     ?>
            <h2>Email </h2>
            <input
                type="email"
                placeholder="Email"
                name="email"
                class="mt-1 mb-3 w-full px-3 py-1 text-[16px] border border-gray-300">
            <input type="submit" value = "Send" name = "reset-password-btn" class="bg-blue-400 w-full px-3 py-1 text-white cursor-pointer rounded-md">    
        </form>
    </div>
</body>

</html>