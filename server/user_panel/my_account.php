<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ./my_request.php");
    exit();
}

// ✅ Database connection (no return here!)
$conn = oci_connect('c##aman', 'root', "//localhost:1521/XE"); 
if (!$conn) {
    $e = oci_error();
    echo "Failed to connect to Oracle: " . $e['message'];
    exit();
}

$message = ""; // For user feedback
$success = false; // To track successful insertion

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Input validation
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $mobile = preg_match('/^\d{10}$/', $_POST['mobile'] ?? '') ? $_POST['mobile'] : null;
    $service_location = htmlspecialchars($_POST['service_location'] ?? '');
    $shifting_location = htmlspecialchars($_POST['shifting_location'] ?? '');
    $shifting_date = htmlspecialchars($_POST['shifting_date'] ?? '');
    $shift_type = htmlspecialchars($_POST['shift_type'] ?? '');
    $items_to_shift = htmlspecialchars($_POST['items_to_shift'] ?? '');
    $professional = htmlspecialchars($_POST['professional'] ?? '');

    // Check for validation errors
    if (!$email || !$mobile) {
        $message = "Invalid email or mobile number.";
    } else {
        // Prepare SQL query
        $sql = "INSERT INTO user_account
                (name, email, mobile, service_location, shifting_location, shifting_date, shift_type, items_to_shift, professional) 
                VALUES 
                (:name, :email, :mobile, :service_location, :shifting_location, TO_DATE(:shifting_date, 'YYYY-MM-DD'), :shift_type, :items_to_shift, :professional)";

        $stid = oci_parse($conn, $sql);
        oci_bind_by_name($stid, ':name', $name);
        oci_bind_by_name($stid, ':email', $email);
        oci_bind_by_name($stid, ':mobile', $mobile);
        oci_bind_by_name($stid, ':service_location', $service_location);
        oci_bind_by_name($stid, ':shifting_location', $shifting_location);
        oci_bind_by_name($stid, ':shifting_date', $shifting_date);
        oci_bind_by_name($stid, ':shift_type', $shift_type);
        oci_bind_by_name($stid, ':items_to_shift', $items_to_shift);
        oci_bind_by_name($stid, ':professional', $professional);

        if (oci_execute($stid)) {
            $success = true; // Set success flag
        } else {
            $e = oci_error($stid);
            $message = "Error: " . htmlspecialchars($e['message']);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Request Quote</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .nav-button {
      transition: transform 0.3s ease, background-color 0.3s ease;
    }
    .nav-button:hover {
      transform: scale(1.05);
      background-color: #ddd;
    }
    .form-button {
      background-color: #f59e0b;
      transition: transform 0.3s ease, background-color 0.3s ease;
    }
    .form-button:hover {
      transform: scale(1.05);
      background-color: #d97706;
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800">

<?php if ($success): ?>
  <script>
    alert("Request submitted successfully!");
    window.location.href = "my_request.php"; // Redirect to "My Requests" page
  </script>
<?php endif; ?>

<!-- Navigation -->
<header class="bg-white shadow py-4">
  <div class="container mx-auto px-6 flex justify-between items-center">
    <nav class="space-x-4">
      <a href="#" class="nav-button text-blue-700 px-4 py-2 rounded">My Account</a>
      <a href="my_request.php" class="nav-button text-green-600 px-4 py-2 rounded">My Requests</a>
      <a href="change_password.php" class="nav-button text-yellow-600 px-4 py-2 rounded">Change Password</a>
      <a href="../logout.php" class="nav-button text-red-700 px-4 py-2 rounded">Logout</a>
    </nav>
  </div>
</header>

<!-- Form -->
<main class="container mx-auto px-6 py-10">
  <section class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-orange-700 mb-6">Request Quote</h2>

    <?php if (!empty($message)): ?>
      <div class="bg-red-100 text-red-700 p-2 rounded mb-4"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST" class="space-y-6">
      <input type="text" name="name" placeholder="Full Name" required class="w-full px-4 py-2 border rounded" />
      <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-2 border rounded" />
      <input type="text" name="mobile" placeholder="Mobile Number" required class="w-full px-4 py-2 border rounded" />
      <input type="text" name="service_location" placeholder="Service Location" required class="w-full px-4 py-2 border rounded" />
      <input type="text" name="shifting_location" placeholder="Shifting Location" required class="w-full px-4 py-2 border rounded" />
      <input type="date" name="shifting_date" required class="w-full px-4 py-2 border rounded" />
      <select name="shift_type" required class="w-full px-4 py-2 border rounded">
        <option value="">Select Shift Type</option>
        <option value="Home">Home</option>
        <option value="Office">Office</option>
      </select>
      <input type="text" name="items_to_shift" placeholder="Items to Shift" required class="w-full px-4 py-2 border rounded" />
      <input type="text" name="professional" placeholder="Professional Help Needed?" required class="w-full px-4 py-2 border rounded" />

      <button type="submit" class="form-button px-6 py-2 text-white rounded">Submit Request</button>
    </form>
  </section>
</main>

</body>
</html>