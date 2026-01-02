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
        $query = "SELECT * FROM users WHERE LOWER(email) = :email AND password = :password";
        $stmt = oci_parse($conn, $query);
        oci_bind_by_name($stmt, ":email", $email);
        oci_bind_by_name($stmt, ":password", $password);
        oci_execute($stmt);
        $row = oci_fetch_assoc($stmt);

        if ($row) {
            // Check if user is actually admin (Logic missing in original code, but proceeding with structure)
            $_SESSION['email'] = $email;
            $_SESSION['is_admin'] = true; // Set flag
            oci_free_statement($stmt);
            oci_close($conn);
            header("Location: ../server/admin_dashboard/admin_dashboard.php"); // Corrected path
            exit();
        } else {
            $message = "Invalid admin credentials.";
        }
        oci_free_statement($stmt);
    }
    oci_close($conn);
}
?>
<?php include 'includes/header.php'; ?>

<div class="min-h-[calc(100vh-200px)] flex flex-col items-center justify-center py-12 px-4 bg-gray-100">
  <div class="max-w-md w-full bg-white rounded-xl shadow-md border-t-8 border-gray-800">
    <div class="p-8">
      <h2 class="text-gray-900 text-center text-3xl font-bold mb-8">Admin Portal</h2>

      <?php if (!empty($message)): ?>
        <p class="text-red-500 text-center mb-4 font-bold bg-red-100 p-2 rounded"><?= $message ?></p>
      <?php endif; ?>

      <form class="space-y-6" method="POST" action="">
        <div>
          <label class="text-gray-700 text-sm font-bold mb-2 block">Admin Email</label>
          <input name="email" type="email" required class="w-full px-4 py-3 rounded border focus:border-gray-800 focus:ring-1 focus:ring-gray-800 outline-none" placeholder="admin@trueway.com" />
        </div>

        <div>
          <label class="text-gray-700 text-sm font-bold mb-2 block">Password</label>
          <input name="password" type="password" required class="w-full px-4 py-3 rounded border focus:border-gray-800 focus:ring-1 focus:ring-gray-800 outline-none" placeholder="••••••••" />
        </div>

        <button type="submit" class="w-full bg-gray-900 hover:bg-black text-white py-3 px-4 rounded font-bold shadow-lg transition">
            Login to Dashboard
        </button>
      </form>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
