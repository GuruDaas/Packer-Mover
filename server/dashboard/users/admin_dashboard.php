<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
    header("Location: .login.php");
    exit();
}

// Oracle DB Connection
$conn = oci_connect("c##aman", "root", "localhost/XE");
if (!$conn) {
    $e = oci_error();
    die("Oracle connection failed: " . $e['message']);
}

// Function to get count from a table
function getCount($conn, $table) {
    $sql = "SELECT COUNT(*) AS total FROM $table";
    $stid = oci_parse($conn, $sql);
    oci_execute($stid);
    $row = oci_fetch_assoc($stid);
    return $row['TOTAL'];
}

// Fetch all required counts
$totalUsers = getCount($conn, 'users');
$totalServices = getCount($conn, 'services');
$totalBookings = getCount($conn, 'book_sec');
$totalPendingBookings = getCount($conn, "book_sec WHERE status = 'Pending'");
$totalApprovedBookings = getCount($conn, "book_sec WHERE status = 'Approved'");
$totalRejectedBookings = getCount($conn, "book_sec WHERE status = 'Rejected'");
$totalQueries = getCount($conn, 'contact_queries');
$unreadQueries = getCount($conn, "contact_queries WHERE status = 'Unread'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

<!-- Sidebar -->
<aside class="w-64 bg-white shadow-md h-screen sticky top-0">
  <div class="p-6 text-2xl font-bold text-orange-600">Admin Panel</div>
  <nav class="flex flex-col space-y-2 text-gray-700 px-4">
    <a href="admin_dashboard.php" class="hover:bg-orange-100 rounded px-3 py-2 font-medium">Dashboard</a>
    <a href="add_service.php" class="hover:bg-orange-100 rounded px-3 py-2 font-medium">Add Service</a>
    <a href="manage_services.php" class="hover:bg-orange-100 rounded px-3 py-2 font-medium">Manage Services</a>
    <a href="all_bookings.php" class="hover:bg-orange-100 rounded px-3 py-2 font-medium">View Bookings</a>
    <a href="contact_queries.php" class="hover:bg-orange-100 rounded px-3 py-2 font-medium">Contact Queries</a>
    <a href="users.php" class="hover:bg-orange-100 rounded px-3 py-2 font-medium">Registered Users</a>
    <a href="manage_pages.php" class="hover:bg-orange-100 rounded px-3 py-2 font-medium">Manage Pages</a>
    <a href="reports.php" class="hover:bg-orange-100 rounded px-3 py-2 font-medium">Reports</a>
    <a href="settings.php" class="hover:bg-orange-100 rounded px-3 py-2 font-medium">Settings</a>
    <a href="logout.php" class="hover:bg-red-100 text-red-700 rounded px-3 py-2 font-medium">Logout</a>
  </nav>
</aside>

<!-- Main Content -->
<main class="flex-1 p-6">
  <h1 class="text-3xl font-bold mb-6 text-orange-700">Dashboard Overview</h1>
  
  <!-- Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white shadow p-6 rounded-lg hover:shadow-xl transition">
      <h2 class="text-xl font-semibold text-gray-700">Total Users</h2>
      <p class="text-3xl font-bold text-orange-600 mt-2"><?= $totalUsers ?></p>
    </div>
    <div class="bg-white shadow p-6 rounded-lg hover:shadow-xl transition">
      <h2 class="text-xl font-semibold text-gray-700">Total Services</h2>
      <p class="text-3xl font-bold text-orange-600 mt-2"><?= $totalServices ?></p>
    </div>
    <div class="bg-white shadow p-6 rounded-lg hover:shadow-xl transition">
      <h2 class="text-xl font-semibold text-gray-700">Total Bookings</h2>
      <p class="text-3xl font-bold text-orange-600 mt-2"><?= $totalBookings ?></p>
    </div>
    <div class="bg-white shadow p-6 rounded-lg hover:shadow-xl transition">
      <h2 class="text-xl font-semibold text-gray-700">Pending Bookings</h2>
      <p class="text-3xl font-bold text-yellow-500 mt-2"><?= $totalPendingBookings ?></p>
    </div>
    <div class="bg-white shadow p-6 rounded-lg hover:shadow-xl transition">
      <h2 class="text-xl font-semibold text-gray-700">Approved Bookings</h2>
      <p class="text-3xl font-bold text-green-600 mt-2"><?= $totalApprovedBookings ?></p>
    </div>
    <div class="bg-white shadow p-6 rounded-lg hover:shadow-xl transition">
      <h2 class="text-xl font-semibold text-gray-700">Rejected Bookings</h2>
      <p class="text-3xl font-bold text-red-600 mt-2"><?= $totalRejectedBookings ?></p>
    </div>
    <div class="bg-white shadow p-6 rounded-lg hover:shadow-xl transition">
      <h2 class="text-xl font-semibold text-gray-700">Total Queries</h2>
      <p class="text-3xl font-bold text-indigo-600 mt-2"><?= $totalQueries ?></p>
    </div>
    <div class="bg-white shadow p-6 rounded-lg hover:shadow-xl transition">
      <h2 class="text-xl font-semibold text-gray-700">Unread Queries</h2>
      <p class="text-3xl font-bold text-red-500 mt-2"><?= $unreadQueries ?></p>
    </div>
  </div>
</main>

</body>
</html>
