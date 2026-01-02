<?php
session_start();
require_once '../server/config/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $message = "Please fill in all fields.";
    } else {
        // Query to check user
        $query = "SELECT * FROM users WHERE LOWER(email) = :email AND password = :password";
        $stmt = oci_parse($conn, $query);
        oci_bind_by_name($stmt, ":email", $email);
        oci_bind_by_name($stmt, ":password", $password);
        oci_execute($stmt);

        $row = oci_fetch_assoc($stmt);

        if ($row) {
            $_SESSION['email'] = $email;
            oci_free_statement($stmt);
            oci_close($conn);

            // Redirect to booking page (Using existing file, assuming new_booking.php is the target based on file list)
            header("Location: new_booking.php"); 
            exit();
        } else {
            $message = "Incorrect email or password.";
        }
        oci_free_statement($stmt);
    }
    oci_close($conn);
}
?>
<?php include 'includes/header.php'; ?>

<div class="min-h-[calc(100vh-200px)] flex flex-col items-center justify-center py-12 px-4 bg-gray-50">
  <div class="max-w-md w-full bg-white rounded-xl shadow-2xl overflow-hidden">
    <div class="bg-red-600 py-6 text-center">
        <h2 class="text-white text-2xl font-bold">Welcome Back</h2>
        <p class="text-red-100 text-sm">Sign in to your account</p>
    </div>
    
    <div class="p-8">
      <?php if (!empty($message)): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
            <p class="font-bold">Error</p>
            <p><?= $message ?></p>
        </div>
      <?php endif; ?>

      <form class="space-y-6" method="POST" action="">
        <div>
          <label class="text-gray-700 text-sm font-bold mb-2 block">Email Address</label>
          <input name="email" type="email" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition outline-none" placeholder="you@example.com" />
        </div>

        <div>
          <label class="text-gray-700 text-sm font-bold mb-2 block">Password</label>
          <input name="password" type="password" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-red-500 focus:ring-2 focus:ring-red-200 transition outline-none" placeholder="••••••••" />
        </div>

        <div>
          <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg shadow-md transition transform hover:scale-[1.02]">
            Sign In
          </button>
        </div>

        <div class="text-center mt-4 border-t pt-4">
          <p class="text-sm text-gray-600">
            Don't have an account?
            <a href="register.php" class="text-red-600 hover:text-red-800 font-bold hover:underline">Register here</a>
          </p>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
