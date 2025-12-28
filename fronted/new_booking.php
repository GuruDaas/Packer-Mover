<?php
$conn = oci_connect('c##aman', 'root', "//localhost:1521/XE");

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $customer_name = $_POST['customer_name'] ?? '';
  $customer_email = $_POST['contact_email'] ?? '';
  $contact_phone = $_POST['contact_phone'] ?? '';
  $pick_date = $_POST['pick_date'] ?? '';
  $pick_address = $_POST['pick_address'] ?? '';
  $destination = $_POST['destination'] ?? '';
  $booking_date = $_POST['booking_date'] ?? '';
  $status = $_POST['status'] ?? '';

  // Sab fields check karlo
  if ($customer_name && $customer_email && $contact_phone && $pick_date && $pick_address && $destination && $booking_date && $status) {

      $query = "INSERT INTO new_bookings 
              (customer_name, customer_email, contact_phone, pick_date, pick_address, destination, booking_date, status)
              VALUES 
              (:customer_name, :customer_email, :contact_phone, TO_DATE(:pick_date, 'YYYY-MM-DD'), :pick_address, :destination, TO_DATE(:booking_date, 'YYYY-MM-DD'), :status)";

      $stmt = oci_parse($conn, $query);

      oci_bind_by_name($stmt, ":customer_name", $customer_name);
      oci_bind_by_name($stmt, ":customer_email", $customer_email);
      oci_bind_by_name($stmt, ":contact_phone", $contact_phone);
      oci_bind_by_name($stmt, ":pick_date", $pick_date);
      oci_bind_by_name($stmt, ":pick_address", $pick_address);
      oci_bind_by_name($stmt, ":destination", $destination);
      oci_bind_by_name($stmt, ":booking_date", $booking_date);
      oci_bind_by_name($stmt, ":status", $status);

      if (oci_execute($stmt)) {
        $success = "Booking added successfully!";
      } else {
        $e = oci_error($stmt);
        $error = "Error: " . $e['message'];
      }

  } else {
      $error = "Please fill all fields.";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Booking - Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

  <div class="flex h-screen justify-center items-center">
    <!-- Main Content -->
    <div class="w-full max-w-3xl p-8 bg-white rounded-lg shadow-lg">

      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">New Booking Requests</h1>
        <div class="flex space-x-4">
          <i class="fas fa-bell text-xl cursor-pointer text-gray-600 hover:text-green-600" title="Notifications"></i>
          <i class="fas fa-user-circle text-xl cursor-pointer text-gray-600 hover:text-green-600" title="Profile"></i>
        </div>
      </div>

      <!-- New Booking Form -->
      <div id="new-booking-form" class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Create New Booking</h2>

        <?php if ($success): ?>
          <div class="bg-green-100 text-green-700 p-3 mb-4 rounded"><?= $success ?></div>
        <?php elseif ($error): ?>
          <div class="bg-red-100 text-red-700 p-3 mb-4 rounded"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="index.html">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="mb-6">
              <label for="customer_name" class="block text-gray-700 text-lg">Customer Name</label>
              <input type="text" id="customer_name" name="customer_name" class="w-full p-3 border rounded-lg" required>
            </div>
            <div class="mb-6">
              <label for="contact_email" class="block text-gray-700 text-lg">Customer Email</label>
              <input type="email" id="contact_email" name="contact_email" class="w-full p-3 border rounded-lg" required>
            </div>
            <div class="mb-6">
              <label for="contact_phone" class="block text-gray-700 text-lg">Contact Phone</label>
              <input type="text" id="contact_phone" name="contact_phone" class="w-full p-3 border rounded-lg" required>
            </div>
            <div class="mb-6">
              <label for="pick_date" class="block text-gray-700 text-lg">Pick Date</label>
              <input type="date" id="pick_date" name="pick_date" class="w-full p-3 border rounded-lg" required>
            </div>
            <div class="mb-6">
              <label for="pick_address" class="block text-gray-700 text-lg">Pick Address</label>
              <input type="text" id="pick_address" name="pick_address" class="w-full p-3 border rounded-lg" required>
            </div>
            <div class="mb-6">
              <label for="destination" class="block text-gray-700 text-lg">Destination</label>
              <input type="text" id="destination" name="destination" class="w-full p-3 border rounded-lg" required>
            </div>
            <div class="mb-6">
              <label for="booking_date" class="block text-gray-700 text-lg">Booking Date</label>
              <input type="date" id="booking_date" name="booking_date" class="w-full p-3 border rounded-lg" required>
            </div>
            <div class="mb-6">
              <label for="status" class="block text-gray-700 text-lg">Status</label>
              <select id="status" name="status" class="w-full p-3 border rounded-lg" required>
                <option value="Pending" selected>Pending</option>
                <option value="Confirmed">Confirmed</option>
                <option value="In Transit">In Transit</option>
                <option value="Delivered">Delivered</option>
              </select>
            </div>
          </div>
          <button type="submit" class="w-full bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-all">Submit Booking</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Mobile Menu Toggle -->
  <button class="md:hidden fixed top-4 right-4 z-50" onclick="toggleSidebar()">
    <i class="fas fa-bars text-2xl text-gray-600"></i>
  </button>

  <script>
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('open');
    }
  </script>
</body>
</html>
