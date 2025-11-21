<?php
include('authentication.php');
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
    <div class = "flex items-center justify-center h-[calc(100vh-100px)]  text-center">
        <div>
            <h1 class = "text-4xl mb-4 font-semibold">Dashboard Page</h1>
            <p class = "text-2xl">Only Logged in User can visit this page</p>
            <div class = "text-2xl semibold">
                <h1>Username: <?=  $_SESSION['auth_user']['username']; ?></h1>
                <h1>Email: <?=  $_SESSION['auth_user']['email']; ?></h1>
                <h1>Password: <?=  $_SESSION['auth_user']['password']; ?></h1>
            </div>
        </div>
    </div>
</body>
</html>