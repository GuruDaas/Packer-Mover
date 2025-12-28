<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = oci_connect('c##aman', 'root', "//localhost:1521/XE");
if (!$conn) {
    $e = oci_error();
    die("Connection failed: " . htmlentities($e['message']));
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname    = $_POST['fname'] ?? '';
    $lname    = $_POST['lname'] ?? '';
    $email    = $_POST['email'] ?? '';
    $mobile   = $_POST['mobile'] ?? '';
    $password = $_POST['password'] ?? '';

    $query = "INSERT INTO users (first_name, last_name, email, mobile, password)
              VALUES (:fname, :lname, :email, :mobile, :password)";

    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ":fname", $fname);
    oci_bind_by_name($stmt, ":lname", $lname);
    oci_bind_by_name($stmt, ":email", $email);
    oci_bind_by_name($stmt, ":mobile", $mobile);
    oci_bind_by_name($stmt, ":password", $password); // 🔐 You can later hash it

    if (oci_execute($stmt)) {
        $message = "Registration successful! You can now <a href='login.php' class='text-blue-600 underline'>Login</a>";
    } else {
        $e = oci_error($stmt);
        $message = "Error: " . htmlentities($e['message']);
    }

    oci_free_statement($stmt);
    oci_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body class="bg-white">

<!-- ✅ Header and Navbar code (same as your existing header) -->
<!-- ... Copy/paste from your existing HTML header + navbar code here ... -->

<div class="min-h-screen items-center justify-center px-4 mt-6">
  <div class="w-full max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-md">

    <h2 class="text-center text-2xl font-bold mb-6">Create your account</h2>

    <?php if (!empty($message)): ?>
      <p class="text-center text-red-600 mb-4"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
          <input type="text" name="fname" required placeholder="Enter name" class="w-full px-4 py-3 bg-gray-100 rounded-md outline-none" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
          <input type="text" name="lname" required placeholder="Enter last name" class="w-full px-4 py-3 bg-gray-100 rounded-md outline-none" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input type="email" name="email" required placeholder="Enter email" class="w-full px-4 py-3 bg-gray-100 rounded-md outline-none" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Mobile</label>
          <input type="tel" name="mobile" required placeholder="Enter mobile number" class="w-full px-4 py-3 bg-gray-100 rounded-md outline-none" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <input type="password" name="password" required placeholder="Enter password" class="w-full px-4 py-3 bg-gray-100 rounded-md outline-none" />
        </div>
      </div>

      <div class="text-center mt-8">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium">
          Sign Up
        </button>
      </div>

      <p class="text-center text-sm text-gray-700 mt-4">
        Already have an account?
        <a href="login.php" class="text-blue-600 hover:underline font-medium">Login</a>
      </p>
    </form>
  </div>
</div>

</body>
</html>