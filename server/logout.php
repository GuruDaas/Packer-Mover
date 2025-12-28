<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logging Out...</title>
    <meta http-equiv="refresh" content="3;url=index.php"> <!-- 3 sec me redirect -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
        <h1 class="text-3xl font-bold text-green-600 mb-4">Successfully Logged Out!</h1>
        <p class="text-gray-700 mb-6">You will be redirected to the login page shortly...</p>

        <a href="./frontend/" class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
            Go to Login Now
        </a>
    </div>

</body>
</html>
