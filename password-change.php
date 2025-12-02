<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
     <div>
        <div class="flex items-center justify-center  h-screen">
            <form action="change-password-code.php" method="POST" class="border border-gray-300 rounded-lg shadow-md p-4 w-[300px] mt-14">
                <h1 class="text-center text-2xl font-semibold mb-3">Update Password</h1>
                 <h2>Email</h2>
                <input
                    type="email"
                    placeholder="Email"
                    name="email"
                    class="mt-1 mb-3 w-full px-3 py-1 text-[16px] border border-gray-300">
               
                <h2>New Password</h2>
                <input
                    type="password"
                    placeholder="Password"
                    name="newpassword"
                    class="mt-1 mb-3 w-full px-3 py-1 text-[16px] border border-gray-300">
                <!-- reset password checking credentials form message  -->
                     <?php
                      if(isset($_SESSION['status'])){
                          echo $_SESSION['status'];
                          unset($_SESSION['status']);
                      }
                     ?>
                <input 
                    type="submit" 
                    name="update_password_btn" 
                    value="Update Password" 
                    class="text-white bg-blue-500 hover:bg-blue-700 px-3 py-1 cursor-pointer my-5 w-full">
              <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
              <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">

            </form>
        </div>
</body>
</html>