<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ./login.php");
    exit();
}

// ✅ Database connection
$conn = oci_connect('c##aman', 'root', "//localhost:1521/XE");
if (!$conn) {
    $e = oci_error();
    echo "Failed to connect to Oracle: " . $e['message'];
    exit();
}

// Handle deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']); // Sanitize the input
    $delete_sql = "DELETE FROM c##aman.user_account WHERE id = :id";
    $delete_stid = oci_parse($conn, $delete_sql);
    oci_bind_by_name($delete_stid, ':id', $delete_id);

    if (oci_execute($delete_stid)) {
        $success_message = "Record with ID $delete_id deleted successfully.";
    } else {
        $e = oci_error($delete_stid);
        $error_message = "Error deleting record: " . htmlspecialchars($e['message']);
    }
    oci_free_statement($delete_stid);
}

// Fetch submitted requests from the database
$sql = "SELECT id, name, email, mobile, service_location, shifting_location, TO_CHAR(shifting_date, 'YYYY-MM-DD') AS shifting_date, shift_type, items_to_shift, professional FROM c##aman.user_account ORDER BY id DESC";
$stid = oci_parse($conn, $sql);

if (!oci_execute($stid)) {
    $e = oci_error($stid);
    echo "<div class='bg-red-100 text-red-700 p-4 rounded'>Error executing query: " . htmlspecialchars($e['message']) . "</div>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Requests</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .nav-button {
      transition: transform 0.3s ease, background-color 0.3s ease;
    }
    .nav-button:hover {
      transform: scale(1.05);
      background-color: #ddd;
    }
    .delete-button {
      background-color: #ef4444; /* Red color */
      color: white;
      transition: transform 0.3s ease, background-color 0.3s ease;
    }
    .delete-button:hover {
      transform: scale(1.05);
      background-color: #dc2626; /* Darker red */
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f3f4f6;
    }
    tbody tr:nth-child(even) {
      background-color: #f9fafb;
    }
    tbody tr:hover {
      background-color: #f1f5f9;
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800">

<!-- Navigation -->
<header class="bg-white shadow py-4">
  <div class="container mx-auto px-6 flex justify-between items-center">
    <nav class="space-x-4">
      <a href="my_account.php" class="nav-button text-blue-700 px-4 py-2 rounded">My Account</a>
      <a href="my_request.php" class="nav-button text-green-600 px-4 py-2 rounded">My Requests</a>
      <a href="change_password.php" class="nav-button text-yellow-600 px-4 py-2 rounded">Change Password</a>
      <a href="../logout.php" class="nav-button text-red-700 px-4 py-2 rounded">Logout</a>
    </nav>
  </div>
</header>

<!-- Main Content -->
<main class="container mx-auto px-6 py-10">
  <section class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-green-700 mb-6">Your Submitted Requests</h2>

    <!-- Success and Error Messages -->
    <?php if (!empty($success_message)): ?>
      <div class="bg-green-100 text-green-700 p-4 rounded mb-4"><?= $success_message ?></div>
    <?php endif; ?>
    <?php if (!empty($error_message)): ?>
      <div class="bg-red-100 text-red-700 p-4 rounded mb-4"><?= $error_message ?></div>
    <?php endif; ?>

    <div class="overflow-x-auto">
      <table class="table-auto border-collapse w-full border border-gray-200 rounded-lg">
        <thead>
          <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2">Name</th>
            <th class="border border-gray-300 px-4 py-2">Email</th>
            <th class="border border-gray-300 px-4 py-2">Mobile</th>
            <th class="border border-gray-300 px-4 py-2">Service Location</th>
            <th class="border border-gray-300 px-4 py-2">Shifting Location</th>
            <th class="border border-gray-300 px-4 py-2">Shifting Date</th>
            <th class="border border-gray-300 px-4 py-2">Shift Type</th>
            <th class="border border-gray-300 px-4 py-2">Items to Shift</th>
            <th class="border border-gray-300 px-4 py-2">Professional Help</th>
            <th class="border border-gray-300 px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = oci_fetch_assoc($stid)): ?>
            <tr>
              <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['NAME']) ?></td>
              <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['EMAIL']) ?></td>
              <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['MOBILE']) ?></td>
              <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['SERVICE_LOCATION']) ?></td>
              <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['SHIFTING_LOCATION']) ?></td>
              <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['SHIFTING_DATE']) ?></td>
              <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['SHIFT_TYPE']) ?></td>
              <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['ITEMS_TO_SHIFT']) ?></td>
              <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($row['PROFESSIONAL']) ?></td>
              <td class="border border-gray-300 px-4 py-2">
                <!-- Delete Form -->
                <form method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                  <input type="hidden" name="delete_id" value="<?= $row['ID'] ?>">
                  <button type="submit" class="delete-button px-4 py-2 rounded">Delete</button>
                </form>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </section>
</main>

</body>
</html>

<?php
// Free Oracle resources
oci_free_statement($stid);
oci_close($conn);
?>