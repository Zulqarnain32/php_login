<?php
  include('components/navbar.php');
  include('authentication.php');    
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
    <div class = "flex items-center justify-center h-screen text-center">
        <div>
            <h1 class = "text-4xl mb-4 font-semibold">Dashboard Page</h1>
            <p class = "text-2xl">Only Logged in User can visit this page</p>
        </div>
    </div>
</body>
</html>